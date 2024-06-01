<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php session_start(); ?>

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

    <section>
        <div class="container">
            <h2>Makanan Khas NTT</h2>
            <!-- Data Makanan -->
            <div class="oleholeh">
                <?php
                require 'koneksi.php';

                // Pastikan nama kolom sesuai dengan yang ada di tabel
                $stmt = $pdo->query('SELECT o.id_oleh_oleh, o.Nama_oleh_oleh AS nama_oleh_oleh, o.Harga, o.Gambar, k.nama_kategori, o.Deskripsi
                                     FROM oleh_oleh o 
                                     JOIN kategori_oleh_oleh k 
                                     ON o.id_kategori = k.id_Kategori 
                                     WHERE k.nama_kategori = "Makanan"');

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="item">';
                    echo '<img src="' . htmlspecialchars($row['Gambar']) . '" alt="' . htmlspecialchars($row['nama_oleh_oleh']) . '">';
                    echo '<h3>' . htmlspecialchars($row['nama_oleh_oleh']) . '</h3>';
                    echo '<h4>Harga: Rp ' . number_format($row['Harga'], 0, ',', '.') . '</h4>';
                    echo '<p>' . htmlspecialchars($row['Deskripsi']) . '</p>';
                    // Tombol "Keranjang" untuk menambahkan item ke keranjang
                    echo '<button class="cart-btn" data-id="' . htmlspecialchars($row['id_oleh_oleh']) . '">Keranjang</button>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Web Oleh-Oleh. All rights reserved.</p>
        </div>
    </footer>

    <!-- Sertakan file JavaScript -->
    <script src="cart.js"></script>
</body>
</html>
