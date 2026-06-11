<?php

require_once __DIR__ . '/../config/database.php';

class Review {

    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // ⭐ Add or update review (because of UNIQUE(user_id, place_id))
    public function save($user_id, $place_id, $rating, $comment) {

        $sql = "INSERT INTO reviews (user_id, place_id, rating, comment)
                VALUES (:user_id, :place_id, :rating, :comment)
                ON DUPLICATE KEY UPDATE
                    rating = VALUES(rating),
                    comment = VALUES(comment)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'user_id' => $user_id,
            'place_id' => $place_id,
            'rating' => $rating,
            'comment' => $comment
        ]);
    }

    // 🗑 Delete review
    public function delete($user_id, $place_id) {

        $sql = "DELETE FROM reviews 
                WHERE user_id = :user_id AND place_id = :place_id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'user_id' => $user_id,
            'place_id' => $place_id
        ]);
    }

    //  Get all reviews for a place
    public function getByPlace($place_id) {

        $sql = "SELECT r.*, u.username
                FROM reviews r
                JOIN users u ON r.user_id = u.id
                WHERE r.place_id = :place_id
                ORDER BY r.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['place_id' => $place_id]);

        return $stmt->fetchAll();
    }

    // 👤 Get user review for a place
    public function getUserReview($user_id, $place_id) {

        $sql = "SELECT * FROM reviews
                WHERE user_id = :user_id AND place_id = :place_id
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'place_id' => $place_id
        ]);

        return $stmt->fetch();
    }

    // ⭐ Get average rating for a place
    public function getAverageRating($place_id) {

        $sql = "SELECT AVG(rating) as avg_rating
                FROM reviews
                WHERE place_id = :place_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['place_id' => $place_id]);

        $result = $stmt->fetch();

        return $result['avg_rating'] ?? 0;
    }
}