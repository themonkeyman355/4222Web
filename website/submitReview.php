<?php

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting POST data
    $albumKey = $_POST['albumKey'] ?? '';
    $user = $_POST['user'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $comment = $_POST['comment'] ?? '';

    // Define path to reviews.json
    $filePath = 'JSON Files/reviews.json';

    // Try to load existing reviews
    if (file_exists($filePath)) {
        $reviews = json_decode(file_get_contents($filePath), true) ?: [];
    } else {
        $reviews = [];
    }

    // Append new review to the respective album's array
    $reviews[$albumKey][] = [
        'user' => $user,
        'rating' => $rating,
        'comment' => $comment,
        'date' => date('d-m-Y') // Stores the current date
    ];

    // Save updated reviews back to the file
    if (file_put_contents($filePath, json_encode($reviews, JSON_PRETTY_PRINT))) {
        // Redirect back to the album page after successfully saving the review
        // Adjust the redirection path as necessary
        header('Location: Albums.php?key=' . urlencode($albumKey));
        exit();
    } else {
        // Handle error during file writing
        // Log error or notify admin
        // Redirect to an error page or show an error message (optional)
        header('Location: errorPage.php?error=writeError'); // Example redirection
        exit();
    }
} else {
    // Redirect to the homepage or a specific page if accessed with a non-POST method
    header('Location: index.php');
    exit();
}
?>