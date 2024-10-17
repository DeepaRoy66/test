// In home.html or equivalent JavaScript file
document.addEventListener('DOMContentLoaded', () => {
    const userData = JSON.parse(localStorage.getItem('user'));

    if (userData) {
        // Use user data as needed
        console.log('User Data:', userData);

        // Display user info or customize the page based on user data
        document.getElementById('user-info').textContent = `Welcome, ${userData.username}`;
    } else {
        // Redirect to login page if no user data is found
        window.location.href = '/home.html';
    }
});