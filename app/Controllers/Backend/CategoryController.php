<?php

namespace App\Controllers\Backend;

use App\Controllers\Controller;
use App\Models\Category;
use Respect\Validation\Validator;

class CategoryController extends Controller
{
    public function getIndex()
    {
        view('backend/category/index');
    }

    public function postIndex()
    {
        $validator = new Validator();
        $errors = [];
        $title = $_POST['title'];
        $slug = $_POST['slug'];
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

    public function getEdit($id = null)
    {
        if ($id === null) {
            redirect('dashboard/categories');
        }
        $_SESSION['category_id'] = $id;

        view('backend/category/edit');
        unset($_SESSION['category_id']);
    }

    public function postEdit($id = null)
    {
        if ($id === null) {
            redirect('dahsboard/categories');
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

        if ($validator::slug()->validate($slug) === false) {
            $errors['slug'] = 'Slug must be valid slug';
        }

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
}
