<?php
namespace App\Helpers;

class Csrf
{
    private static function generateToken(): string
    {
        Flash::checkSessionStart();

        if(empty($_SESSION['csrf_token']) || $_SESSION['csrf_token_expire'] < time()) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $_SESSION['csrf_token_expire'] = time() + 1800;
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

    public static function verifyToken(?string $token): void
    {
        if (empty($token) || !self::validateToken($token)) {
            (new \Core\Response(419, ['error' => 'Token CSRF inválido ou ausente'],'application/json'))->send();
        }
    }
}
?>