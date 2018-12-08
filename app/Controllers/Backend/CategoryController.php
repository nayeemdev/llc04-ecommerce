<?php

namespace App\Controllers\Backend;

use App\Controllers\Controller;
use App\Models\Category;
use Respect\Validation\Validator;

class CategoryController extends Controller
{
    public function getIndex(): void
    {
        $categories = Category::all();

        view('backend/category/index', ['categories' => $categories]);
    }

    public function postIndex(): void
    {
        $validator = new Validator();
        $errors = [];
        $title = $_POST['title'];
        $slug = $this->slugify($_POST['title']);
        $active = $_POST['active'];

        // validation
        if ($validator::alpha()->validate($title) === false) {
            $errors['title'] = 'Title can only contain alphabets';
        }

        if ($validator::slug()->validate($slug) === false) {
            $errors['slug'] = 'Slug must be valid slug';
        }

        if (empty($errors)) {
            Category::create([
                'title' => $title,
                'slug' => strtolower($slug),
                'active' => $active,
            ]);

            $_SESSION['success'] = 'Category created';
            redirect('dashboard/categories');
        }

        $_SESSION['errors'] = $errors;
        redirect('categories');
    }

    public function getEdit($id = null): void
    {
        if ($id === null) {
            redirect('dashboard/categories');
        }
        $_SESSION['category_id'] = $id;

        view('backend/category/edit');
        unset($_SESSION['category_id']);
    }

    public function postEdit($id = null): void
    {
        if ($id === null) {
            redirect('dashboard/categories');
        }

        $validator = new Validator();
        $errors = [];
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $active = $_POST['active'];

        // validation
        if ($validator::alpha()->validate($title) === false) {
            $errors['title'] = 'Title can only contain alphabets';
        }

        if (empty($errors)) {
            try {
                $category = Category::find($id);
                $category->update([
                    'title' => $title,
                    'slug' => strtolower($slug),
                    'active' => $active,
                ]);

                $_SESSION['success'] = 'Category updated';
                redirect('dashboard/categories');
            } catch (\Exception $e) {
                $_SESSION['errors'] = ['message' => $e->getMessage()];
                redirect('dashboard/categories');
            }
        }

        $_SESSION['errors'] = $errors;
        redirect('dashboard/categories');
    }

    public function getDelete($id = null): void
    {
        if ($id === null) {
            redirect('dashboard/category');
        }

        $category = Category::find($id);
        $category->delete();

        $_SESSION['success'] = 'Category deleted.';
        redirect('dashboard/categories');
    }
}
