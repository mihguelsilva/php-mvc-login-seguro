<?php
namespace App\Controllers\User;

use \Core\Controller;
use \App\Core\SessionManager;
use \App\Helpers\{Csrf, Flash, Sanitize};
use \App\Models\User;

class UserDeleteController
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
        return $this->controller->view('user' . DS . 'delete', [
            'display' => $this->flash->display(),
            'csrf' => $this->csrf->getTokenInput()
        ]);
    }

    public function delete(): void
    {
        $this->csrf->verifyToken(htmlspecialchars($_POST['csrf_token']));

        $userId = (int) Sanitize::int($_SESSION['user']['id']);

        if ($this->userModel->deleteUser($userId)) {
            header('Location: /logout');
            exit();
        } else {
            $this->flash->set('error', 'Erro durante deleção do usuário');
            header('/user/delete');
            exit();
        }
    }
}
?>