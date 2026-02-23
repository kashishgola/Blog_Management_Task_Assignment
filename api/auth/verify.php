<?php
header("Content-Type: application/json");
require_once "../../config/config.php";
require_once "../../core/AuthMiddleware.php";

$decoded = AuthMiddleware::protect();

echo json_encode([
    "status" => "valid",
    "user_id" => $decoded->sub,
    "role" => $decoded->role
]);