<?php
session_start();
require_once "../../core/Helpers.php";
require_once '../../config.php';

$user_id = $_SESSION['auth_user']['user_id'] ?? 0;
$user_role = $_SESSION['auth_user']['role'] ?? "user";


$search = isset($_GET['search']) ? trim($_GET['search']) : "";


$limit = 10; // posts per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$query = "
    SELECT p.ID, p.Title, p.Slug, p.Created_at, u.name AS User_name
    FROM blog p
    JOIN users u ON p.User_id = u.ID
    WHERE p.Deleted_at IS NULL
";


if ($user_role !== "admin") {
    $query .= " AND p.User_id = :userid ";
}


if (!empty($search)) {
    $query .= " AND (p.Title LIKE :search OR p.Slug LIKE :search OR u.name LIKE :search) ";
}


$query .= " ORDER BY p.ID DESC LIMIT :offset, :limit";

$stmt = $pdo->prepare($query);

if ($user_role !== "admin") {
    $stmt->bindValue(':userid', $user_id, PDO::PARAM_INT);
}

if (!empty($search)) {
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}

$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

$stmt->execute();
$allPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);


$countQuery = "
    SELECT COUNT(*) FROM blog p
    JOIN users u ON p.User_id = u.ID
    WHERE p.Deleted_at IS NULL
";

if ($user_role !== "admin") {
    $countQuery .= " AND p.User_id = $user_id ";
}

if (!empty($search)) {
    $countQuery .= " AND (p.Title LIKE '%$search%' OR p.Slug LIKE '%$search%' OR u.name LIKE '%$search%' ) ";
}

$totalPosts = $pdo->query($countQuery)->fetchColumn();
$totalPages = ceil($totalPosts / $limit);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog List</title>
    <style>
        table { width:100%; border-collapse:collapse; }
        th, td { padding:10px; border:1px solid #ddd; }
        th { background:#f4f4f4; }
        .btn { padding:6px 12px; border-radius:4px; text-decoration:none; }
        .edit-btn { background:#0275d8; color:#fff; }
        .delete-btn { background:#d9534f; color:#fff; }
        .pagination a {
            padding:6px 12px;
            margin:3px;
            background:#0275d8;
            color:white;
            border-radius:4px;
            text-decoration:none;
        }
        .pagination span {
            padding:6px 12px;
            margin:3px;
            background:#333;
            color:white;
            border-radius:4px;
        }
        .search-box {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h2>All Blog</h2>

<a href="/public/create_post.php" class="btn edit-btn">Add New Blog</a>


<form method="GET" class="search-box">
    <input type="text" name="search" placeholder="Search blog..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit" class="btn edit-btn">Search</button>
    <?php if (!empty($search)): ?>
        <a href="list.php" class="btn delete-btn">Clear</a>
    <?php endif; ?>
</form>

<!-- Blog List Table -->
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

<!-- Pagination -->
<br>
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?search=<?= $search ?>&page=<?= $page - 1 ?>">Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == $page): ?>
            <span><?= $i ?></span>
        <?php else: ?>
            <a href="?search=<?= $search ?>&page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?search=<?= $search ?>&page=<?= $page + 1 ?>">Next</a>
    <?php endif; ?>
</div>

</body>
</html>