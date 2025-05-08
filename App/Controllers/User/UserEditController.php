<?php
namespace App\Controllers\User;

use \Core\Controller;
use \App\Helpers\{Csrf, Flash, Sanitize};
use \App\Models\User;

class UserEditController extends Controller
{
    public function __construct(private User $userModel) {}

    public function get(): void
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->findById($userId);

        $this->view('user' . DS . 'edit', ['user'=>$user]);
    }

    public function update(): void
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
            header('Location: /user/edit');
            exit();
        }

        if ($this->userModel->updateUser($username, $email, (int) $userId)) {
            Flash::set('success', 'Seus dados foram atualizados com sucesso');
            header('Location: /user/edit');
            exit();
        } else {
            Flash::set('error', 'Falha ao atualizar seus dados');
            header('Location: /user/edit');
            exit;
        }
    }
}
?>