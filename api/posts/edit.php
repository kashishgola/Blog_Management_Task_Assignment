<?php
session_start();
require_once "../../core/Helpers.php";
require_once '../../config.php';

// Validate ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request: missing ID");
}

$id = intval($_GET['id']);

// Fetch post data
$stmt = $pdo->prepare("SELECT * FROM post WHERE ID = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Post not found!");
}

// On form submit (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    $title = Helpers::cleanText($_POST['title'] ?? '');
    $description = Helpers::sanitizeHTML($_POST['description'] ?? '');
    $media_url = filter_var($_POST['media_url'] ?? null, FILTER_SANITIZE_URL);

//  echo "<pre>";print_r($_POST);die;
    if(empty($media_url)){
        $media_url       = filter_var($_POST['media_url_old'] ?? null, FILTER_SANITIZE_URL);
    }

    $slug = Helpers::generateSlug($title);

    // Update query
    $update = $pdo->prepare("
        UPDATE post 
        SET Title = ?, Description = ?, Media_url = ?, Slug = ?
        WHERE ID = ?
    ");

    $update->execute([$title, $description, $media_url, $slug, $id]);

    $_SESSION['success'] = "Post updated successfully!";
    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>

    <style>
        label { display: block; margin-top: 12px; font-weight: bold; }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
        }
        button {
            margin-top: 15px;
            padding: 10px 25px;
            background: #0275d8;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<h2>Edit Post</h2>

<form method="POST">

    <label>Title</label>
    <input type="text" name="title" required 
           value="<?= htmlspecialchars($post['Title']) ?>">

    <label>Description</label>
    <textarea name="description" rows="6" required><?= htmlspecialchars($post['Description']) ?></textarea>

    <?php 
    //print_r($post);die;
    
    if (!empty($post['media_url'])): ?>

    <label>Current Thumbnail:</label><br>

    <?php if (preg_match('/\.(mp4|mov|webm)$/i', $post['media_url'])): ?>
        <video src="<?= $post['media_url'] ?>" 
               width="180" 
               controls 
               style="border-radius:8px; margin-bottom:15px;">
        </video>
    <?php else: ?>
        <img src="<?= $post['media_url'] ?>" 
             width="180" 
             style="border-radius:8px; margin-bottom:15px;">
    <?php endif; ?>

<?php endif; ?>

           <label>Search Pixabay Media:</label>
    <input type="text" id="pixabaySearch" placeholder="Search for images/videos">
    <button type="button" id="searchBtn">Search</button><br><br>

    <div id="pixabayResults" style="display:flex; flex-wrap:wrap;"></div>

    <input type="hidden" name="media_url" id= "media_url">
    <input type="hidden" name="media_url_old" id= "media_url_old" value="<?php echo $post['media_url'];?>">
    <br>

    <button type="submit">Update Post</button>

</form>

</body>
<script src="./../../public/assets/js/app.js"></script>
</html>