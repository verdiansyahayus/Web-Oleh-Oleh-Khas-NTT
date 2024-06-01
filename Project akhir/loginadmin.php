<?php
// Sertakan file koneksi.php
require_once 'koneksi.php';

// Mulai sesi
session_start();

// Periksa apakah ada pesan kesalahan yang disimpan di sesi
$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Hapus pesan setelah ditampilkan
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="labuanbajo">
        <img src="nusapenida.jpg" alt="Gambar Nusa Penida">
      </div>

    <div class="container flex-container">
        <div class="form-container">
            <h4>MASUK SEBAGAI ADMIN</h4>
            <form method="post" action="process_login.php">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="submit">Masuk</button>
            </form>
        </div>
    </div>
    <?php
    if (!empty($error_message)) {
        echo '<div style="color: red;">' . htmlspecialchars($error_message) . '</div>';
    }
    ?>
</body>
</html>
<footer>
        <div class="container">
            <p>&copy; 2024 Web Oleh-Oleh. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
