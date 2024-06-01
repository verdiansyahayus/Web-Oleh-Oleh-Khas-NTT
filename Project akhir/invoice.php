<?php
session_start();

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

// Buat pesan WhatsApp
$waMessage = "Invoice Belanjaan:\n";
$totalBelanja = 0;
foreach ($cart as $index => $item) {
    $waMessage .= ($index + 1) . ". " . $item['nama_oleh_oleh'] . " - Rp " . number_format($item['harga'], 0, ',', '.') . "\n";
    $totalBelanja += $item['harga'];
}
$waMessage .= "\nTotal Belanja: Rp " . number_format($totalBelanja, 0, ',', '.');
$waMessage = urlencode($waMessage); // Encode pesan untuk dimasukkan ke URL
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Belanjaan</title>
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
                <li><a href="<?php echo isset($_SESSION['username']) ? 'akun.php' : 'login.php'; ?>">
                    <?php echo isset($_SESSION['username']) ? 'Akun' : 'Login'; ?>
                </a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="labuanbajo">
    <img src="nusapenida.jpg" alt="Gambar Nusa Penida">
</div>

<div class="container">
    <h2>Invoice Belanjaan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($cart as $index => $item): 
            ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo htmlspecialchars($item['nama_oleh_oleh']); ?></td>
                <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" style="text-align: right;">Total Belanja:</td>
                <td><strong>Rp <?php echo number_format($totalBelanja, 0, ',', '.'); ?></strong></td>
            </tr>
        </tbody>
    </table>
    <div class="keterangan">
        <p>Silahkan kirim struk ke WhatsApp untuk melanjutkan pesanan</p>
    </div>
    <div class="wa">
        <a href="https://api.whatsapp.com/send?phone=6282250383159&text=<?php echo $waMessage; ?>" target="_blank">
            <button>Pesanan Dilanjutkan</button>
        </a>
    </div>
</div>

<footer>
    <div class="container">
        <p>&copy; 2024 Web Oleh-Oleh. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
