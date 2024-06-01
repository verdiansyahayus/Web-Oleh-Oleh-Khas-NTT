<?php
// Sertakan file koneksi.php
require_once 'koneksi.php';

// Ambil data dari form registrasi
$username = $_POST['reg_username'];
$password = $_POST['reg_password'];

try {
    // Periksa apakah username sudah ada di database
    $sql_check = "SELECT * FROM pengguna WHERE username = :username";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':username', $username);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        // Username sudah ada
        $_SESSION['error_message'] = "Username sudah terdaftar!";
        header("Location: regiter.php");
        exit();

    } else {
        // Hash password sebelum menyimpan ke database
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Menggunakan bcrypt

        // Buat pernyataan SQL untuk menyimpan data pengguna baru
        $sql_insert = "INSERT INTO pengguna (username, password) VALUES (:username, :password)";
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->bindParam(':username', $username);
        $stmt_insert->bindParam(':password', $hashed_password);
        $stmt_insert->execute();

        // Registrasi berhasil, redirect ke halaman login.php
        header('Location: login.php');
        exit();
    }
} catch (PDOException $e) {
    // Tangani kesalahan koneksi database
    die("Error: " . $e->getMessage());
}
?>
