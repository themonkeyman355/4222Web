document.addEventListener('DOMContentLoaded', function() {
    // Retrieve user data from localStorage
    var userData = localStorage.getItem('userData');
    if (userData) {
        var user = JSON.parse(userData);

        // Display the username in the designated span
        if (user.username) {
            document.getElementById('usernameDisplay').textContent = user.username;
        }

        // Format the date of birth (dob) from yyyy-mm-dd to dd/mm/yyyy
        var dobFormatted = '';
        if (user.dob) {
            var dateParts = user.dob.split('-');
            dobFormatted = `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
        }

        // Generate and display HTML content for user details
        var userDetailsHtml = 
        `<h3>Name: ${user.name}</h3>` +
        `<h3>Username: ${user.username}</h3>` +
        `<h3>Email Address: ${user.email}</h3>` +
        `<h3>Password: <span id="userPassword">Protected</span>` +
        ` <button id="showPasswordBtn">Show Password</button></h3>` +
        `<h3>Date of Birth: ${dobFormatted}</h3>`;

        document.getElementById('userDetails').innerHTML = userDetailsHtml;

        // Add click event listener to "Show Password" button
        document.getElementById('showPasswordBtn').addEventListener('click', function() {
            var passwordSpan = document.getElementById('userPassword');
            var showPasswordBtn = this; // More concise reference to the button
            if (showPasswordBtn.textContent === 'Show Password') {
                passwordSpan.textContent = user.password; // Show password
                showPasswordBtn.textContent = 'Hide Password'; // Change button text
            } else {
                passwordSpan.textContent = 'Protected'; // Hide password again
                showPasswordBtn.textContent = 'Show Password'; // Reset button text
            }
        });
    } else {
        // No user data found in localStorage
        document.getElementById('userDetails').innerHTML = '<p>No user data found in localStorage.</p>';
    }
});
