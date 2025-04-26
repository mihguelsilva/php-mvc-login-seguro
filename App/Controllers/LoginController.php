<?php

namespace App\Controllers;

use \Core\Controller;
use \Core\Mailer;
use \App\Models\User;
use \App\Models\MensagemContato;
use \App\Helpers\Flash;
use \App\Helpers\Csrf;
use \App\Helpers\Sanitize;
use \App\Middleware\Auth;

class LoginController extends Controller
{

    public function getLogin(): void
    {
        $this->view('login');
    }

    public function getRegister(): void
    {
        $this->view('register');
    }

    public function getEditUser(): void
    {
        Auth::check();
        $userId = $_SESSION['user']['id'];
        $user = User::findById($userId);

        $this->view('user' . DS . 'edit', ['user'=>$user]);
    }

    public function getDelete(): void
    {
        Auth::check();
        $this->view('user' . DS . 'delete');
    }

    public function createUser(): void
    {

        if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
            die('Erro de validação');
        }

        $username = Sanitize::string($_POST['username']) ?? '';
        $email = Sanitize::email($_POST['email']) ?? '';
        $password = Sanitize::string($_POST['password']) ?? '';
        $confirmPassword = Sanitize::string($_POST['confirm_password']) ?? '';

        if (empty($username || $email || $password || $confirmPassword)) {
            Flash::set('error', 'Preencha todos os campos');
            $this->view('register');
            exit();
        }

        if ($password != $confirmPassword) {
            Flash::set('error', 'Senhas não coindicem');
            $this->view('register');
            exit();
        }

        $userVerify = User::findByUsername($username);
        $emailVerify = User::findByEmail($email);

        if ($userVerify != null) {
            Flash::set('error', 'Usuário já existe');
            $this->view('register');
            exit();
        }

        if ($emailVerify != null) {
            Flash::set('error', 'Email já existe');
            $this->view('register');
            exit();
        }

        User::createUser($username, $email, $password);

        $subject = 'Cadastro realizado com sucesso';
        $body = "<strong>Parabéns $email</strong>, <p>você acaba de se cadastrar no nosso sistema de login seguro<p>";
        Mailer::send($_ENV['MAIL_TO'], $subject, $body);

        MensagemContato::salvar([
            "nome"=>$username,
            "email"=>$email,
            "assunto"=>\htmlspecialchars($subject),
            "mensagem"=>nl2br(htmlspecialchars($body))
        ]);

        Flash::set('success', 'Usuário cadastrado com sucesso. Faça login!');
        $this->view('register');
        exit();
    }

    public function login(): void
    {
        if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
            die('Erro de validação');
        }

        $username = Sanitize::string($_POST['username']) ?? '';
        $password = Sanitize::string($_POST['password']) ?? '';

        if (empty($username || $password)) {
            Flash::set('error', 'Preencha todos os campos');
            $this->view('login');
            return;
        }

        $user = User::findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            session_start();

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
            $this->view('login');
            exit();
        }
    }

    public function updateUser()
    {
        Flash::checkSessionStart();

        if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
            die('Erro de validação');
        }

        $username = Sanitize::string($_POST['username']) ?? '';
        $email = Sanitize::email($_POST['email']) ?? '';
        $userId = (int) Sanitize::int($_SESSION['user']['id']);

        if (!isset($username) || !isset($email))
        {
            Flash::set('error', 'Preencha todos os campos');
            $this->getEditUser();
            exit();
        }

        if (User::updateUser($username, $email, (int) $userId)) {
            Flash::set('success', 'Seus dados foram atualizados com sucesso');
            $this->getEditUser();
            exit();
        } else {
            Flash::set('error', 'Falha ao atualizar seus dados');
            $this->getEditUser();
            exit;
        }
    }

    public function deleteUser()
    {
        Flash::checkSessionStart();

        if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
            die('Erro de validação');
        }

        $userId = (int) Sanitize::int($_SESSION['user']['id']);

        if (User::deleteUser($userId)) {
            $this->logout();
            exit();
        } else {
            Flash::set('error', 'Erro durante deleção do usuário');
            $this->getDelete();
            exit();
        }
    }

    public function logout(): void
    {
        session_start();
        session_unset();              // Remove todas as variáveis de sessão
        session_destroy();            // Destroi a sessão
        header("Location: /login");
    }
}
