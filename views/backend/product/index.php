<?php partial_view('_dash_header'); ?>

<div class="container-fluid">
    <div class="row">
        <?php partial_view('_dash_sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Product</h1>
            </div>

            <?php partial_view('_notification'); ?>
            <?php $categories = \App\Models\Category::all(); ?>

            <form action="/dashboard/products" class="form" method="post">
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
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" placeholder="Enter Slug" class="form-control">
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

        </main>
    </div>
</div>

<?php partial_view('_dash_footer'); ?>
