<?php
session_start();

include('koneksi.php');

// Fungsi untuk menghasilkan satu karakter alfabet acak
function generateAlphaID() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomCharacter = $characters[rand(0, $charactersLength - 1)];
    return $randomCharacter;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Tentukan ID kategori berdasarkan kategori yang dipilih
    switch ($category) {
        case 'makanan':
            $category_id = 1;
            break;
        case 'minuman':
            $category_id = 2;
            break;
        case 'kerajinan':
            $category_id = 3;
            break;
        default:
            echo "Kategori tidak valid.";
            exit();
    }

    // Upload gambar
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image = $_FILES["image"]["name"];

    // Memeriksa apakah file gambar yang diunggah valid
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        exit();
    }

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Buat id oleh-oleh dengan satu karakter alfabet
        $id_oleh_oleh = generateAlphaID();

        // Gunakan prepared statement untuk mencegah SQL injection
        $sql = "INSERT INTO oleh_oleh (id_oleh_oleh, Nama_oleh_oleh, Deskripsi, Harga, id_kategori, Gambar) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id_oleh_oleh, $name, $description, $price, $category_id, $image])) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $stmt->errorInfo()[2];
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah gambar.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="labuanbajo">
    <img src="nusapenida.jpg" alt="Gambar Nusa Penida">
</div>
<div class="create">
    <div class="create-form-container">
        <h4>Tambah data</h4>
        <form method="post" action="create.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="number" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Kategori:</label>
                <input type="text" id="category" name="category" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar:</label>
                <input type="file" id="image" name="image" required>
            </div>
            <button type="submit">Simpan</button>
        </form>
        <div class="nothave">
            <p><a href="admin_dashboard.php">Kembali</a></p>
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
