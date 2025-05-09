<?php
namespace App\Helpers;

use \App\Core\SessionManager;

class Csrf
{
    public function __construct(private SessionManager $session) {}

    private function generateToken(): string
    {
        if(empty($this->session->get('csrf_token')) || $this->session->get('csrf_token_expire') < time()) {
            $this->session->set('csrf_token', bin2hex(random_bytes(32)));
            $this->session->set('csrf_token_expire', time() + 1800);
        }
        return $_SESSION['csrf_token'];
    }

    public function validateToken(string $token): bool
    {
        return hash_equals($this->session->get('csrf_token') ?? '', $token);
    }

    public function getTokenInput(): string
    {
        $token = $this->generateToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
    }

    public function verifyToken(?string $token): void
    {
        if (empty($token) || !$this->validateToken($token)) {
            (new \Core\Response(419, ['error' => 'Token CSRF inválido ou ausente'],'application/json'))->send();
        }
    }
}
?>