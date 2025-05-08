<?php
namespace App\Models;

use \Core\Database;
use PDO;

class MensagemContato
{
    private ?PDO $pdo = null;
    public function __construct(private Database $database) {
        $this->pdo = $this->database->connect();
    }
    public function salvar(array $dados): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO mensagens_contato (nome, email, assunto, mensagem) VALUES (:nome, :email, :assunto, :mensagem)");
        $stmt->bindValue(":nome", $dados['nome']);
        $stmt->bindValue(":email", $dados['email']);
        $stmt->bindValue(":assunto", $dados['assunto']);
        $stmt->bindValue(":mensagem", $dados['mensagem']);
        return $stmt->execute();
    }
}
?>