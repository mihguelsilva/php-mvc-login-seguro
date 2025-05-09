<?php
namespace App\Controllers\User;

use \Core\{Controller, Mailer, Response};
use \App\Helpers\{Csrf, Flash, Sanitize};
use \App\Models\{MensagemContato, User};

class UserRegisterController
{
    public function __construct(
        private User $userModel, 
        private MensagemContato $mensagemContato,
        private Csrf $csrf, 
        private Flash $flash,
        private Controller $controller
        ) {}

    public function get(): string
    {
        return $this->controller->view('register', [
            'display' => $this->flash->display(),
            'csrf' => $this->csrf->getTokenInput()
        ]);
    }

    public function create(): void
    {
        $this->csrf->verifyToken(htmlspecialchars($_POST['csrf_token']));

        $username = Sanitize::string($_POST['username']) ?? '';
        $email = Sanitize::email($_POST['email']) ?? '';
        $password = Sanitize::string($_POST['password']) ?? '';
        $confirmPassword = Sanitize::string($_POST['confirm_password']) ?? '';

        if (empty($username || $email || $password || $confirmPassword)) {
            $this->flash->set('error', 'Preencha todos os campos');
            (new Response(400, $this->controller->view('register')))->send();
            exit();
        }

        if ($password != $confirmPassword) {
            $this->flash->set('error', 'Senhas não coindicem');
            (new Response(400, $this->controller->view('register')))->send();
            exit();
        }

        $userVerify = $this->userModel->findByUsername($username);
        $emailVerify = $this->userModel->findByEmail($email);

        if ($userVerify != null) {
            $this->flash->set('error', 'Usuário já existe');
            (new Response(409, $this->controller->view('register')))->send();
            exit();
        }

        if ($emailVerify != null) {
            $this->flash->set('error', 'Email já existe');
            (new Response(409, $this->controller->view('register')))->send();
            exit();
        }

        $this->userModel->createUser($username, $email, $password);

        $subject = 'Cadastro realizado com sucesso';
        $body = "<strong>Parabéns $email</strong>, <p>você acaba de se cadastrar no nosso sistema de login seguro<p>";
        Mailer::send($_ENV['MAIL_TO'], $subject, $body);

        $this->mensagemContato->salvar([
            "nome"=>$username,
            "email"=>$email,
            "assunto"=>\htmlspecialchars($subject),
            "mensagem"=>nl2br(htmlspecialchars($body))
        ]);

        $this->flash->set('success', 'Usuário cadastrado com sucesso. Faça login!');
        (new Response(201, $this->controller->view('register')))->send();
        exit();
    }
}
?>