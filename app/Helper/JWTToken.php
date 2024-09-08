<?php

namespace App\Helper;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {
    public static function CreateToken($userEmail, $id) {
        $key = env('JWT_SECRET_KEY');

        $payload = [
            'iss' => 'Apple Shop',
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24,
            'userEmail' => $userEmail,
            'id' => $id,
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    public static function ReadToken($token) {
        try {
            if ($token == null) {
                return "unauthorized";
            } else {
                $key = env('JWT_SECRET_KEY');
                return JWT::decode($token, new Key($key, 'HS256'));
            }
        } catch (Exception $e) {
            return "unauthorized";
        }
    }
}