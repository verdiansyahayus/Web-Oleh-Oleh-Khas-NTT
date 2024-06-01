<?php
session_start();

include('koneksi.php');

try {
    $pdo = new PDO("mysql:host=localhost;dbname=web_katalog", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Dapatkan ID dari POST request dan lakukan validasi
if (isset($_POST['id']) && ctype_alnum($_POST['id'])) {
    $id_oleh_oleh = $_POST['id'];

    // Siapkan statement SQL untuk menghapus data
    $stmt = $pdo->prepare("DELETE FROM oleh_oleh WHERE id_oleh_oleh = :id_oleh_oleh");
    $stmt->bindParam(':id_oleh_oleh', $id_oleh_oleh, PDO::PARAM_STR);

    // Eksekusi statement dan cek hasilnya
    if ($stmt->execute()) {
        // Data berhasil dihapus, redirect ke dashboard admin
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Tampilkan pesan error jika gagal
        echo "Error: Gagal menghapus data.";
    }

    // Tutup statement
    unset($stmt);
} else {
    echo "Error: ID tidak valid.";
}
?>
