<?php
namespace App\Controllers\User;

use \Core\{Controller, Mailer};
use \App\Helpers\{Csrf, Flash, Sanitize};
use \App\Models\{MensagemContato, User};

class UserRegisterController extends Controller
{
    public function __construct(private User $userModel, private MensagemContato $mensagemContato) {}

    public function get(): void
    {
        $this->view('register');
    }

    public function create(): void
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

        $userVerify = $this->userModel->findByUsername($username);
        $emailVerify = $this->userModel->findByEmail($email);

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

        Flash::set('success', 'Usuário cadastrado com sucesso. Faça login!');
        $this->view('register');
        exit();
    }
}
?>