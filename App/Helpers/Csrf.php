<?php
namespace App\Helpers;

class Csrf
{
    private static function generateToken(): string
    {
        Flash::checkSessionStart();

        if(empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function validateToken(string $token): bool
    {
        Flash::checkSessionStart();
        return hash_equals($_SESSION['csrf_token'] ?? '', $token);
    }

    public static function getTokenInput(): string
    {
        $token = self::generateToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
    }
}
?>