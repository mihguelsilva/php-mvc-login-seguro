<?php
namespace Core;

class Acl
{
    public function __construct(private \App\Core\SessionManager $session) { }

    public function hasAccess(string $route): bool
    {

        $public = require ROOT_DIR . DS . 'config' . DS . 'public.php';

        if (in_array($route, $public)) {
            return true;
        }

        // Se não houver sessão ativa ou tipo de usuário, bloqueia
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['group'])) {
            return false;
        }

        $userGroup = $_SESSION['user']['group'] ?? 'user';

        $common = require ROOT_DIR . DS . 'config' . DS . 'common.php';
        $user = array_merge($common, require ROOT_DIR . DS . 'config' . DS . 'user.php');
        $admin = array_merge($user, require ROOT_DIR . DS . 'config' . DS . 'admin.php');
        
        $permissions = [
            'admin' => $admin,
            'user' => $user
        ];

        // Verifica se o tipo de usuário tem permissão para esta rota
        return in_array($route, $permissions[$userGroup] ?? []);
    }
}
?>