<?php

$albumKey = $_GET['albumKey'] ?? '';
$filePath = 'JSON Files/reviews.json';

if (file_exists($filePath)) {
    $reviewsData = json_decode(file_get_contents($filePath), true);
    $albumReviews = $reviewsData[$albumKey] ?? [];
    echo json_encode($albumReviews);
} else {
    echo json_encode([]);
}