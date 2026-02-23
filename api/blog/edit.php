<?php
session_start();
require_once "../../core/Helpers.php";
require_once '../../config.php';

// Validate ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request: missing ID");
}
$id = intval($_GET['id']);

// Fetch post
$stmt = $pdo->prepare("SELECT * FROM blog WHERE ID = ?");
$stmt->execute([$id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    die("blog not found!");
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = Helpers::cleanText($_POST['title']);
    $description = Helpers::sanitizeHTML($_POST['description']);
    $media_url = filter_var($_POST['media_url'] ?? null, FILTER_SANITIZE_URL); 

    $slug = Helpers::generateSlug($title);

    if(empty($media_url)){
        $media_url       = filter_var($_POST['media_url_old'] ?? null, FILTER_SANITIZE_URL);
    }

    $update = $pdo->prepare("
        UPDATE blog 
        SET Title=?, Description=?, Media_url=?, Slug=? 
        WHERE ID=?
    ");
    $update->execute([$title, $description, $media_url, $slug, $id]);

    $_SESSION['success'] = "blog updated successfully!";
    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Blog Post</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f8f9fa; }
        #pixabayResults img, #pixabayResults video {
            width: 160px;
            height: 110px;
            object-fit: cover;
            margin: 5px;
            border-radius: 6px;
            cursor: pointer;
        }
        #pixabayResults img:hover, #pixabayResults video:hover {
            transform: scale(1.05);
            border: 2px solid #007BFF;
        }
        .current-media img, .current-media video {
            width: 220px;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold">My Blog</a>
        <div>
            <a href="../dashboard.php" class="btn btn-outline-primary btn-sm">Dashboard</a>
            <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <h3 class="text-center fw-bold mb-4">✏️ Edit Blog Post</h3>

    <div class="card shadow-sm p-4">

        <form method="POST">

            <!-- Title -->
            <label class="fw-bold">Title</label>
            <input type="text" 
                   name="title" 
                   class="form-control mb-3" 
                   value="<?= htmlspecialchars($blog['Title']) ?>"
                   required>

            <!-- Description -->
            <label class="fw-bold">Description</label>
            <textarea name="description" 
                      rows="6" 
                      class="form-control mb-3" 
                      required><?= htmlspecialchars($blog['Description']) ?></textarea>

            <!-- Current Thumbnail -->
            <?php if (!empty($blog['media_url'])): ?>
                <label class="fw-bold">Current Thumbnail:</label>
                <div class="current-media mb-3">
                    <?php if (preg_match('/\.(mp4|mov|webm)$/i', $blog['media_url'])): ?>
                        <video src="<?= $blog['media_url'] ?>" controls></video>
                    <?php else: ?>
                        <img src="<?= $blog['media_url'] ?>">
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Search Pixabay -->
            <label class="fw-bold">Search New Media (Optional):</label>
            <div class="input-group mb-3">
                <input type="text" id="pixabaySearch" class="form-control" placeholder="Search images/videos">
                <button type="button" id="searchBtn" class="btn btn-primary">Search</button>
            </div>

            <div id="pixabayResults"></div>

            <input type="hidden" name="media_url" id="media_url" value="<?= $blog['media_url'] ?>">

            <!-- Submit -->
            <button type="submit" class="btn btn-success w-100 mt-3">Update Blog</button>

        </form>

    </div>
</div>

<script src="./../../public/assets/js/app.js"></script>

</body>
</html>