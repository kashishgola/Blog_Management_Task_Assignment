<?php
header("Content-Type: application/json");
require_once "../../config/config.php";

$query = urlencode($_GET["q"]);
$type = $_GET["type"] ?? "photo"; // photo or video

if ($type == "video") {
    $url = "https://pixabay.com/api/videos/?key=" . PIXABAY_API_KEY . "&q=" . $query;
} else {
    $url = "https://pixabay.com/api/?key=" . PIXABAY_API_KEY . "&q=" . $query;
}

echo file_get_contents($url);