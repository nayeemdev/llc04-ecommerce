<?php partial_view('_dash_header'); ?>

<div class="container-fluid">
    <div class="row">
        <?php partial_view('_dash_sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Category</h1>
            </div>

            <?php partial_view('_notification'); ?>

            <form action="/dashboard/categories" class="form" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="Enter Title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" placeholder="Enter Slug" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="active" id="" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Add Category</button>
                </div>
            </form>

            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Title</td>
                            <td>Slug</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $categories = \App\Models\Category::all();
                    foreach ($categories as $category):
                    ?>
                        <tr>
                            <td><?php echo $category->id; ?></td>
                            <td><?php echo $category->title; ?></td>
                            <td><?php echo $category->slug; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

<?php partial_view('_dash_footer'); ?>
