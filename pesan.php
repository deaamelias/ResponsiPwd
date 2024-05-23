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
    <main>
        <div class="container">
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Ambil data dari formulir
                $nama = $_POST['name'];
                $email = $_POST['email'];
                $pesan = $_POST['message'];

                // Simpan data ke dalam database
                $query = "INSERT INTO pesan (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";

                if ($conn->query($query) === TRUE) {
                    echo "<h2>Pesan Terkirim</h2>";
                    echo "<p><i>Pesan Anda telah berhasil dikirim! Terima kasih atas feedback Anda.</i></p>";

                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            }
            ?>
            <br><br><a href="kontak.php" class="back-button">Kembali ke Kontak</a>
            </section>
    </main>

</body>

</html>