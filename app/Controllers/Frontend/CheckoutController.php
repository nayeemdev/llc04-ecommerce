<?php

namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Respect\Validation\Validator;

class  CheckoutController extends Controller
{
    public function getIndex(): void
    {
        $categories = Category::select(['slug', 'title'])->get();
        $cart = $_SESSION['cart'] ?? [];
        $sum = array_sum(array_column($cart, 'total_price'));

        view('checkout', ['cart' => $cart, 'sum' => $sum, 'categories' => $categories]);
    }

    public function postIndex()
    {
        $validator = new Validator();
        $errors = [];
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $phone_number = trim($_POST['phone_number']);
        $address = trim($_POST['address']);

        if (empty($first_name)) {
            $errors['first_name'] = 'First name is required.';
        }

        if (empty($last_name)) {
            $errors['last_name'] = 'Last name is required.';
        }

        if (empty($email)) {
            $errors['email'] = 'Email is required.';
        }

        if (empty($phone_number)) {
            $errors['phone_number'] = 'Phone number is required.';
        }

        if (empty($address)) {
            $errors['address'] = 'Address is required.';
        }

        if ($validator::email()->validate($email) === false) {
            $errors['email'] = 'Email is must be a valid email address.';
        }

        if (strlen($phone_number) < 11) {
            $errors['phone_number'] = 'Phone number must have at least 11 chars.';
        }

        if (empty($errors)) {
            $cart = $_SESSION['cart'] ?? [];
            $sum = array_sum(array_column($cart, 'total_price'));

            $order = Order::create([
                'user_id' => $_SESSION['user']['id'],
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone_number' => $phone_number,
                'billing_address' => $address,
                'total_amount' => $sum,
                'payment_details' => 'cash on delivery',
            ]);

            foreach ($cart as $id => $product) {
                $order->products()->create([
                    'product_id' => $id,
                    'quantity' => $product['quantity'],
                    'price' => $product['total_price'],
                ]);
            }

            $_SESSION['cart'] = [];

            return redirect();
        }

        return redirect('/checkout');
    }
}
