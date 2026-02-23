<?php
session_start();

if(!isset($_SESSION['jwt'])){   
    $_SESSION['status'] = "Please login to access dashboard";
    header("Location: login.php");
    exit();
}

$page_title = "Dashboard";

include(__DIR__ . '/../includes/header.php');
include(__DIR__ . '/../includes/navbar.php');
?>

<div class="container py-5">
    <h3>Welcome, <?= $_SESSION['auth_user']['name']; ?></h3>
    <p>Your JWT Token:</p>
    <textarea class="form-control" rows="4"><?= $_SESSION['jwt']; ?></textarea>
</div>

<?php include(__DIR__ . '/../includes/footer.php'); ?>