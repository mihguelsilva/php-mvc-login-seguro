<?php
namespace App\Models;

use \Core\Database;
use PDO;

class User
{
    public static function findByUsername(string $username): ?array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function findByEmail(string $email): ?array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function findById(string $id): ?array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function createUser(string $username, string $email, string $password): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username,:email,:password)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", password_hash($password, PASSWORD_DEFAULT));
        return $stmt->execute();
    }

    public static function updateUser(string $username, string $email, int $userId, string $group = 'user'): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, `group` = :group WHERE id = :id");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":group", $group);
        $stmt->bindParam(":id", $userId);
        return $stmt->execute();
    }

    public static function deleteUser(int $userId): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(":id", $userId);
        return $stmt->execute();
    }

    public static function all(): ?array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }
}
?>