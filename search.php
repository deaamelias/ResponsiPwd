<?php
session_start();
include "koneksi.php";
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>KalimantanExplorer</title>
</head>

<body>

    <header>
        <div class="container2">
            <h1>KalimantanExplorer</h1>
        </div>
    </header>

    <main>

        <div class="container2">
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["keyword"])) {
                $keyword = $_GET["keyword"];

                if (empty($keyword)) {
                    echo "<br>Masukkan destinasi yang ingin dicari";
                    exit;
                }

                // Lakukan pencarian destinasi wisata
                $query = "SELECT * FROM destinasi WHERE 
                          nama_ds LIKE '%$keyword%' OR
                          lokasi LIKE '%$keyword%' OR
                          id_kategori LIKE '%$keyword%'";

                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    echo '<div class="search-results">';
                    echo '<h2>Hasil Pencarian</h2>';

                    // Tampilkan hasil pencarian
                    while ($row_destinasi = $result->fetch_assoc()) {
                        echo '<div class="destination2">';
                        echo '<h3>' . $row_destinasi['nama_ds'] . '</h3>';
                        echo '<img src="' . $row_destinasi['gambar'] . '" alt="' . $row_destinasi['nama_ds'] . '">';
                        echo '<p>' . $row_destinasi['deskripsi'] . '</p>';
                        echo '<h4>Lokasi</h4>';
                        echo '<p><em>' . $row_destinasi['lokasi'] . '</em></p>';
                        echo '</div>';
                        echo '<br>';
                    }

                } else {
                    echo "<h3>Tidak ada hasil pencarian untuk '$keyword'.</h3>";
                }

                $conn->close();
            }
            ?>

            <a href="destinasi.php" class="back-button">Kembali ke Beranda</a>
        </div>
        </div>
    </main>
    <footer class="container">
        <div class="footer-bottom">
            <p>&copy; 2023 KalimantanExplorer | Dibuat dengan ❤️ oleh deamelyaa</p>
        </div>
    </footer>
</body>

</html>