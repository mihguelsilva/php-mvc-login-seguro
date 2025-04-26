<?php
namespace App\Middleware;

use \App\Helpers\SessionManager;

class Auth
{
    public static function check(): void
    {
        SessionManager::validateSessionTimeout();
        
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit();
        }
    }

    public static function admin(): void
    {
        SessionManager::validateSessionTimeout();
        if ($_SESSION['user']['group'] != 'admin') {
            header('Location: /home');
            exit();
        } 
    }
}
?>