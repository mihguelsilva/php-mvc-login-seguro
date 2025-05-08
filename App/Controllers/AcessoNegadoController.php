<?php
namespace App\Controllers;

class AcessoNegadoController
{
    public function index(): void
    {
        echo '<h1>Acesso negado ❌</h1>';
        echo '<p>Você não tem permissão para acessar esta página.</p>';
        echo '<a href="/">Voltar para a página inicial</a>';
    }
}
?>