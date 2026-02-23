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
    <title>Create Post</title>
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
         <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">My Post</a>

            <div>
                <a href="dashboard.php" class="btn btn-outline-primary btn-sm">Dashboard</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mt-4">

        <h3 class="text-center mb-4 fw-bold">✍️ Create New Post</h3>
        <hr>
        <div class="card-body">
            <form action="/api/posts/create.php" method="POST">
                <input type="text" name="title" id="title" class="form-control mb-3" placeholder="Post Title" required>

                <textarea id="body" name="description" class="form-control mb-3" rows="7" placeholder="Post Content" required></textarea>

                <label>Search Pixabay Media:</label>
                <input type="text" id="pixabaySearch" placeholder="Search for images/videos" required>
                <button type="button" id="searchBtn">Search</button><br><br>

                <div id="pixabayResults" style="display:flex; flex-wrap:wrap;"></div>

                <input type="hidden" name="media_url" id="media_url" required>
                <br>

                <div class="form-group">
                    <button type="submit" name="post_btn" class="btn btn-primary w-100" onclick="createPost()">Create Post</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./assets/js/app.js"></script>
</body>

</html>