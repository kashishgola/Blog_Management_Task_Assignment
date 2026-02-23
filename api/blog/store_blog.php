<?php
session_start();
require_once "../../core/Helpers.php";
require_once '../../config.php';

// print_r($_POST); die;
$title = Helpers::cleanText($_POST['title'] ?? '');
$description = Helpers::sanitizeHTML($_POST['description'] ?? '');
$media = filter_var($_POST['media_url'] ?? null, FILTER_SANITIZE_URL);
$user_id = $_SESSION['auth_user']['user_id'] ? $_SESSION['auth_user']['user_id'] : 0;
$slug = Helpers::generateSlug($title);


$stmt = $pdo->prepare("
    INSERT INTO blog (Title, User_id , Description, Slug, media_url)
    VALUES (?, ?, ?, ?, ?)
");
$stmt->execute([$title, $user_id, $description, $slug, $media]);

// echo json_encode(["success" => true, "slug" => $slug]);

$_SESSION['success'] = "Blog created successfully!";

// redirect to list page
header("Location: list.php");
exit;