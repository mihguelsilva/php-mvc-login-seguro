<?php
namespace App\Controllers;

use \Core\Controller;
use \App\Middleware\Auth;
use \App\Helpers\Csrf;
use \App\Helpers\Flash;
use \App\Helpers\Sanitize;
use \App\Models\User;

class AdminController extends Controller
{
    public function index(): void
    {
        Auth::admin();

        $all = User::all();

        $this->view('dashboard', ['users'=>$all]);
        exit();
    }

    public function edit(): void
    {
        Auth::admin();

        $id = (int) Sanitize::int($_GET['id']) ?? '';

        $user = User::findById($id);

        $this->view('admin' . DS . 'edit', ['user'=>$user]);
        exit();
    }

    public function update(): void
    {
        Flash::checkSessionStart();
        Auth::admin();

        if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
            die('Erro de validação');
        }

        $id = (int) Sanitize::int($_POST['id']) ?? '';
        $username = Sanitize::string($_POST['username']) ?? '';
        $email = Sanitize::email($_POST['email']) ?? '';
        $group = Sanitize::string($_POST['group']) ?? '';

        if (User::updateUser($username, $email,(int) $id, $group)) {
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
        Flash::checkSessionStart();
        Auth::admin();

        if (!isset($_POST['csrf_token']) || !Csrf::validateToken($_POST['csrf_token'])) {
            die('Erro de validação');
        }

        $id = (int) Sanitize::int($_POST['id']) ?? '';

        if (User::deleteUser($id)) {
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