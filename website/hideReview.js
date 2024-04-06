document.addEventListener('DOMContentLoaded', function() {
    const reviewSection = document.getElementById('reviewSection');
    const userData = localStorage.getItem('userData');

    if (!userData) {
        reviewSection.style.display = 'none';
    }
});
