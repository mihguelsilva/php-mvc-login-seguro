<?php
namespace App\Helpers;

use \App\Core\SessionManager;

class Flash
{
    public function __construct(private SessionManager $session) {}
    
    public function set(string $key, string $message): void
    {
        $this->session->set($key, $message);
    }

    public function get(string $key, string $message = ""): string
    {
        if ($this->session->get($key)) {
            $message = $this->session->get($key);
            $this->session->unset($key);
        }
        return $message ?? null;
    }

    public function display(): ?string
    {
        if ($msg = $this->get('error')) {
             return '<div class="alert alert-danger">' . htmlspecialchars($msg) . '</div>';
        } else if ($msg = $this->get('success')) {
            return '<div class="alert alert-success">' . htmlspecialchars($msg) . '</div>';
        } 
        return '';
    }

}
?>