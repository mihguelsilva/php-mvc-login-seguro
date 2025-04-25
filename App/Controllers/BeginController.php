<?php
namespace App\Controllers;

use \Core\Controller;

class BeginController extends Controller
{
    public function getBegin(): void
    {
        session_start();
        $this->view('begin');
    }
}
?>