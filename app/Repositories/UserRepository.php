<?php

namespace App\Repositories;

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/UserColor.php';


use PDO;
use App\Models\User;
use App\Models\UserColor;

class UserRepository
{

    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM users");

        $users = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = new User();
            $user->setId($row['id']);
            $user->setName($row['name']);
            $user->setEmail($row['email']);
            $users[] = $user;
        }

        return $users;
    }

    public function getById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $stmt->fetch();
    }

    public function create(User $user)
    {
        $stmt = $this->connection->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->execute(['name' => $user->getName(), 'email' => $user->getEmail()]);
    }

    public function update(User $user)
    {
        $stmt = $this->connection->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $stmt->execute(['name' => $user->getName(), 'email' => $user->getEmail(), 'id' => $user->getId()]);
    }

    public function delete($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function addColorToUser($userId, $colorId)
    {
        $stmt = $this->connection->prepare("INSERT INTO user_color (user_id, color_id) VALUES (:user_id, :color_id)");
        $stmt->execute(['user_id' => $userId, 'color_id' => $colorId]);
    }

    public function checkUpdateUser($id, $email)
    {
        $query = $this->connection->prepare("SELECT COUNT(*) as count FROM users WHERE email = :email AND id != :id");
        $query->bindValue(':email', $email);
        $query->bindValue(':id', $id);
        $query->execute();
        $result = $query->fetch();
        return $result['count'] > 0;
    }

    public function checkDeleteUser($id)
    {
        $query = $this->connection->prepare("SELECT COUNT(*) as count FROM user_colors WHERE user_id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $result = $query->fetch();
        return $result['count'] > 0;
    }

    public function checkEmail($email)
    {
        $query = $this->connection->prepare("SELECT COUNT(*) as count FROM users WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();
        $result = $query->fetch();
        return $result['count'] > 0;
    }
}
