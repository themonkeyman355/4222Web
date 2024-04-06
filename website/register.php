<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the file path for the JSON file
    $file_path = "Accounts.json";

    // Extract form data
    $name = $_POST["txtName"];
    $username = $_POST["txtUsername"];
    $email = $_POST["txtEmail"];
    $password = $_POST["txtPassword"]; // In a real application, you'd hash this before storing
    $dob = $_POST["txtDOB"];
    $terms = isset($_POST["terms"]) ? true : false; // Check if terms were agreed to

    // Create an array with the form data
    $data = array(
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'password' => $password, // Remember to securely hash passwords in real applications
        'dob' => $dob,
        'termsAgreed' => $terms
    );

    // Attempt to read the current data from the JSON file
    $array_data = file_exists($file_path) ? json_decode(file_get_contents($file_path), true) : array();

    // Append the new data to the array
    $array_data[] = $data;

    // Convert the updated array back into JSON format
    $json_data = json_encode($array_data, JSON_PRETTY_PRINT);

    // Attempt to write the data to the JSON file
    if (file_put_contents($file_path, $json_data)) {
        // Convert array to JSON format for passing to client (for less sensitive data)
        $client_json_data = json_encode($data);

        // Redirect with user data encoded in the URL query string
        // Be mindful of the security implications
        header('Location: index.php?data=' . urlencode($client_json_data));
        exit;
    } else {
        // Handle errors, e.g., by echoing an error message
        echo 'Error saving data. Please try again.';
    }
} else {
    // If the form wasn't submitted, you might want to redirect or show an error
    header('Location: register.html'); // Adjust the target as needed
    exit;
}
?>
