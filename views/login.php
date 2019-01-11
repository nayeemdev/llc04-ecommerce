<?php require_once 'partials/_header.php'; ?>

<main role="main" class="login-page">
    <div class="container">

        <?php require_once 'partials/_notification.php'; ?>

        <form class="form-signin" action="/login" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

            <div class="form-group">
                <a href="/register" class="btn btn-lg btn-block btn-outline-dark">Register</a>
            </div>
        </form>

    </div>
</main>

<?php require_once 'partials/_footer.php'; ?>
