<?php

namespace App\Controllers;

use \Core\{Controller, Response};
use \App\Core\SessionManager;
use \App\Models\User;
use \App\Helpers\{Flash, Csrf, Sanitize};

class LoginController extends Controller
{

    public function __construct(private SessionManager $session, private User $userModel) {}

    public function get(): string
    {
        return $this->view('login');
    }

    public function login(): void
    {
        Csrf::verifyToken($_POST['csrf_token']);

        $username = Sanitize::string($_POST['username']) ?? '';
        $password = Sanitize::string($_POST['password']) ?? '';

        if (empty($username || $password)) {
            Flash::set('error', 'Preencha todos os campos');
            (new Response(400, $this->view('login')))->send();
            return;
        }

        $user = $this->userModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id'=>$user['id'],
                'username'=>$user['username'],
                'email'=>$user['email'],
                'group'=>$user['group']
            ];

            header('Location: /home');
            exit();
        } else {
            Flash::set('error', 'Usuário ou senha incorretos');
            (new Response(401, $this->view('login')))->send();
            exit();
        }
    }

    public function logout(): void
    {
        $this->session->destroy();
        header("Location: /login");
        exit();
    }
}
