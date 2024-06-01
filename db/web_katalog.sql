-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Bulan Mei 2024 pada 15.14
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web katalog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_oleh_oleh`
--

CREATE TABLE `kategori_oleh_oleh` (
  `Id_Kategori` char(10) NOT NULL,
  `Nama_Kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_oleh_oleh`
--

INSERT INTO `kategori_oleh_oleh` (`Id_Kategori`, `Nama_Kategori`) VALUES
('1', 'Makanan'),
('2', 'Minuman'),
('3', 'Kerajinan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `oleh_oleh`
--

CREATE TABLE `oleh_oleh` (
  `Id_oleh_oleh` char(10) NOT NULL,
  `Gambar` text DEFAULT NULL,
  `Nama_oleh_oleh` varchar(50) DEFAULT NULL,
  `Harga` float DEFAULT NULL,
  `Deskripsi` text DEFAULT NULL,
  `Id_Kategori` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `oleh_oleh`
--

INSERT INTO `oleh_oleh` (`Id_oleh_oleh`, `Gambar`, `Nama_oleh_oleh`, `Harga`, `Deskripsi`, `Id_Kategori`) VALUES
('1', 'se\'i babi.jpg', 'Se\'i Babi 500 gr', 200000, 'se\'i babi adalah makanan khas dari NTT yang terbuat dari daging babi (Non Halal) diolah dengan cara di asapi sampai mengeluarkan aroma yang khas', '1'),
('10', 'madu.jpg', 'Madu Khas NTT  100 ml', 75000, 'Madu khas NTT merupakan madu asli 100% yang diambil dari pepohonan tinggi di pedalaman Pulau Timor yang memiliki kualitas Madu terbaik ke-3 di dunia, setelah Yunani dan Australia.', '2'),
('11', 'Kain Songke.jpg', 'Kain Songke', 800000, 'Kain tenun yang berasal dari Manggarai yang memiliki motif yang sangat beragam yang biasa digunakan masyarakat sekitar dalam upacara adat.', '3'),
('12', 'Patung Komodo.jpg', 'Patung Komodo', 300000, 'Nusa Tenggara Timur terkenal dengan icon hewan khas nya yaitu \"Komodo\". Sehingga untuk tetap melestarikan ke khasan tersebut para pengerajin membuat patung komodo sebagai salah satu oleh-oleh khas dari daerah ini.', '3'),
('13', 'Sasando.jpg', 'Sasando', 800000, 'Alat musik khas yang berasal dari Nusa Tenggara Timur', '3'),
('14', 'Kain Tenun Ikat.jpg', 'Kain Tenun Ikat', 1000000, '\"Kain Tenun ikat berasal dari sumba,NTT yang proses pembuatannya masih tradisional , ditenun dari helaian benang pakan atau benang lungsin yang sebelumnya diikat dan dicelupkan ke dalam zat pewarna alami.\r\n\"', '3'),
('15', 'mamuli satu set.jpg', 'Mamuli satu set', 750000, 'Mamuli adalah perhiasan kuno khas Pulau Sumba berbentuk unik yang tergolong langka. Mamuli berupa anting-anting dan kalung, bentuk dasarnya menyerupai simbol omega, rahim atau kelamin perempuan.', '3'),
('2', 'se\'i sapi.jpg', 'Se\'i Sapi 500 gr', 185000, 'se\'i sapi adalah makanan khas dari NTT yang terbuat dari daging sapi diolah dengan cara di asapi sampai mengeluarkan aroma yang khas', '1'),
('3', 'Jagung Titi.jpg', 'Jagung Titi  100 gr', 40000, 'Camilan yang terbuat dari jagung yang dititi / dipipihkan dan memiliki rasa gurih manis', '1'),
('4', 'Rebok.jpg', 'Rebok 100 gr', 50000, 'Rebok merupakan makanan yang terbuat dari campuran tepung jagu atau beras dengan gula yang di tumbuk didalam alu agu ngencung dan memiliki cita rasa yang manis', '1'),
('5', 'Roti Kompiang.jpg', 'Roti Kompiang isi 10', 50000, 'Roti khas dari Manggarai yang memiliki taburan wijen diatasnya, memiliki rasa manis dan sedikit gurih', '1'),
('6', 'teh kelor.jpg', 'Teh Celup Daun Kelor', 25000, 'Produk Teh yang dibuat dari perpaduan daun kelor dan jeruk nipis yang telah dikeringkan. Kandungan yang terdapat pada produk ini baik bagi sistem kekebelan tubuh, memperlancar metabolisme, tubuh, juga dapat menstabilkan berat badan.', '2'),
('7', 'gula semut.jpg', 'Gula Semut Pulau Rote 50 gr', 55000, 'Gula semut adalah makanan yang terbuat dari nira atau hasil sadapan pada daun lontar, kemudian dimasak lalu di gosok menggunakan batok kelapa hingga menjadi serbuk.', '2'),
('8', 'kopi colol.jpg', 'Kopi Manggarai 100 gr', 50000, 'Kopi khas Manggarai Colol yang terbuat dari biji kopi pilihan yang berkualitas ', '2'),
('9', 'tuak.jpg', 'Tuak khas NTT 600 ml', 80000, 'Tuak merupakan minuman hasil fermentasi air pohon aren yang memiliki cita rasa manis dan sedikit asam serta terdepat sedikit kandungan alkohol', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `Id_pengguna` char(10) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `kata_kunci` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori_oleh_oleh`
--
ALTER TABLE `kategori_oleh_oleh`
  ADD PRIMARY KEY (`Id_Kategori`);

--
-- Indeks untuk tabel `oleh_oleh`
--
ALTER TABLE `oleh_oleh`
  ADD PRIMARY KEY (`Id_oleh_oleh`),
  ADD KEY `Id_Kategori` (`Id_Kategori`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`Id_pengguna`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `oleh_oleh`
--
ALTER TABLE `oleh_oleh`
  ADD CONSTRAINT `oleh_oleh_ibfk_1` FOREIGN KEY (`Id_Kategori`) REFERENCES `kategori_oleh_oleh` (`Id_Kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
