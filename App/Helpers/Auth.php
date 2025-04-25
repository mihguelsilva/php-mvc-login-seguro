<?php
namespace App\Helpers;

class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function user(): array
    {
        return $_SESSION['user'] ?? [];
    }

    public static function admin(): bool
    {
        return $_SESSION['user']['group'] === 'admin';
    }
}
?>