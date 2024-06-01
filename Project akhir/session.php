<?php
// Panggil session_start() di awal setiap halaman yang memerlukan sesi
session_start();

// Mengatur waktu kedaluwarsa untuk cookie sesi menjadi 0 (sesi berakhir saat browser ditutup)
session_set_cookie_params(0);

// Function to check if the user is logged in
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect to the login page if the user is not logged in
function redirectToLogin() {
    header("Location: login.php");
    exit();
}
?>
