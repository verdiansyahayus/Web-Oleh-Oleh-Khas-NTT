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
    echo json_encode(['success' => false, 'message' => 'User is not logged in.']);
    exit;
}

// Ambil id_pengguna dari database berdasarkan username
$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT id_pengguna FROM pengguna WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo json_encode(['success' => false, 'message' => 'User not found.']);
    exit;
}

$id_pengguna = $user['id_pengguna'];

// Periksa apakah permintaan adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data JSON dari permintaan
    $input = json_decode(file_get_contents('php://input'), true);

    // Ambil id_oleh_oleh dari data yang dikirimkan
    $id_oleh_oleh = $input['id_oleh_oleh'];

    // Simpan data ke database
    $stmt = $pdo->prepare("INSERT INTO cart (id_pengguna, id_oleh_oleh) VALUES (:id_pengguna, :id_oleh_oleh)");
    $stmt->bindParam(':id_pengguna', $id_pengguna);
    $stmt->bindParam(':id_oleh_oleh', $id_oleh_oleh);

    try {
        $stmt->execute();
        // Berikan respons sukses
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        // Berikan respons gagal
        echo json_encode(['success' => false, 'message' => 'Failed to save data to the database: ' . $e->getMessage()]);
    }
} else {
    // Permintaan bukan POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
