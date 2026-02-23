<?php
require_once "../../core/Helpers.php";
require_once '../../config.php';    

$id = $_GET["id"] ?? 0; 

$stmt = $pdo->prepare("SELECT User_id FROM post WHERE ID=?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo json_encode(["error" => "Post not found"]);
    exit;
}

$date = date('Y-m-d H:i:s'); // DATETIME format

$stmt = $pdo->prepare("UPDATE post SET Deleted_at = ? WHERE ID = ?");
$stmt->execute([$date, $id]);

header("Location: list.php");