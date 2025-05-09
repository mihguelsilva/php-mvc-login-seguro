<?php
namespace App\Controllers\Site;

use \Core\Controller;
use \App\Core\SessionManager;

class PaginaPrincipalController
{
    public function __construct(private SessionManager $session, private Controller $controller) {}

    public function get(): string
    {
        $this->session->validate();
        return $this->controller->view('begin');
    }
}
?>