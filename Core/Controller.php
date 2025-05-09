<?php
namespace Core;

use \App\Core\SessionManager;

class Controller
{
    public function __construct(private SessionManager $session) {}
    /**
     * Método para carregar a view
     * @param string $view
     * @param array $data
     */
    public function view(string $view, array $data = []): string
    {
        $layout = [
            'check' => $this->session->get('user'),
            'admin' => $this->session->check('user', 'admin')
        ];
        $data = array_merge($layout, $data);
        extract($data);  // Converte as variáveis do array para variáveis
        // require_once "../App/Views/{$view}.php";
        ob_start();
        require dirname(__DIR__) . DS . 'App' . DS . 'Views' . DS. $view . '.php';
        return ob_get_clean();
    }
}
?>