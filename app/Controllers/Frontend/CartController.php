<?php

namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Models\Product;

class CartController extends Controller
{
    public function getIndex(): void
    {
        $cart = $_SESSION['cart'] ?? [];
        $sum = array_sum(array_column($cart, 'total_price'));

        view('cart', ['cart' => $cart, 'sum' => $sum]);
    }

    public function postIndex(): void
    {
        $id = (int) $_POST['id'];

        $product = Product::find($id);

        if ($product === null) {
            redirect();
        }

        $cart = $_SESSION['cart'] ?? [];

        if (array_key_exists($id, $cart)) {
            $cart[$id]['quantity']++;
            $cart[$id]['total_price'] += $product->price;
        } else {
            $cart[$id] = [
                'title' => $product->title,
                'quantity' => 1,
                'unit_price' => $product->price,
                'total_price' => $product->price,
            ];
        }

        $_SESSION['cart'] = $cart;

        redirect('cart');
    }

    public function postRemove(): void
    {
        $id = (int) $_POST['id'];

        unset($_SESSION['cart'][$id]);
        redirect('cart');
    }

    public function postDestroy(): void
    {
        unset($_SESSION['cart']);
        redirect('cart');
    }
}
