<?php
namespace App\Controllers\Site;

use \Core\Controller;
use \App\Core\SessionManager;

class PaginaPrincipalController extends Controller
{
    public function __construct(private SessionManager $session) {}

    public function get(): string
    {
        $this->session->validate();
        return $this->view('begin');
    }
}
?>