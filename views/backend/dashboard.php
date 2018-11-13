<?php partial_view('_dash_header'); ?>

<div class="container-fluid">
    <div class="row">
        <?php partial_view('_dash_sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <?php partial_view('_notification'); ?>

            <div class="well">
                <div class="alert alert-info">
                    You have been logged in as <strong><?php echo $_SESSION['user']['username']; ?></strong>
                </div>
            </div>

        </main>
    </div>
</div>

<?php partial_view('_dash_footer'); ?>
