<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

use Firebase\JWT\JWT;

if(isset($_POST['login_now_btn'])){

 

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT ID, Name, Email, Password FROM users WHERE Email = ? LIMIT 1");
$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

//echo "<pre>";print_r($user);die;
    if ($user && password_verify($password, $user['Password'])) {

            $uid = $user['ID'];
             $name = $user['Name'];
             $email = $user['Email'];  
             $role = $user['Role'];  

            // Create JWT Token
            $payload = [    
                "user_id" => $uid,
                "name" => $name,
                "email" => $email,
                "iat" => time(),
                "exp" => time() + 3600 // token valid for 1 hr
            ];

            $jwt = JWT::encode($payload, "d63f5a3e48604493a1584f2505539804db8ae2b340648b4b7c13c2f9211ede26", 'HS256');

            // Store in PHP session (optional)
            $_SESSION['jwt'] = $jwt;
            $_SESSION['is_login'] = true;
            $_SESSION['auth_user'] = [
                'user_id' => $uid,
                'name' => $name,
                'email' => $email,
                'role' => $role
            ];

            header("Location: dashboard.php");
            exit();
        
    }

    $_SESSION['status'] = "Invalid Email or Password!";
    header("Location: login.php");  
    exit();
}