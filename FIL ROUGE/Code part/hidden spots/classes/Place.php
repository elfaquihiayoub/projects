<?php

require_once __DIR__ . '/../config/database.php';

class Place{
    private $DbConn;
    public function __construct(){
        $this->DbConn = Database::getInstance()->getConnection();
    }

    // get all places (with only one image) - paginated
    public function getAllPlaces($page = 1, $perPage = 12) {

        $offset = ($page - 1) * $perPage;

       $sql = "SELECT p.*, 
                       u.username, c.name AS category_name,
                       (SELECT image_path FROM place_images WHERE place_id = p.id LIMIT 1) AS image
                FROM places p
                JOIN users u ON p.user_id = u.id
                JOIN categories c ON p.category_id = c.id
                ORDER BY p.created_at DESC
                LIMIT :limit OFFSET :offset";

            $stmt = $this->DbConn->prepare($sql);
            $stmt->bindValue(':limit', (int) $perPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Count total places
    public function countAllPlaces() {

        $sql = "SELECT COUNT(*) AS total FROM places";
        $stmt = $this->DbConn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $result['total'];
    }
    //get all categories for dropdowns
    public function getAllCategories() {

    $sql = "SELECT * FROM categories ORDER BY name ASC";
    $stmt = $this->DbConn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
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

        $place['images'] = $imgStmt->fetchAll(PDO::FETCH_ASSOC);

        return $place;
    }


    // Get places by user - paginated
    public function getPlacesByUser($user_id, $page = 1, $perPage = 12) {

        $offset = ($page - 1) * $perPage;

        $sql = "SELECT p.*, 
                       c.name AS category_name,
                       (SELECT image_path 
                        FROM place_images 
                        WHERE place_id = p.id 
                        LIMIT 1) AS image
                FROM places p
                JOIN categories c ON p.category_id = c.id
                WHERE p.user_id = :user_id
                ORDER BY p.created_at DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->DbConn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int) $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Count places by user
    public function countPlacesByUser($user_id) {

        $sql = "SELECT COUNT(*) AS total FROM places WHERE user_id = :user_id";
        $stmt = $this->DbConn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $result['total'];
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
    //  Add a single image path for a place
    public function addImage($place_id, $image_path) {

        $sql = "INSERT INTO place_images (place_id, image_path)
                VALUES (:place_id, :image_path)";
        $stmt = $this->DbConn->prepare($sql);

        return $stmt->execute([
            'place_id' => $place_id,
            'image_path' => $image_path
        ]);
    }

    //  Count images for a place
    public function countImages($place_id) {

        $sql = "SELECT COUNT(*) AS total FROM place_images WHERE place_id = :place_id";
        $stmt = $this->DbConn->prepare($sql);
        $stmt->execute(['place_id' => $place_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $result['total'];
    }

    //  Delete a single image by path (DB row only)
    public function deleteImage($place_id, $image_path) {

        $sql = "DELETE FROM place_images 
                WHERE place_id = :place_id AND image_path = :image_path";
        $stmt = $this->DbConn->prepare($sql);

        return $stmt->execute([
            'place_id' => $place_id,
            'image_path' => $image_path
        ]);
    }

    //  Delete all images for a place (DB rows only)
    public function deleteImages($place_id) {

        $sql = "DELETE FROM place_images WHERE place_id = :place_id";
        $stmt = $this->DbConn->prepare($sql);

        return $stmt->execute(['place_id' => $place_id]);
    }

    //  Delete place
    public function delete($id) {

        $sql = "DELETE FROM places WHERE id = :id";
        $stmt = $this->DbConn->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
    

    
    
    //searh functions

    public function search($keyword = null, $category_id = null, $limit = 50) {

    $sql = "SELECT p.*, 
                   u.username, 
                   c.name AS category_name,
                   (SELECT image_path 
                    FROM place_images 
                    WHERE place_id = p.id 
                    LIMIT 1) AS image
            FROM places p
            JOIN users u ON p.user_id = u.id
            JOIN categories c ON p.category_id = c.id
            WHERE 1=1";

    $params = [];

    // 🔍 search by name
    if (!empty($keyword)) {
        $sql .= " AND p.name LIKE :keyword";
        $params['keyword'] = "%" . $keyword . "%";
    }

    // 📂 filter by category
    if (!empty($category_id)) {
        $sql .= " AND p.category_id = :category_id";
        $params['category_id'] = $category_id;
    }

    $sql .= " ORDER BY p.created_at DESC LIMIT :limit";

    $stmt = $this->DbConn->prepare($sql);
    foreach ($params as $key => $val) {
        $stmt->bindValue(":$key", $val);
    }
    $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}
    }

