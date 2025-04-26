<?php
namespace App\Controllers;

use \Core\Controller;
use \App\Helpers\SessionManager;

class BeginController extends Controller
{
    public function getBegin(): void
    {
        SessionManager::validateSessionTimeout();
        $this->view('begin');
    }
}
?>