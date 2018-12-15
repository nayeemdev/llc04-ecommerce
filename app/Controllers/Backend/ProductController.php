<?php

namespace App\Controllers\Backend;

use App\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Respect\Validation\Validator;

class ProductController extends Controller
{
    public function getIndex(): void
    {
        $categories = Category::all();
        $products = Product::all();

        view('backend/product/index', ['categories' => $categories, 'products' => $products]);
    }

    public function postIndex(): void
    {
        $validator = new Validator();
        $errors = [];
        $title = $_POST['title'];
        $category_id = (int) $_POST['category_id'];
        $slug = $this->slugify($_POST['title']);
        $description = $_POST['description'];
        $price = $_POST['price'];
        $sales_price = $_POST['sales_price'];
        $active = (int) $_POST['active'];
        $product_photo = $_FILES['product_photo'];

        // validation
        if ($validator::length(2, 255)->validate($title) === false) {
            $errors['title'] = 'Title length must be between 2 and 255';
        }

        if (strlen($description) <= 0) {
            $errors['description'] = 'Description cannot be empty';
        }

        if ($validator::numeric()->positive()->validate($price) === false) {
            $errors['price'] = 'Price must be a positive value';
        }

        if ($validator::numeric()->positive()->validate($sales_price) === false) {
            $errors['sales_price'] = 'Sales Price must be a positive value';
        }

        if (empty($errors)) {
            $product = Product::create([
                'title' => $title,
                'category_id' => $category_id,
                'slug' => $slug,
                'description' => $description,
                'price' => $price,
                'sales_price' => $sales_price,
                'active' => $active,
            ]);

            // process file upload
            $file_name = 'product_'.time();
            $extension = explode('.', $product_photo['name']);
            $ext = end($extension);
            move_uploaded_file($product_photo['tmp_name'], 'media/products/'.$file_name.'.'.$ext);

            $product->product_photo()->create([
                'image_path' => $file_name.'.'.$ext,
            ]);

            $_SESSION['success'] = 'Product created';
            redirect('dashboard/products');
        }

        $_SESSION['errors'] = $errors;
        redirect('dashboard/products');
    }

    public function getEdit($id = null): void
    {
        if ($id === null) {
            redirect('dashboard/products');
        }

        $product = Product::findOrFail($id);
        $categories = Category::select('title', 'id')->get();

        view('backend/product/edit', ['product' => $product, 'categories' => $categories]);
    }

    public function postEdit($id = null): void
    {
        if ($id === null) {
            redirect('dashboard/products');
        }

        $validator = new Validator();
        $errors = [];
        $title = $_POST['title'];
        $category_id = (int) $_POST['category_id'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $sales_price = $_POST['sales_price'];
        $active = (int) $_POST['active'];
        $product_photo = $_FILES['product_photo'];

        // validation
        if ($validator::length(2, 255)->validate($title) === false) {
            $errors['title'] = 'Title length must be between 2 and 255';
        }

        if (strlen($description) <= 0) {
            $errors['description'] = 'Description cannot be empty';
        }

        if ($validator::numeric()->positive()->validate($price) === false) {
            $errors['price'] = 'Price must be a positive value';
        }

        if ($validator::numeric()->positive()->validate($sales_price) === false) {
            $errors['sales_price'] = 'Sales Price must be a positive value';
        }

        if (empty($errors)) {
            $product = Product::findOrFail($id);

            if (! empty($product_photo['name'])) {
                // process file upload
                $file_name = 'product_'.time();
                $extension = explode('.', $product_photo['name']);
                $ext = end($extension);
                move_uploaded_file($product_photo['tmp_name'], 'media/products/'.$file_name.'.'.$ext);

                if ($product->product_photo->image_path) {
                    unlink('media/products/'.$product->product_photo->image_path);
                }

                $product->product_photo()->update([
                    'image_path' => $file_name.'.'.$ext,
                ]);
            }

            $product->update([
                'title' => $title,
                'category_id' => $category_id,
                'description' => $description,
                'price' => $price,
                'sales_price' => $sales_price,
                'active' => $active,
            ]);

            $_SESSION['success'] = 'Product updated';
            redirect('dashboard/products/edit/'.$id);
        }

        $_SESSION['errors'] = $errors;
        redirect('dashboard/products/edit/'.$id);
    }

    public function getDelete($id = null): void
    {
        if ($id === null) {
            redirect('dashboard/products');
        }

        $product = Product::findOrFail($id);
        $product->delete();

        $_SESSION['success'] = 'Product deleted';
        redirect('dashboard/products');
    }
}
