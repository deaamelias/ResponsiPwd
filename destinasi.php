<?php
session_start();
include "koneksi.php";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Ambil data destinasi dari database
$query_destinasi = "SELECT * FROM destinasi";
$result_destinasi = $conn->query($query_destinasi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>KalimantanExplorer</title>
</head>

<body>
    <a id="back-to-top" href="#">Back to Top</a>
    <header>
        <div class="container">
            <h1>KalimantanExplorer</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="destinasi.php">Destinasi</a></li>
                    <li><a href="aktivitas.php">Aktivitas</a></li>
                    <li><a href="penginapan.php">Penginapan</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="formcari">
            <form id="search-form" action="search.php" method="get">
                <label for="search-keyword">
                    <h3>Cari Destinasi Wisata:&nbsp&nbsp</h3>
                </label>
                <input type="text" id="search-keyword" name="keyword"
                    placeholder="Masukkan nama tempat, tipe aktivitas, atau kategori">
                <button type="submit">Cari</button>
            </form>
        </div>
        <div class="container2">
            <div class="search-results">
                <h2>Destinasi</h2>
                <?php
                // Tampilkan data destinasi
                while ($row_destinasi = $result_destinasi->fetch_assoc()) {
                    echo '<div class="destination2">';
                    echo '<h2>' . $row_destinasi['nama_ds'] . '</h2>';
                    echo '<img src="' . $row_destinasi['gambar'] . '" alt="' . $row_destinasi['nama_ds'] . '">';
                    echo '<p>' . $row_destinasi['deskripsi'] . '</p>';
                    echo '<br><br><h3>Lokasi</h3>';
                    echo '<p><em>' . $row_destinasi['lokasi'] . '</em></p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </main>
    <footer class="container">
        <div class="footer-bottom">
            <p>&copy; 2023 KalimantanExplorer | Dibuat dengan ❤️ oleh deamelyaa</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>