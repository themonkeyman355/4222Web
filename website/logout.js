function logout() {
    localStorage.clear();
    window.location.href = 'index.php'; // Removed 'website/' from the path
}
