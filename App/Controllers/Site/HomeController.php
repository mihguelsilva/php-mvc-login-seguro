<?php
namespace App\Controllers\Site;

use \App\Core\SessionManager;
use \Core\Controller;

class HomeController
{
    public function __construct (private SessionManager $session, private Controller $controller) {}

    public function get(): string
    {
        $user = $this->session->get('user');
        return $this->controller->view("home", ["nome"=>$user['username']]);
    }
}
?>