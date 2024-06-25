<?php

namespace App\Repositories;

use PDO;

class DashboardRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getTotalUsers()
    {
        $query = $this->connection->query("SELECT COUNT(*) AS total FROM users");
        return $query->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalColors()
    {
        $query = $this->connection->query("SELECT COUNT(*) AS total FROM colors");
        return $query->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalUsersWithColors()
    {
        $query = $this->connection->query("SELECT COUNT(DISTINCT user_id) AS total FROM user_colors");
        return $query->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getUserColorRanking()
    {
        $query = $this->connection->query(
            "SELECT u.name,u.email, COUNT(uc.color_id) AS total_colors
             FROM users u
             INNER JOIN user_colors uc ON u.id = uc.user_id
             GROUP BY u.id
             ORDER BY total_colors DESC"
        );
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserNotColorRanking()
    {
        $query = $this->connection->query(
            "SELECT u.name, u.email, 0 AS total_colors
                 FROM users u
                 LEFT JOIN user_colors uc ON u.id = uc.user_id
                 WHERE uc.user_id IS NULL
                 ORDER BY u.id"
        );
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
