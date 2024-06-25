<?php

namespace App\Repositories;

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Color.php';
require_once __DIR__ . '/../Models/UserColor.php';

use App\Models\User;
use App\Models\Color;
use App\Models\UserColor;

use PDO;

class UserColorRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function addColorsToUser($userId, $colorId)
    {
        $stmt = $this->connection->prepare("INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':color_id', $colorId);
        return $stmt->execute();
    }

    public function getUserColors($userId)
    {
        $stmt = $this->connection->prepare("SELECT c.* FROM colors c
                INNER JOIN user_colors uc ON c.id = uc.color_id
                WHERE uc.user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeColorsToUser($userId, $colorId)
    {
        $stmt = $this->connection->prepare("DELETE FROM user_colors WHERE user_id = :user_id AND color_id = :color_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':color_id', $colorId);
        return $stmt->execute();
    }

    public function checkLinkUserColor($user_id, $color_id)
    {
        $query = $this->connection->prepare("SELECT COUNT(*) as count FROM user_colors WHERE user_id = :user_id AND color_id = :color_id");
        $query->bindValue(':user_id', $user_id);
        $query->bindValue(':color_id', $color_id);
        $query->execute();
        $result = $query->fetch();
        return $result['count'] > 0;
    }

    public function getAllUserColors()
    {
        $query = $this->connection->query("SELECT user_id, color_id FROM user_colors");

        $userColors = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $userColors[$row['user_id']][] = $row['color_id'];
        }

        return $userColors;
    }
}
