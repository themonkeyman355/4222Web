document.addEventListener('DOMContentLoaded', function() {
    // Check if user data exists in localStorage
    const userData = localStorage.getItem('userData');
    const profileLink = document.getElementById('profileLink'); // Assume the profile link has this id

    if (userData) {
        // If user data exists, parse it
        const user = JSON.parse(userData);

        // Ensure the profile link is shown (in case it was previously hidden)
        if (profileLink) profileLink.style.display = ''; // or "block", "inline", etc., depending on your layout
    } else {
        // If user data does not exist, hide the profile link
        if (profileLink) profileLink.style.display = 'none';
    }
});
