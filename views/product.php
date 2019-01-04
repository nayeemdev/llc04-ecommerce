<?php require_once 'partials/_header.php'; ?>

<main role="main">
    <div class="container">
        <br>
        <p class="text-center"><?php echo $product->title; ?></p>
        <hr>

        <div class="card">
            <div class="row">
                <aside class="col-sm-5 border-right">
                    <article class="gallery-wrap">
                        <div>
                            <img src="/media/products/<?php echo $product->product_photo->image_path; ?>" class="card-img-top" alt="">
                        </div> <!-- slider-product.// -->
                    </article> <!-- gallery-wrap .end// -->
                </aside>

                <aside class="col-sm-7">
                    <article class="card-body p-5">
                        <h3 class="title mb-3"><?php echo $product->title; ?></h3>

                        <p class="price-detail-wrap">
                            <span class="price h3 text-warning">
                                <span class="currency">BDT </span>
                                <span class="num">
                                    <?php echo $product->price; ?>
                                </span>
                            </span>
                        </p> <!-- price-detail-wrap .// -->

                        <dl class="item-property">
                            <dt>Description</dt>
                            <dd><p><?php echo $product->description; ?></p></dd>
                        </dl>
                        <hr>

                        <form action="/cart" method="post">
                            <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                            <button type="submit" class="btn btn-lg btn-outline-primary text-uppercase">
                                Add to Cart
                            </button>
                        </form>
                    </article> <!-- card-body.// -->
                </aside> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card.// -->

    </div>
    <!--container.//-->
</main>

<?php require_once 'partials/_footer.php'; ?>
