<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHandler {

    public static function generate($user_id, $role) {
        $payload = [
            "sub" => $user_id,
            "role" => $role,
            "exp" => time() + JWT_EXPIRY
        ];

        return JWT::encode($payload, JWT_SECRET, "HS256");
    }

    public static function verify($token) {
        try {
            return JWT::decode($token, new Key(JWT_SECRET, 'HS256'));
        } catch(Exception $e) {
            return false;
        }
    }
}