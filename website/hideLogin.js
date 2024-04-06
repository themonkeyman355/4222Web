document.addEventListener('DOMContentLoaded', function() {
    // Check if user data exists in localStorage
    const userData = localStorage.getItem('userData');
    
    if (userData) {
        // If user data exists, hide the login link
        const loginLink = document.getElementById('loginLink');
        if (loginLink) loginLink.style.display = 'none';

        // Optionally, display the user's username or another piece of user data
        const user = JSON.parse(userData); // Parse the user data back into an object
        const usernameDisplay = document.getElementById('usernameDisplay');
        if (usernameDisplay && user.username) {
            usernameDisplay.textContent = `${user.username}`;
        }
    }
});
