<?php require_once 'partials/_header.php'; ?>

<main role="main" class="login-page">
    <div class="container">
        <form class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal">Create your account</h1>
            <label for="inputUsername" class="sr-only">Username</label>
            <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <label for="inputPhoto" class="sr-only">Profile Photo</label>
            <input type="file" id="inputPhoto" class="form-control" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>
    </div>
</main>


<?php require_once 'partials/_footer.php'; ?>
