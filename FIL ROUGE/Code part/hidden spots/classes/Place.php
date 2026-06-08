<?php

require_once __DIR__ . '/../config/database.php';

class Place{
    private $DbConn;
    public function __construct(){
        $this->DbConn = Database::getInstance()->getConnection();
    }

    // get all places( with only one image)

    public function getAllPlaces(){
       $sql = "SELECT p.*, 
                       u.username,c.name AS category_name,
                       (SELECT image_path FROM place_images WHERE place_id = p.id  LIMIT 1) AS image
                FROM places p
                JOIN users u ON p.user_id = u.id
                JOIN categories c ON p.category_id = c.id
                ORDER BY p.created_at DESC";
            $stmt = $this->DbConn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // get place by id (with all images)
      public function getPlaceById($id) {
         $sql = "SELECT p.*, u.username, c.name AS category_name
                FROM places p
                JOIN users u ON p.user_id = u.id
                JOIN categories c ON p.category_id = c.id
                WHERE p.id = :id
                LIMIT 1";
        $stmt = $this->DbConn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $place = $stmt->fetch(PDO::FETCH_ASSOC);
               if (!$place) return null;

        //  Get ALL images
        $imgSql = "SELECT image_path 
                   FROM place_images 
                   WHERE place_id = :id";

        $imgStmt = $this->DbConn->prepare($imgSql);
        $imgStmt->execute(['id' => $id]);

        $place['images'] = $imgStmt->fetchAll(PDO::FETCH_COLUMN);

        return $place;
    }

    
    


    //owner of place  check
    // 
    public function isOwner($place_id, $user_id) {

        $sql = "SELECT id FROM places WHERE id = :place_id AND user_id = :user_id LIMIT 1";
        $stmt = $this->DbConn->prepare($sql);
        $stmt->execute([
            'place_id' => $place_id,
            'user_id' => $user_id
        ]);

        return $stmt->fetch() ? true : false;
    }





    //add new place 
    public function create($user_id, $category_id, $name, $description, $location_name, $latitude, $longitude) {

        $sql = "INSERT INTO places 
                (user_id, category_id, name, description, location_name, latitude, longitude)
                VALUES 
                (:user_id, :category_id, :name, :description, :location_name, :latitude, :longitude)";

        $stmt = $this->DbConn->prepare($sql);

        $stmt->execute([
            'user_id' => $user_id,
            'category_id' => $category_id,
            'name' => $name,
            'description' => $description,
            'location_name' => $location_name,
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);
        return $this->DbConn->lastInsertId();
    }

       // Update place
    public function update($id, $category_id, $name, $description, $location_name, $latitude, $longitude) {

        $sql = "UPDATE places SET
                    category_id = :category_id,
                    name = :name,
                    description = :description,
                    location_name = :location_name,
                    latitude = :latitude,
                    longitude = :longitude
                WHERE id = :id";

            $stmt = $this->DbConn->prepare($sql);

            return $stmt->execute([
                'id' => $id,
                'category_id' => $category_id,
                'name' => $name,
                'description' => $description,
                'location_name' => $location_name,
                'latitude' => $latitude,
                'longitude' => $longitude
            ]);
    }
    //  Delete place
    public function delete($id) {

        $sql = "DELETE FROM places WHERE id = :id";
        $stmt = $this->DbConn->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
    
    
    
    }

    