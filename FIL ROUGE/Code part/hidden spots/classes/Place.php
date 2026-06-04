<?php

require_once __DIR__ . '/../config/Database.php';

class Place{
    private $DbConn;
    public function __construct(){
        $this->DbConn = Database::getInstance()->getConnection();
    }

    // get all places

    public function getAllPlaces(){
        $sql= "SELECT places.*, users.username, categories.name AS category_name
                FROM places
                JOIN users ON places.user_id = users.id
                JOIN categories ON places.category_id = categories.id
                ORDER BY places.created_at DESC";
            $stmt = $this->DbConn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
    }

    // get place by id
      public function getPlaceById($id) {
        $sql = "SELECT * FROM places WHERE id = :id LIMIT 1";
        $stmt = $this->DbConn->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    
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

        return $stmt->execute([
            'user_id' => $user_id,
            'category_id' => $category_id,
            'name' => $name,
            'description' => $description,
            'location_name' => $location_name,
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);
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

    