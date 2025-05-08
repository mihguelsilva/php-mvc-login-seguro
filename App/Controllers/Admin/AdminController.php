<?php
namespace App\Controllers\Admin;

use App\Core\SessionManager;
use \Core\Controller;
use \App\Helpers\{Csrf, Flash, Sanitize};
use \App\Models\User;
use SessionHandler;

class AdminController extends Controller
{
    public function __construct(private SessionManager $session, private User $userModel) {}

    public function index(): void
    {
        $all = $this->userModel->all();

        $this->view('dashboard', ['users'=>$all]);
        exit();
    }

    public function edit(): void
    {
        $id = (int) Sanitize::int($_GET['id']) ?? '';

        $user = $this->userModel->findById($id);

        $this->view('admin' . DS . 'edit', ['user'=>$user]);
        exit();
    }

    public function update(): void
    {
        if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
            die('Erro de validação');
        }

        $id = (int) Sanitize::int($_POST['id']) ?? '';
        $username = Sanitize::string($_POST['username']) ?? '';
        $email = Sanitize::email($_POST['email']) ?? '';
        $group = Sanitize::string($_POST['group']) ?? '';

        if ($this->userModel->updateUser($username, $email,(int) $id, $group)) {
            Flash::set('success', 'Dados do usuário atualizados com sucesso');
            header('Location: /admin/users/edit?id='.$id);
            exit();
        } else {
            Flash::set('error', 'Alguma coisa deu errado');
            $this->edit((int) $id);
            exit();
        }
    }

    public function delete(): void
    {
        if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
            die('Erro de validação');
        }

        $id = (int) Sanitize::int($_POST['id']) ?? '';

        if ($this->userModel->deleteUser($id)) {
            Flash::set('success', 'Usuário deletado com sucesso');
            $this->index();
            exit();
        } else {
            Flash::set('error', 'Não foi possível deletar o usuário selecionado');
            $this->index();
            exit();
        }
    }
}
?>