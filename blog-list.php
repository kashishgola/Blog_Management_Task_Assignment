<?php
session_start();
require_once "../../core/Helpers.php";
require_once '../../config.php';

// Getting user data from session
$user_id = $_SESSION['auth_user']['user_id'] ?? 0;
$user_role = $_SESSION['auth_user']['role'] ?? 0;

    // Fetch posts from database
    $query = "SELECT p.ID, p.Title, p.Slug, p.Created_at, 
                    u.name AS User_name 
            FROM blog p
            JOIN users u ON p.User_id = u.ID";

    if ($user_role !== "admin") {
    $query .= " WHERE p.User_id = $user_id AND p.Deleted_at IS NULL";
} else {
    $query .= " WHERE p.Deleted_at IS NULL";
}

$query .= " ORDER BY p.ID DESC";

$stmt = $pdo->query($query);
$allPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background: #f4f4f4;
        }
        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .edit-btn { background: #0275d8; color: #fff; }
        .delete-btn { background: #d9534f; color: #fff; }
    </style>
</head>
<body>

<h2>All Blog</h2>

<a href="/public/create_post.php" class="btn edit-btn">Add New Blog</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Author</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($allPosts)) : ?>
            <?php foreach ($allPosts as $post) : ?>
                <tr>
                    <td><?= $post['ID'] ?></td>
                    <td><?= htmlspecialchars($post['Title']) ?></td>
                    <td><?= htmlspecialchars($post['Slug']) ?></td>
                    <td><?= htmlspecialchars($post['User_name']) ?></td>
                    <td><?= $post['Created_at'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $post['ID'] ?>" class="btn edit-btn">Edit</a>
                        <a href="delete.php?id=<?= $post['ID'] ?>" 
                           class="btn delete-btn"
                           onclick="return confirm('Are you sure you want to delete this post?')">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6" style="text-align:center;">No Blog Found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>