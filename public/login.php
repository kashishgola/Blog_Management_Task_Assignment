<?php
session_start();
$page_title = "Login Form";

// Redirect if already logged in
if(isset($_SESSION['jwt'])){
    $_SESSION['status'] = "You are already logged in";
    header('Location: dashboard.php');
    exit();
}

include(__DIR__ . '/../includes/header.php');
include(__DIR__ . '/../includes/navbar.php');
?>

<div class="py-5">
    <div class="container">

        <?php if(isset($_SESSION['status'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['status']; unset($_SESSION['status']); ?>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-header"><h5>Login Form (JWT)</h5></div>

                    <div class="card-body">
                        <form action="login_jwt.php" method="POST">

                            <div class="form-group mb-3">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <button type="submit" name="login_now_btn" class="btn btn-primary">Login Now</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php include(__DIR__ . '/../includes/footer.php'); ?>