<?php
namespace App\Middleware;

class Auth
{
    public static function check(): void
    {
        session_start();
        
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit();
        }
    }

    public static function admin(): void
    {
        session_start();
        if ($_SESSION['user']['group'] != 'admin') {
            header('Location: /home');
            exit();
        } 
    }
}
?>