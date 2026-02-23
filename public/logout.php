<?php
session_start();

// Delete JWT session
unset($_SESSION['jwt']);
unset($_SESSION['auth_user']);

$_SESSION['status'] = "Logged out successfully!";
header("Location: login.php");
exit();