<?php
require_once __DIR__ . "/JWTHandler.php";

class AuthMiddleware {

    public static function protect() {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            exit(json_encode(["error" => "Token missing"]));
        }

        $token = str_replace("Bearer ", "", $headers["Authorization"]);

        $decoded = JWTHandler::verify($token);

        if (!$decoded) {
            http_response_code(403);
            exit(json_encode(["error" => "Invalid or expired token"]));
        }

        return $decoded; // contains sub, role
    }

    public static function requireAdmin($decoded) {
        if ($decoded->role !== "admin") {
            http_response_code(403);
            exit(json_encode(["error" => "Admin access only"]));
        }
    }
}