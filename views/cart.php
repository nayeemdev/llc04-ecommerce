<?php require_once 'partials/_header.php'; ?>

<main role="main">
    <div class="container">
        <div class="card">
            <?php if (empty($cart)): ?>
                <div class="alert alert-info">
                    No product added to the cart at the moment.
                </div>
            <?php else: ?>
                <table class="table table-hover shopping-cart-wrap">
                    <thead class="text-muted">
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col" width="60">Quantity</th>
                        <th scope="col" width="180">Price</th>
                        <th scope="col" width="200" class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cart as $id => $product): ?>
                        <tr>
                            <td>
                                <figure class="media">
                                    <figcaption class="media-body">
                                        <h6 class="title text-truncate"><?php echo $product['title']; ?></h6>
                                    </figcaption>
                                </figure>
                            </td>
                            <td>
                                <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>">
                            </td>
                            <td>
                                <div class="price-wrap">
                                    <var class="price">BDT <?php echo number_format($product['total_price'], 2); ?></var>
                                    <small class="text-muted">(BDT <?php echo $product['unit_price']; ?> each)</small>
                                </div> <!-- price-wrap .// -->
                            </td>
                            <td class="text-right">
                                <form action="/cart/remove" method="post">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <button type="submit" class="btn btn-outline-danger">x</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <strong>Total Price: </strong>
                        </td>
                        <td>
                            <div class="price-wrap">
                                <var class="price">BDT <?php echo number_format($sum, 2); ?></var>
                            </div>
                        </td>
                        <td class="text-right">
                            <form action="/cart/destroy" method="post">
                                <button type="submit" class="btn btn-outline-danger">Empty Cart</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">
                            <a href="/checkout" class="btn btn-outline-success">
                                Checkout
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            <?php endif; ?>
        </div> <!-- card.// -->
    </div>
</main>

<?php require_once 'partials/_footer.php'; ?>
