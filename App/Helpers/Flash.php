<?php
namespace App\Helpers;

class Flash
{
    public static function checkSessionStart(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function set(string $key, string $message): void
    {
        self::checkSessionStart();
        $_SESSION['flash'][$key] = $message;
    }

    public static function get(string $key, string $message = ""): string
    {
        self::checkSessionStart();
        if (isset($_SESSION['flash'][$key])) {
            $message = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);    
        }
        return $message ?? null;
    }

    public static function display(): ?string
    {
        if ($msg = Flash::get('error')) {
             return '<div class="alert alert-danger">' . htmlspecialchars($msg) . '</div>';
        } else if ($msg = Flash::get('success')) {
            return '<div class="alert alert-success">' . htmlspecialchars($msg) . '</div>';
        } 
        return '';
    }

}
?>