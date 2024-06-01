<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerajinan</title>
    <link rel="stylesheet" href="style.css">
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


    <section>
        <div class="container">
            <h2>Kerajinan Khas NTT</h2>
            <!-- Data Kerajinan -->
            <div class="oleholeh">
                <?php
                require 'koneksi.php';

                // Pastikan nama kolom sesuai dengan yang ada di tabel
                $stmt = $pdo->query('SELECT o.id_oleh_oleh, o.Nama_oleh_oleh AS nama_oleh_oleh, o.Harga, o.Gambar, k.nama_kategori, o.Deskripsi
                                     FROM oleh_oleh o 
                                     JOIN kategori_oleh_oleh k 
                                     ON o.id_kategori = k.id_Kategori 
                                     WHERE k.nama_kategori = "Kerajinan"');

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="item">';
                    echo '<img src="' . htmlspecialchars($row['Gambar']) . '" alt="' . htmlspecialchars($row['nama_oleh_oleh']) . '">';
                    echo '<h3>' . htmlspecialchars($row['nama_oleh_oleh']) . '</h3>';
                    echo '<h4>Harga: Rp ' . number_format($row['Harga'], 0, ',', '.') . '</h4>';
                    echo '<p>' . htmlspecialchars($row['Deskripsi']) . '</p>';
                    // Tombol "Edit" untuk mengedit data
                    echo '<a href="update.php?id_oleh_oleh=' . htmlspecialchars($row['id_oleh_oleh']) . '" class="edit-button">Edit</a>';
                    // Tombol "Hapus" untuk menghapus data
                    echo '<form action="delate.php" method="POST"  name="delete" style="display:inline;">';
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id_oleh_oleh']) . '">';
                    echo '<button type="submit">Hapus</button>';
                    echo '</form>';
                    echo '</div>';
                    

                }
                ?>


            </div>
            <!-- Tombol untuk menambah data baru -->
            <a href="create.php" class="tambah_data">Tambah Data</a>
            
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Web Oleh-Oleh. All rights reserved.</p>
        </div>
    </footer>
   
</body>
</html>
