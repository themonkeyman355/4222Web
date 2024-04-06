<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email and password from POST request
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword']; // Assuming you're sending the password field as 'txtPassword'

    // Path to the Accounts.json file
    $filePath = 'JSON Files/Accounts.json';

    // Check if Accounts.json exists and is readable
    if (file_exists($filePath) && is_readable($filePath)) {
        // Read the file and decode the JSON data to an array
        $accounts = json_decode(file_get_contents($filePath), true);

        // Initialize a flag to check login success
        $loginSuccess = false;

        // Loop through accounts to find a match
        foreach ($accounts as $account) {
            // Verify if the email matches and the password is correct
            // NOTE: For a real application, ensure you hash passwords and use password_verify() to check passwords
            if ($account['email'] === $email && $account['password'] === $password) {
                $loginSuccess = true;
                break; // Exit the loop if a match is found
            }
        }

        // Redirect or display a message based on login success
        if ($loginSuccess) {
            // Prepare user data for JavaScript, excluding the password for security
            $userData = array(
                "name" => $account['name'],
                "username" => $account['username'],
                "email" => $account['email'],
                // Remove "password" from the user data being passed to JavaScript for security reasons
                "dob" => $account['dob'],
                "termsAgreed" => $account['termsAgreed']
            );
            
            // Convert user data to JSON, making it ready for JavaScript
            $userJson = json_encode($userData);
            
            echo "<script>
                    // Ensure the JSON string is properly escaped for JavaScript embedding
                    localStorage.setItem('userData', " . json_encode($userJson) . ");
            
                    // Redirect to index.php
                    window.location.href = 'index.php';
                  </script>";
            exit();
        }
        
         else {
            // Login failed
            echo 'Invalid login credentials.';
            // Optionally, redirect back to the login page or display an error message
        }
    } else {
        // Error message if Accounts.json doesn't exist or isn't readable
        echo 'Error: Unable to read the accounts data.';
    }
} else {
    // If the form wasn't submitted, redirect to the login page
    header('Location: login.html');
}
?>
