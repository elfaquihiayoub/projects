<?php

require_once __DIR__ . '/../classes/Place.php';

header("Content-Type: application/json");

$placeObj = new Place();

/*  GET INPUT FROM JS */
$keyword = $_GET['keyword'] ?? null;
$category_id = $_GET['category_id'] ?? null;

/* 📦 FETCH DATA */
$places = $placeObj->search($keyword, $category_id);

/*  RETURN JSON RESPONSE */
echo json_encode([
    "success" => true,
    "data" => $places
]);