<?php require_once 'partials/_header.php'; ?>

<main role="main">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Checkout Form</h2>
            <p class="lead">You are ordering as <?php echo $_SESSION['user']['email']; ?></p>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill"><?php echo count($cart); ?></span>
                </h4>

                <ul class="list-group mb-3">
                    <?php foreach ($cart as $id => $product): ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $product['title']; ?></h6>
                                <small class="text-muted">Quantity: <?php echo $product['quantity']; ?></small>
                            </div>
                            <span class="text-muted"><?php echo number_format($product['total_price'], 2); ?></span>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (BDT)</span>
                        <strong><?php echo number_format($sum, 2); ?></strong>
                    </li>
                </ul>
            </div>

            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form action="/checkout" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" name="first_name" value="" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" name="last_name" value="" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['user']['email']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" placeholder="Enter phone number" required>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>
                    <hr class="mb-4">

                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
</main>

<?php require_once 'partials/_footer.php'; ?>

