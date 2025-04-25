<?php
namespace Core;

class Controller
{
    /**
     * Método para carregar a view
     * @param string $view
     * @param array $data
     */
    public function view(string $view, array $data = []): void
    {
        extract($data);  // Converte as variáveis do array para variáveis
        require_once "../App/Views/{$view}.php";
    }
}
?>