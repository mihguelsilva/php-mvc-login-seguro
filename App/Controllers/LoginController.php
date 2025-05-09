<?php

namespace App\Controllers;

use \Core\{Controller, Response};
use \App\Core\SessionManager;
use \App\Models\User;
use \App\Helpers\{Flash, Csrf, Sanitize};

class LoginController
{

    public function __construct(
        private SessionManager $session, 
        private User $userModel,
        private Csrf $csrf, 
        private Flash $flash,
        private Controller $controller
        ) {}

    public function get(): string
    {
        return $this->controller->view('login', [
            'display' => $this->flash->display(),
            'csrf' => $this->csrf->getTokenInput()
        ]);
    }

    public function login(): void
    {
        $this->csrf->verifyToken($_POST['csrf_token']);

        $username = Sanitize::string($_POST['username']) ?? '';
        $password = Sanitize::string($_POST['password']) ?? '';

        if (empty($username || $password)) {
            $this->flash->set('error', 'Preencha todos os campos');
            (new Response(400, $this->$this->get()))->send();
            exit();
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
            $this->flash->set('error', 'Usuário ou senha incorretos');
            (new Response(401, $this->get()))->send();
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
