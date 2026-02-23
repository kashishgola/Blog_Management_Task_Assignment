<?php 
session_start();
require_once "../../core/Helpers.php";
require_once '../../config.php';    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = $_POST;

    $title       = Helpers::cleanText($input['title'] ?? '');
    $description = Helpers::sanitizeHTML($input['description'] ?? '');
    $media       = filter_var($input['media_url'] ?? null, FILTER_SANITIZE_URL);
    $user_id     = $_SESSION['auth_user']['user_id'] ?? 0;
    $slug        = Helpers::generateSlug($title);
    

    // Validation
    if ($title === '' || $description === '') {
        $_SESSION['error'] = "Title and description are required.";
        header("Location: create.php");
        exit;
    }

    // Insert
    $stmt = $pdo->prepare("
        INSERT INTO post (Title, User_id, Description, Slug, Media_url)
        VALUES (:title, :user_id, :description, :slug, :media)
    ");

    $stmt->execute([
        ':title'       => $title,
        ':user_id'     => $user_id,
        ':description' => $description,
        ':slug'        => $slug,
        ':media'       => $media
    ]);

    $_SESSION['success'] = "Post created successfully!";
    header("Location: list.php");
    exit;
}