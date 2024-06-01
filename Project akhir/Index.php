<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLEH-OLEH NUSA TENGGARA TIMUR</title>
    <link rel="stylesheet" href="style.css">
    <script src="slide.js"></script>
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

      <div class="oleh">
        <h2>Oleh Oleh Khas NTT</h2>
      </div>
   

    <div class="slogan">
        <img src="pola.png" alt="Gambar" class="gambar-kiri">
        <p>Rasakan pengalaman berbelanja yang<br>berbeda dan membawa pulang sepotong<br>keindahan dan kekayaan budaya NTT</p>
        <img src="pola.png" alt="Gambar" class="gambar-kanan">
      </div>


    <!-- Bagian home dengan informasi toko -->
    <div class="informasi">
    <div class ="tentang">
        <img src="logo.png" alt="Logo">
        <h3>Tentang Kami</h3>
        <p>Selamat datang di "Pesona NTT", pusat oleh-oleh khas Nusa Tenggara Timur yang menawarkan beragam makanan, minuman, dan kerajinan tangan asli dari daerah yang kaya akan budaya dan tradisi ini. Toko kami berdedikasi untuk menghadirkan keunikan dan keindahan NTT langsung ke tangan Anda.
            Di Pesona NTT, kami tidak hanya menjual produk, tetapi juga berbagi cerita dan tradisi dari Nusa Tenggara Timur. Setiap produk yang kami tawarkan adalah hasil karya terbaik yang dibuat dengan cinta dan dedikasi oleh masyarakat setempat.  Mari rasakan pengalaman berbelanja yang berbeda dan membawa pulang sepotong keindahan dan kekayaan budaya NTT. </p>
    </div>
    <div class="hubungi">
        <h3>Hubungi Kami</h3>
        <p>Lokasi: Kampung Lancang Kelurahan Wa Kelambu Labuan Bajo Labuan Bajo, Wae Kelambu, Kec. Komodo, Kabupaten Manggarai Barat, Nusa Tenggara Tim. 86754</p>
        <p>Jam Buka: 10:00 WITA - 22:00 WITA</p>
        <p>Hubungi kami melalui WhatsApp: 082250383159</p>
    </div>
</div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Web Oleh-Oleh. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>