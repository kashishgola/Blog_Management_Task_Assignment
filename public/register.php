<?php
session_start();
$page_title = "Registration Form";

include(__DIR__ . '/../includes/header.php');
include(__DIR__ . '/../includes/navbar.php');
?>
<div class="py-5">
    <div class="container">

        <?php if(isset($_SESSION['status'])): ?>
          <div class="alert alert-info">
              <?= $_SESSION['status']; unset($_SESSION['status']); ?>
          </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-header">
                        <h5>Registration Form (JWT)</h5>
                    </div>

                    <div class="card-body">
                        <form action="register_jwt.php" method="POST">
                            
                            <div class="form-group mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <button type="submit" name="register_btn" class="btn btn-primary w-100">Register</button>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . '/../includes/footer.php'); ?>