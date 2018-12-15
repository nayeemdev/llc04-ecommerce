<?php require_once 'partials/_header.php'; ?>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Album example</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks
                don't simply skip over it entirely.</p>
            <p>
                <a href="#" class="btn btn-primary my-2">Main call to action</a>
                <a href="#" class="btn btn-secondary my-2">Secondary action</a>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <a href="/product/<?php echo $product->slug; ?>">
                                <img class="card-img-top" src="/media/products/<?php echo $product->product_photo->image_path; ?>" alt="<?php echo $product->title; ?>">
                            </a>

                            <div class="card-body">
                                <p class="card-text">
                                    <a href="/product/<?php echo $product->slug; ?>">
                                        <?php echo $product->title; ?>
                                    </a>
                                </p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted"><?php echo $product->price; ?> BDT</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</main>

<?php require_once 'partials/_footer.php'; ?>
