<?php partial_view('_dash_header'); ?>

<div class="container-fluid">
    <div class="row">
        <?php partial_view('_dash_sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Product</h1>
            </div>

            <?php partial_view('_notification'); ?>

            <form action="/dashboard/products" class="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="Enter Title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title">Category</label>
                    <select name="category_id" class="form-control">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" placeholder="Enter Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" placeholder="Enter Price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sales_price">Sales Price</label>
                    <input type="text" name="sales_price" placeholder="Enter Sales Price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="product_photo">Product Photo</label>
                    <input type="file" name="product_photo" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="active" id="" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Add Product</button>
                </div>
            </form>

            <div>
                <?php if ($products->count() > 0): ?>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Title</td>
                            <td>Slug</td>
                            <td>Price</td>
                            <td>Sales Price</td>
                            <td>Status</td>
                            <td>Photo</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($products as $product):
                            ?>
                            <tr>
                                <td><?php echo $product->id; ?></td>
                                <td><?php echo $product->title; ?></td>
                                <td><?php echo $product->slug; ?></td>
                                <td><?php echo $product->price; ?></td>
                                <td><?php echo $product->sales_price; ?></td>
                                <td><?php echo $product->active === 1 ? 'Active' : 'Inactive'; ?></td>
                                <td>
                                    <?php if ($product->product_photo): ?>
                                        <img width="50" alt="<?php echo $product->title; ?>"
                                             src="/media/products/<?php echo $product->product_photo->image_path; ?>"
                                        >
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/dashboard/products/edit/<?php echo $product->id; ?>" class="badge badge-info">
                                        Edit
                                    </a>

                                    <a href="/dashboard/products/delete/<?php echo $product->id; ?>" class="badge badge-danger"
                                       onclick="return confirm('Click on OK to continue.');"
                                    >
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <div class="alert alert-info">
                        No category found. Please add one.
                    </div>
                <?php endif; ?>

            </div>

        </main>
    </div>
</div>

<?php partial_view('_dash_footer'); ?>
