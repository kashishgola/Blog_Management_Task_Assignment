<?php
header("Content-Type: application/json");
require_once "../../config/config.php";
require_once "../../core/Database.php";
require_once "../../core/JWTHandler.php";

$input = json_decode(file_get_contents("php://input"), true);

$email = $input['email'] ?? '';
$password = $input['password'] ?? '';

$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    echo json_encode(["error" => "Invalid email or password"]);
    exit;
}

$token = JWTHandler::generate($user['id'], $user['role']);

echo json_encode([
    "token" => $token,
    "user" => [
        "id" => $user["id"],
        "name" => $user["name"],
        "role" => $user["role"]
    ]
]);