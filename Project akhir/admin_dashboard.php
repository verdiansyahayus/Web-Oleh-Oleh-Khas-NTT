<?php
// Mulai sesi
session_start();

// Koneksi ke database
$host = 'localhost';
$dbname = 'web_katalog';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    exit();
}

// Query untuk mengambil data dari database
$stmt = $pdo->query("SELECT o.Nama_oleh_oleh AS oleh_oleh, COALESCE(COUNT(c.Id_oleh_oleh), 0) AS jumlah_peminat
                     FROM oleh_oleh o
                     LEFT JOIN cart c ON o.Id_oleh_oleh = c.Id_oleh_oleh
                     GROUP BY o.Id_oleh_oleh");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query untuk mendapatkan jumlah total barang
$totalBarangStmt = $pdo->query("SELECT COUNT(*) AS total_barang FROM oleh_oleh");
$totalBarang = $totalBarangStmt->fetch(PDO::FETCH_ASSOC)['total_barang'];

// Query untuk mendapatkan jumlah total pemesanan dalam keranjang
$totalPemesananStmt = $pdo->query("SELECT COUNT(*) AS total_pemesanan FROM cart");
$totalPemesanan = $totalPemesananStmt->fetch(PDO::FETCH_ASSOC)['total_pemesanan'];

// Inisialisasi array untuk label dan data
$olehOlehLabels = [];
$jumlahPeminat = [];

// Memasukkan data dari hasil query ke dalam array
foreach ($data as $row) {
    $olehOlehLabels[] = $row['oleh_oleh'];
    $jumlahPeminat[] = $row['jumlah_peminat'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminat</title>
    <link rel="stylesheet" href="style.css">
    <!-- Tautan ke Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<header>
    <div class="container">
        <h1>Dashboard Admin</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="admin_makanan.php">Makanan</a></li>
                <li><a href="admin_minuman.php">Minuman</a></li>
                <li><a href="admin_kerajinan.php">Kerajinan</a></li>
                <li><a href="logout_admin.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="labuanbajo">
    <img src="nusapenida.jpg" alt="Gambar Nusa Penida">
</div>

<div class="container">
    <h3>Jumlah Total Barang: <?php echo $totalBarang; ?></h3>
    <h3>Jumlah Total Pemesanan dalam Keranjang: <?php echo $totalPemesanan; ?></h3>
    <h3>Jumlah Peminat Oleh-Oleh</h3>
    <canvas id="peminatChart" width="800" height="400"></canvas>
</div>

<footer>
    <div class="container">
        <p>&copy; 2024 Web Oleh-Oleh. All rights reserved.</p>
    </div>
</footer>

<script>
// Function untuk menghasilkan warna acak
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

document.addEventListener('DOMContentLoaded', function() {
    var olehOlehLabels = <?php echo json_encode($olehOlehLabels); ?>;
    var jumlahPeminat = <?php echo json_encode($jumlahPeminat); ?>;
    var backgroundColors = [];

    // Generate warna acak untuk setiap bar
    for (var i = 0; i < olehOlehLabels.length; i++) {
        backgroundColors.push(getRandomColor());
    }

    var ctx = document.getElementById('peminatChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: olehOlehLabels,
            datasets: [{
                label: 'Jumlah Peminat',
                data: jumlahPeminat,
                backgroundColor: backgroundColors, // Gunakan warna acak
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>


</body>
</html>
