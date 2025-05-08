<?php
namespace App\Models;

use \Core\Database;
use PDO;

class User
{
    private ?PDO $pdo = null;
    public function __construct (private Database $database) {
        $this->pdo = $this->database->connect();
    }
    public function findByUsername(string $username): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findById(string $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function createUser(string $username, string $email, string $password): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username,:email,:password)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", password_hash($password, PASSWORD_DEFAULT));
        return $stmt->execute();
    }

    public function updateUser(string $username, string $email, int $userId, string $group = 'user'): bool
    {
        $stmt = $this->pdo->prepare("UPDATE users SET username = :username, email = :email, `group` = :group WHERE id = :id");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":group", $group);
        $stmt->bindParam(":id", $userId);
        return $stmt->execute();
    }

    public function deleteUser(int $userId): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(":id", $userId);
        return $stmt->execute();
    }

    public function all(): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }
}
?>