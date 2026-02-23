<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/* ---- ENV VARIABLES ---- */
define("DB_HOST", $_ENV['DB_HOST']);
define("DB_NAME", $_ENV['DB_NAME']);
define("DB_USER", $_ENV['DB_USER']);
define("DB_PASS", $_ENV['DB_PASS']);

define("JWT_SECRET", $_ENV['JWT_SECRET']);
define("JWT_EXPIRY", $_ENV['JWT_EXPIRY']);

define("PIXABAY_API_KEY", $_ENV['PIXABAY_API_KEY']);

$host = "localhost";
$port = "3307";
$dbname = "blog_portal";
$user = "root";
$pass = "";

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

try {
    
    $pdo = new PDO($dsn, $user, $pass);

    // Set error mode
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}



?>