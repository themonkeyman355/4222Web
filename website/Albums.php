<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css Files/dynamicsize.css"> 
    <link rel="stylesheet" href="css Files/index.css"> 
    <link rel="stylesheet" href="css Files/Main.css"> 
    <link rel="stylesheet" href="css Files/Nav.css"> 
    <link rel="stylesheet" href="css Files/reviews.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="localStorageReader.js"></script>
    <script src="hideLogin.js"></script>
    <script src="hideProfile.js"></script>
    <script src="hideReview.js"></script>
    <script src="reviewSystem.js"></script>
        <title>Album Details</title>
    <style>
    .container {
        display: flex;
        flex-direction: column;
        gap: 20px; /* Adjust the value as needed */
    }
    main{
        margin-top:40px;
    }
    </style>


</head>
<body>
    <header>
        <a href="index.php">
            <img src="Images/SongShack.png" alt="Logo" id="logo">
        </a>
        <nav class="navigation">
            <a href="index.php">Home Page</a>
            <a href="ranking.php">Ranking Page</a>
            <a href="login.html" id="loginLink">Login</a>
            <span id="usernameDisplay"></span>
            <a href="profile.html" id="profileLink"><ion-icon name="person-outline"></ion-icon></a>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php
            $albumKey = $_GET['key'] ?? null; // Get album key from query string
            $albumsJson = file_get_contents('JSON Files/Albums.JSON'); // Load the albums JSON file
            $albums = json_decode($albumsJson, true); // Decode the JSON into an associative array

            if ($albumKey !== null && isset($albums[$albumKey - 1])) {
                $album = $albums[$albumKey - 1];
                echo "</br> </br>
                        <section id='individualDetails'>
                                <h2>Album Details</h2>
                                <div class='individualDetails'>
                                    <img id='albumCover' src='{$album['Cover Photo']}' alt='Album Cover'>
                                    <div><h3 id='albumTitle'>{$album['title']}</h3></div>
                                    <div id='albumArtist'><p>Artist: {$album['artist']}</p></div>
                                    <div id='albumGenre'><p>Genre: {$album['genre']}</p></div>
                                    <div id='albumTotalTime'><p>Total Time: {$album['totalTime']}</p></div>
                                    <div id='albumReleaseYear'><p>Release Year: {$album['releaseYear']}</p></div>
                                    <div id='albumProducer'><p>Producer: {$album['producer']}</p></div>
                                    <div id='albumRecommendationScore'><p>Recommendation Score: {$album['recommendationScore']}</p></div>
                                    <div id='albumRecommendationDescription'><p>{$album['recommendationDescription']}</p></div>
                                </div>
                                <div class='albumSongs'>
                                    <table id='songList'>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Run Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                        foreach ($album['songs'] as $song) {
                            echo "<tr>
                                    <td>{$song['track']}</td>
                                    <td>{$song['title']}</td>
                                    <td>{$song['runtime']}</td>
                                </tr>";
                }
                echo "            </tbody>
                            </table>
                        </div>
                    </section>";
            } else {
                echo "<p>Album not found.</p>";
            }
            ?>
        </div>
        <div class="reviews">
            <section id="reviewSection">
                <h2>Leave a Review</h2>
                <form id="reviewForm" action="submitReview.php" method="post">
                    <input type="hidden" id="username" name="user">
                    <input type="hidden" id="albumKey" name="albumKey" value="<?php echo htmlspecialchars($albumKey); ?>">

                    <label for="rating">Rating (1-5):</label>
                    <div class="star-rating">
                        <input id="star5" name="rating" type="radio" value="5" class="star"/><label for="star5" title="5 stars"></label>
                        <input id="star4" name="rating" type="radio" value="4" class="star"/><label for="star4" title="4 stars"></label>
                        <input id="star3" name="rating" type="radio" value="3" class="star"/><label for="star3" title="3 stars"></label>
                        <input id="star2" name="rating" type="radio" value="2" class="star"/><label for="star2" title="2 stars"></label>
                        <input id="star1" name="rating" type="radio" value="1" class="star"/><label for="star1" title="1 star"></label>
                    </div>

                    <label for="comment">Comment:</label>
                    <textarea id="comment" name="comment" required></textarea>
                    <button type="submit">Submit Review</button>
                </form>
            </br>
            </section>
            <h2>Reviews:</h2>
            <div id="reviewsContainer"></div>
        </div>
        </br>
            </br>
            </br>
    </main>

    <footer>
        <p>&copy;Ewan MacKerracher : 2024 SongShack</p>
    </footer>
</body>
</html>
