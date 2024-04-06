<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css Files/dynamicsize.css"> 
    <link rel="stylesheet" href="css Files/index.css"> 
    <link rel="stylesheet" href="css Files/Main.css"> 
    <link rel="stylesheet" href="css Files/Nav.css"> 
    <link rel="stylesheet" href="css Files/tables.css">
    <link rel="stylesheet" href="css Files/chatroom.css">
    <link rel="stylesheet" href="css Files/login.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="localStorageReader.js"></script>
    <script src="hideLogin.js"></script>
    <script src="hideProfile.js"></script>
    <title>Home Page</title>
    <style>
        .container {
          display: grid;
          flex-direction: column;
          gap: 5px; /* Adjust the value as needed */
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
        </br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
<div class="container">
    <section id="about">
        <h2>About SongShack</h2>
        <p>SongShack: Your go-to destination to rate, discuss, and discover albums, connecting musicians and listeners worldwide!</p>
    </section>

    <h2>Featured Albums</h2>
    <?php
    // Load the albums JSON file
    $albumsJson = file_get_contents('JSON Files/Albums.JSON'); 
    // Decode the JSON into an associative array
    $albums = json_decode($albumsJson, true);

    // Check if albums are loaded
    if (!empty($albums)) {
        echo "<div class='albumsContainer'>"; // Start of flex container
        foreach ($albums as $album) {
            echo "<section class='albumDetails'>
                    <img src='{$album['Cover Photo']}' alt='Album Cover'>
                    <div><h3>{$album['title']}</h3></div>
                    <div><p>Artist: {$album['artist']}</p></div>
                    <a href='{$album['albumLocation']}'>View Details</a>
                </section>";
        }
        echo "</div>"; // End of flex container
    } else {
        echo "<p>No albums found.</p>";
    }
    ?>


    </section>
    
    
    </main>
    <!--Writes data to local storage after arriving from register.html-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            
            // Retrieve 'login' and 'data' parameters from URL
            const loginStatus = urlParams.get('login');
            const userData = urlParams.get('data');

            // Common function to handle URL parameter removal
            function removeURLParameter(parameterName) {
                // Construct URL without specified parameter
                urlParams.delete(parameterName);
                // Update the history state
                window.history.pushState({}, document.title, location.pathname + '?' + urlParams.toString());
            }
            
            if (loginStatus === 'success' && userData) {
                // Store user data in localStorage
                localStorage.setItem('userData', decodeURIComponent(userData));
                // Optionally, clear the URL parameters related to 'data'
                removeURLParameter('data');
            } else if (urlParams.get('error') === 'incorrect_logins') {
                alert('Incorrect login credentials.');
            }
            
            // This code runs regardless of login status if 'data' parameter is present
            if (userData) {
                // Parse the JSON string and save it to localStorage
                localStorage.setItem('userData', decodeURIComponent(userData));
                // Remove the 'data' parameter from the URL
                removeURLParameter('data');
                //Reload the page to refresh data
                window.location.reload();

            }
        });
    </script>

            
    <footer>
        <p>&copy; Ewan MacKerracher : 2024 SongShack</p>
    </footer>

</div>
    
</body>
</html>
