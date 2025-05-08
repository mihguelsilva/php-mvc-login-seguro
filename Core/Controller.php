<?php
namespace Core;

class Controller
{
    /**
     * Método para carregar a view
     * @param string $view
     * @param array $data
     */
    public function view(string $view, array $data = []): string
    {
        extract($data);  // Converte as variáveis do array para variáveis
        // require_once "../App/Views/{$view}.php";
        ob_start();
        require dirname(__DIR__) . DS . 'App' . DS . 'Views' . DS. $view . '.php';
        return ob_get_clean();
    }
}
?>