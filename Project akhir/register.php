<?php
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
    <title>Registrasi Pengguna</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validatePassword() {
            var password = document.getElementById("reg_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            var error = document.getElementById("password_error");
            if (password !== confirmPassword) {
                error.innerHTML = "Kata sandi tidak sesuai.";
                return false;
            } else {
                error.innerHTML = "";
                return true;
            }
        }
    </script>

</head>
<body>
    
    <div class="labuanbajo">
        <img src="nusapenida.jpg" alt="Gambar Nusa Penida">
    </div>

    <div class="container flex-container">
        <div class="form-container">
            <h4>DAFTAR</h4>
            <?php
        if (!empty($error_message)) {
            echo '<div class="error-message">' . htmlspecialchars($error_message) . '</div>';
        }
        ?>
            <!-- Form pendaftaran -->
            <form method="post" action="process_registration.php" name="akun" onsubmit="return validatePassword()">
                <div class="form-group">
                    <label for="reg_username">Username:</label>
                    <input type="text" id="reg_username" name="reg_username" required>
                </div>
                <div class="form-group">
                    <label for="reg_password">Password:</label>
                    <input type="password" id="reg_password" name="reg_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <span id="password_error" style="color: red;"></span>
                </div>
                <button type="submit" name="register">Daftar</button>
            </form>
            <div class="nothave">
                <p>Sudah punya akun? <a href="login.php">Masuk</a></p>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Web Oleh-Oleh. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
