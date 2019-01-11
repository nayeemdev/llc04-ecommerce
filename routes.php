<?php

use Phroute\Phroute\RouteCollector;

$router->filter('auth', function () {
    if (! isset($_SESSION['user'])) {
        $errors[] = 'You are not logged in.';
        $_SESSION['errors'] = $errors;
        header('Location: /login');
        exit();
    }
});

$router->controller('/', \App\Controllers\Frontend\HomeController::class);
$router->controller('/cart', \App\Controllers\Frontend\CartController::class);
$router->group(['before' => 'auth'], function (RouteCollector $router) {
    $router->controller('/checkout', \App\Controllers\Frontend\CheckoutController::class);
});

$router->group(['before' => 'auth', 'prefix' => 'dashboard'], function (RouteCollector $router) {
    $router->controller('/', \App\Controllers\Backend\DashboardController::class);
    $router->controller('/categories', \App\Controllers\Backend\CategoryController::class);
    $router->controller('/products', \App\Controllers\Backend\ProductController::class);
});

