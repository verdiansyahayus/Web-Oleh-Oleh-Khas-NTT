<?php
session_start();

// Database connection settings
$host = 'localhost';
$dbname = 'web_katalog';
$username = 'root'; // Sesuaikan dengan username database Anda
$password = ''; // Sesuaikan dengan password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Validasi ID
if (isset($_GET['id_oleh_oleh']) && ctype_alnum($_GET['id_oleh_oleh'])) {
    $id_oleh_oleh = $_GET['id_oleh_oleh'];

    // Ambil data oleh_oleh dari database
    $sql = "SELECT * FROM oleh_oleh WHERE id_oleh_oleh=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_oleh_oleh]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Periksa apakah data ditemukan
    if ($row) {
        // Proses update jika metode adalah POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];

            // Gunakan prepared statement untuk update data
            $sql = "UPDATE oleh_oleh SET Nama_oleh_oleh=?, Deskripsi=?, Harga=? WHERE id_oleh_oleh=?";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute([$nama, $deskripsi, $harga, $id_oleh_oleh])) {
                // Redirect ke halaman admin_dashboard jika update berhasil
                header("Location: admin_dashboard.php");
                exit();
            } else {
                // Tampilkan pesan error jika update gagal
                echo "Error: Gagal mengupdate data.";
            }
        }
    } else {
        // Tampilkan pesan jika data tidak ditemukan
        echo "Data dengan ID tersebut tidak ditemukan.";
        exit();
    }
} else {
    // Tampilkan pesan jika ID tidak valid
    echo "Error: ID tidak valid.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Oleh-Oleh</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="update">
        <h1>Edit Oleh-Oleh</h1>
        <?php if (isset($row)) : ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['Nama_oleh_oleh']); ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" required><?php echo htmlspecialchars($row['Deskripsi']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" id="harga" name="harga" value="<?php echo htmlspecialchars($row['Harga']); ?>" required>
            </div>
            <button type="submit">Simpan</button>
        </form>
        <?php endif; ?>
        <a href="admin_dashboard.php">Kembali</a>
    </div>
    <footer>
        <div class="container">
            <p>&copy; 2024 Web Oleh-Oleh. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
