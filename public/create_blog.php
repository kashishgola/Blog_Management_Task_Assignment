<?php
session_start();
if (!isset($_SESSION['jwt'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Create Blog Post</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
        .blog-header {
            background: #fff;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }
        #pixabayResults img, 
        #pixabayResults video {
            width: 180px;
            height: 120px;
            object-fit: cover;
            margin: 5px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }
        #pixabayResults img:hover, 
        #pixabayResults video:hover {
            transform: scale(1.05);
            border: 2px solid #007BFF;
        }
        .preview-box {
            margin-top: 15px;
            display: none;
        }
        .preview-box img, 
        .preview-box video {
            max-width: 100%;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">My Blog</a>

            <div>
                <a href="dashboard.php" class="btn btn-outline-primary btn-sm">Dashboard</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        <h3 class="text-center mb-4 fw-bold">✍️ Create New Blog Post</h3>

        <div class="card shadow-sm p-4">
            <form action="/api/blog/store_blog.php" method="POST">

                <!-- Title -->
                <input type="text" name="title" id="title" class="form-control mb-3" placeholder="Post Title" required>

                <!-- Description -->
                <textarea id="body" name="description" class="form-control mb-3" rows="7" placeholder="Write your blog content..." required></textarea>

                <!-- Media Search Section -->
                <label class="fw-bold">Search Pixabay Media:</label>

                <div class="input-group mb-3">
                    <input type="text" id="pixabaySearch" class="form-control" placeholder="Search for images/videos">
                    <button type="button" id="searchBtn" class="btn btn-primary">Search</button>
                </div>

                <div id="pixabayResults" class="mb-3"></div>

                <!-- Preview Selected Media -->
                <div class="preview-box" id="previewBox">
                    <p class="fw-bold">Selected Media Preview:</p>
                    <div id="previewContent"></div>
                </div>

                <input type="hidden" name="media_url" id="media_url">

                <button type="submit" name="post_btn" class="btn btn-success w-100 mt-3">
                    Publish Blog Post
                </button>

            </form>
        </div>

    </div>

    <script src="./assets/js/app.js"></script>

</body>

</html>