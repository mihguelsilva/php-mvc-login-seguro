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
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function findById(string $id): ?array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function create(string $username, string $email, string $password): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
        return $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
    }

    public static function updateUser(string $username, string $email, int $userId, string $group = 'user'): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, `group` = ? WHERE id = ?");
        return $stmt->execute([$username, $email, $group, $userId]);
    }

    public static function deleteUser(int $userId): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$userId]);
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