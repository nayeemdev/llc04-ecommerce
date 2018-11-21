<?php partial_view('_dash_header'); ?>

<div class="container-fluid">
    <div class="row">
        <?php partial_view('_dash_sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Category</h1>
            </div>

            <?php partial_view('_notification'); ?>
            <?php $category = \App\Models\Category::find($_SESSION['category_id']); ?>

            <form action="/dashboard/categories/edit/<?php echo $category->id; ?>" class="form" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="<?php echo $category->title; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" value="<?php echo $category->slug; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="active" id="" class="form-control">
                        <option value="1" <?php if ($category->active === 1) {
                            echo 'selected';
                        } ?>>Active
                        </option>
                        <option value="0" <?php if ($category->active === 0) {
                            echo 'selected';
                        } ?>>Inactive
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Edit Category</button>
                </div>
            </form>

        </main>
    </div>
</div>

<?php partial_view('_dash_footer'); ?>
