<?php

namespace App\Controllers\User;

use \Core\{Controller, Response};
use \App\Helpers\{Csrf, Flash, Sanitize};
use \App\Models\User;

class UserEditController
{
    public function __construct(
        private User $userModel, 
        private Csrf $csrf, 
        private Flash $flash,
        private Controller $controller
        ) {}

    public function get(): string
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->findById($userId);

        return $this->controller->view('user' . DS . 'edit', [
            'user' => $user,
            'display' => $this->flash->display(),
            'csrf' => $this->csrf->getTokenInput()
        ]);
    }

    public function update(): void
    {
        $this->csrf->verifyToken(htmlspecialchars($_POST['csrf_token']));

        $username = Sanitize::string($_POST['username']) ?? '';
        $email = Sanitize::email($_POST['email']) ?? '';
        $userId = (int) Sanitize::int($_SESSION['user']['id']);

        if (!isset($username) || !isset($email)) {
            $this->flash->set('error', 'Preencha todos os campos');
            header('Location: /user/edit');
            exit();
        }

        if ($this->userModel->updateUser($username, $email, (int) $userId)) {
            $this->flash->set('success', 'Seus dados foram atualizados com sucesso');
            header('Location: /user/edit');
            exit();
        } else {
            $this->flash->set('error', 'Falha ao atualizar seus dados');
            header('Location: /user/edit');
            exit;
        }
    }
}
