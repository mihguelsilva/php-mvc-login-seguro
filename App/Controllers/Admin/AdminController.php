<?php
namespace App\Controllers\Admin;

use App\Core\SessionManager;
use \Core\Controller;
use \App\Helpers\{Csrf, Flash, Sanitize};
use \App\Models\User;

class AdminController
{
    public function __construct(
        private SessionManager $session, 
        private User $userModel,
        private Csrf $csrf,
        private Flash $flash,
        private Controller $controller
        ) {}

    public function index(): string
    {
        $all = $this->userModel->all();
        return $this->controller->view('dashboard', [
            'users'=>$all,
            'display' => $this->flash->display(),
            'csrf' => $this->csrf->getTokenInput()
        ]);
    }

    public function edit(): string
    {
        $id = (int) Sanitize::int($_GET['id']) ?? '';

        $user = $this->userModel->findById($id);

        return $this->controller->view('admin' . DS . 'edit', [
            'user'=>$user,
            'display' => $this->flash->display(),
            'csrf' => $this->csrf->getTokenInput()
        ]);
    }

    public function update(): void
    {
        $this->csrf->verifyToken(htmlspecialchars($_POST['csrf_token']));

        $id = (int) Sanitize::int($_POST['id']) ?? '';
        $username = Sanitize::string($_POST['username']) ?? '';
        $email = Sanitize::email($_POST['email']) ?? '';
        $group = Sanitize::string($_POST['group']) ?? '';

        if ($this->userModel->updateUser($username, $email,(int) $id, $group)) {
            $this->flash->set('success', 'Dados do usuário atualizados com sucesso');
            header('Location: /admin/users/edit?id='.$id);
            exit();
        } else {
            $this->flash->set('error', 'Alguma coisa deu errado');
            $this->edit((int) $id);
            exit();
        }
    }

    public function delete(): void
    {
        $this->csrf->verifyToken(htmlspecialchars($_POST['csrf_token']));

        $id = (int) Sanitize::int($_POST['id']) ?? '';

        if ($this->userModel->deleteUser($id)) {
            $this->flash->set('success', 'Usuário deletado com sucesso');
            $this->index();
            exit();
        } else {
            $this->flash->set('error', 'Não foi possível deletar o usuário selecionado');
            $this->index();
            exit();
        }
    }
}
?>