<?php

namespace App\Repositories;

require_once __DIR__ . '/../Models/Color.php';

use PDO;
use App\Models\Color;

class ColorRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM colors");

        $colors = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $color = new color();
            $color->setId($row['id']);
            $color->setName($row['name']);
            $colors[] = $color;
        }

        return $colors;
    }

    public function getById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM colors WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Color::class);
        return $stmt->fetch();
    }

    public function create(Color $color)
    {
        $stmt = $this->connection->prepare("INSERT INTO colors (name) VALUES (:name)");
        $stmt->execute(['name' => $color->getName()]);
    }

    public function update(Color $color)
    {
        $stmt = $this->connection->prepare("UPDATE colors SET name = :name  WHERE id = :id");
        $stmt->execute(['name' => $color->getName(),  'id' => $color->getId()]);
    }

    public function delete($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM colors WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function checkUpdateColor($id, $name)
    {
        $query = $this->connection->prepare("SELECT COUNT(*) as count FROM colors WHERE name = :name AND id != :id");
        $query->bindValue(':name', $name);
        $query->bindValue(':id', $id);
        $query->execute();
        $result = $query->fetch();
        return $result['count'] > 0;
    }

    public function checkDeleteColor($id)
    {
        $query = $this->connection->prepare("SELECT COUNT(*) as count FROM user_colors WHERE color_id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $result = $query->fetch();
        return $result['count'] > 0;
    }

    public function checkColor($name)
    {
        $query = $this->connection->prepare("SELECT COUNT(*) as count FROM colors WHERE name = :name");
        $query->bindValue(':name', $name);
        $query->execute();
        $result = $query->fetch();
        return $result['count'] > 0;
    }

    public function getAllById($userId)
    {
        $stmt = $this->connection->prepare("SELECT user_colors.user_id, users.name AS user_name, colors.id as color_id, colors.name 
                FROM user_colors 
                INNER JOIN colors ON user_colors.color_id = colors.id 
                INNER JOIN users ON user_colors.user_id = users.id 
                WHERE user_colors.user_id = :user_id");

        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
