<?php
namespace App\Controllers\User;

use \Core\Controller;
use \App\Core\SessionManager;
use \App\Helpers\{Csrf, Flash, Sanitize};
use \App\Models\User;

class UserDeleteController extends Controller
{
    public function __construct(private SessionManager $session, private User $userModel) {}

    public function get(): void
    {
        $this->view('user' . DS . 'delete');
    }

    public function delete(): void
    {
        Flash::checkSessionStart();

        if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
            die('Erro de validação');
        }

        $userId = (int) Sanitize::int($_SESSION['user']['id']);

        if ($this->userModel->deleteUser($userId)) {
            header('Location: /logout');
            exit();
        } else {
            Flash::set('error', 'Erro durante deleção do usuário');
            header('/user/delete');
            exit();
        }
    }
}
?>