<?php
// Sertakan file koneksi.php
require_once 'koneksi.php';

// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan kembali ke halaman login
    header("Location: login.php");
    exit(); // Penting untuk menghentikan eksekusi setelah mengarahkan
}

// Ambil informasi pengguna dari sesi
$username = $_SESSION['username'];

// Query untuk mendapatkan informasi pengguna
$stmt = $pdo->prepare("SELECT * FROM pengguna WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$id_pengguna = $user['id_pengguna'];

// Query untuk mendapatkan keranjang pengguna
$stmt = $pdo->prepare("SELECT c.id_cart, o.nama_oleh_oleh, o.deskripsi, o.harga, o.gambar 
                       FROM cart c
                       JOIN oleh_oleh o ON c.id_oleh_oleh = o.id_oleh_oleh
                       WHERE c.id_pengguna = :id_pengguna");
$stmt->execute(['id_pengguna' => $id_pengguna]);
$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Hi Selamat Datang</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Makanan.php">Makanan</a></li>
                    <li><a href="Minuman.php">Minuman</a></li>
                    <li><a href="Kerajinan.php">Kerajinan</a></li>
                    <li><a href="akun.php">Akun</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <h2>Informasi Akun</h2>
        <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
        <!-- Tambahkan informasi lain tentang akun pengguna jika diperlukan -->
    </div>
    <div class="container">
        <h2>Keranjang Anda</h2>
        <?php if (!empty($cart)): ?>
            <?php foreach ($cart as $item): ?>
                <div class="item">
                    <img src="<?php echo htmlspecialchars($item['gambar']); ?>" alt="<?php echo htmlspecialchars($item['nama_oleh_oleh']); ?>" style="width: 100px; height: auto;">
                    <h3><?php echo htmlspecialchars($item['nama_oleh_oleh']); ?></h3>
                    <p><?php echo htmlspecialchars($item['deskripsi']); ?></p>
                    <p>Harga: Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>
                    <form method="post" action="process_delete.php" name="form_delete">
                    <input type="hidden" name="id_cart" value="<?php echo htmlspecialchars($item['id_cart']); ?>">
                    <button type="submit">Hapus</button>
                    </form>

                    
                </div>
                

            <?php endforeach; ?>
            <form method="post" action="invoice.php"name="ivoice">
                <button type="submit">Belanja Sekarang</button>
            </form>
        <?php else: ?>
            <p>Keranjang belanja Anda kosong.</p>
        <?php endif; ?>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Web Oleh-Oleh. All rights reserved.</p>
        </div>
    </footer>
   
</body>
</html>
