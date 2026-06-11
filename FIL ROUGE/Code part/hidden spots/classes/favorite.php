<?php

require_once __DIR__ . '/../config/database.php';

class Favorite {

    private $DbConn;

    public function __construct() {
        $this->DbConn = Database::getInstance()->getConnection();
    }

    //  Check if place is already in favorites
    public function isFavorite($user_id, $place_id) {

        $sql = "SELECT id FROM favorites 
                WHERE user_id = :user_id AND place_id = :place_id
                LIMIT 1";

        $stmt = $this->DbConn->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'place_id' => $place_id
        ]);

        return $stmt->fetch() ? true : false;
    }

    //  Add to favorites
    public function add($user_id, $place_id) {

        $sql = "INSERT INTO favorites (user_id, place_id)
                VALUES (:user_id, :place_id)";

        $stmt = $this->DbConn->prepare($sql);

        try {
            return $stmt->execute([
                'user_id' => $user_id,
                'place_id' => $place_id
            ]);
        } catch (PDOException $e) {
            // ignore duplicate (UNIQUE constraint handles it)
            return false;
        }
    }

    //  Remove from favorites
    public function remove($user_id, $place_id) {

        $sql = "DELETE FROM favorites 
                WHERE user_id = :user_id AND place_id = :place_id";

        $stmt = $this->DbConn->prepare($sql);

        return $stmt->execute([
            'user_id' => $user_id,
            'place_id' => $place_id
        ]);
    }

    // 📌 Get all favorite places of user
    public function getUserFavorites($user_id) {

        $sql = "SELECT p.*, 
                       c.name AS category_name,
                       (SELECT image_path 
                        FROM place_images 
                        WHERE place_id = p.id 
                        LIMIT 1) AS image
                FROM places p
                JOIN categories c ON p.category_id = c.id
                JOIN favorites f ON f.place_id = p.id
                WHERE f.user_id = :user_id
                ORDER BY p.created_at DESC";

        $stmt = $this->DbConn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);

        return $stmt->fetchAll();
    }
}