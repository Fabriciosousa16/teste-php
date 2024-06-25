<?php

namespace App\Repositories;

use PDO;

class ReportRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getUsers()
    {
        $sql = "SELECT id, name FROM users";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getColors()
    {
        $sql = "SELECT id, name FROM colors";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFilteredResults($userId, $colorId)
    {
        $sql = "SELECT u.name AS user_name, 
                COALESCE(c.name, 'Usuário não possui cor vinculada') AS color_name
                FROM users u
                LEFT JOIN user_colors uc ON u.id = uc.user_id
                LEFT JOIN colors c ON uc.color_id = c.id
                WHERE (:user_id = 'all' OR u.id = :user_id)
                AND (:color_id = 'all' OR c.id = :color_id)
                ORDER BY u.name, c.name";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':color_id', $colorId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
