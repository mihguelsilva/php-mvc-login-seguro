<?php

namespace App\Core;

class SessionManager
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set(mixed $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function validate(): void
    {
        if (($this->get('LAST-ACTIVITY')) && (time() - (int) $this->get('LAST-ACTIVITY')) > SESSION_TIMEOUT) {
            $this->destroy();
        }

        $this->set('LAST-ACTIVITY', (int) time());
    }

    public function destroy(): void
    {
        session_unset();
        
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }

        session_destroy();
    }
}
