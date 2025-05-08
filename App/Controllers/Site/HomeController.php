<?php
namespace App\Controllers\Site;

use \App\Core\SessionManager;
use \Core\Controller;

class HomeController extends Controller
{
    public function __construct (private SessionManager $session) {}

    public function get()
    {
        $user = $this->session->get('user');
        $this->view("home", ["nome"=>$user['username']]);
    }
}
?>