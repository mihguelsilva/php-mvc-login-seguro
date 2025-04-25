<?php
namespace App\Models;

use \Core\Database;

class MensagemContato
{
    public static function salvar(array $dados): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO mensagens_contato (nome, email, assunto, mensagem) VALUES (:nome, :email, :assunto, :mensagem)");
        $stmt->bindValue(":nome", $dados['nome']);
        $stmt->bindValue(":email", $dados['email']);
        $stmt->bindValue(":assunto", $dados['assunto']);
        $stmt->bindValue(":mensagem", $dados['mensagem']);
        return $stmt->execute();
    }
}
?>