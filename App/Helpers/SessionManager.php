<?php
namespace App\Helpers;

class SessionManager
{
    public static function checkSessionStart(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function validateSessionTimeout(): void
    {
        self::checkSessionStart();

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > SESSION_TIMEOUT) {
            session_unset();
            session_destroy();
            header("Location: /login");
            exit();
        }

        $_SESSION['LAST_ACTIVITY'] = time();
    }
}
?>