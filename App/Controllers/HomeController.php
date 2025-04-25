<?php
namespace App\Controllers;

use \Core\Controller;
use \App\Middleware\Auth;

class HomeController extends Controller
{
    public function getHome()
    {
        Auth::check();
        $user = \App\Helpers\Auth::user();
        $this->view("home", ["nome"=>$user['username']]);
    }
}
?>