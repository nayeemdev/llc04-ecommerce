<?php partial_view('_dash_header'); ?>

<div class="container-fluid">
    <div class="row">
        <?php partial_view('_dash_sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Product</h1>
            </div>

            <?php partial_view('_notification'); ?>

            <form action="/dashboard/products/edit/<?php echo $product->id; ?>" class="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="<?php echo $product->title; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title">Category</label>
                    <select name="category_id" class="form-control">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->id; ?>" <?php if ($category->id === $product->category_id) echo 'selected' ?>>
                                <?php echo $category->title; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description"><?php echo $product->description; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" value="<?php echo $product->price; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sales_price">Sales Price</label>
                    <input type="text" name="sales_price" value="<?php echo $product->sales_price; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="product_photo">Product Photo</label>
                    <input type="file" name="product_photo" class="form-control-file">
                    <?php if ($product->product_photo): ?>
                        <img width="50" alt="<?php echo $product->title; ?>"
                             src="/media/products/<?php echo $product->product_photo->image_path; ?>"
                        >
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="active" class="form-control">
                        <option value="1" <?php if ($product->active === 1) {
                            echo 'selected';
                        } ?>>Active
                        </option>
                        <option value="0" <?php if ($product->active === 0) {
                            echo 'selected';
                        } ?>>Inactive
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Edit Product</button>
                </div>
            </form>

        </main>
    </div>
</div>

<?php partial_view('_dash_footer'); ?>
