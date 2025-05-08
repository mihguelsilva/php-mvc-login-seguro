<?php
namespace App\Controllers\Site;

use \App\Core\SessionManager;
use \Core\Controller;

class HomeController extends Controller
{
    public function __construct (private SessionManager $session) {}

    public function get(): string
    {
        $user = $this->session->get('user');
        return $this->view("home", ["nome"=>$user['username']]);
    }
}
?>