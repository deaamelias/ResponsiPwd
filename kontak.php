<?php
session_start();
include "koneksi.php";
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Ambil informasi pengguna dari session
$username = $_SESSION['username'];
$query = "SELECT role FROM user WHERE username = '$username'";

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
        <section id="contact" class="container">
            <h2>Hubungi Kami</h2>
            <div class="contact-info">
                <p>Jika Anda memiliki pertanyaan atau ingin mendapatkan informasi lebih lanjut, silakan hubungi kami:
                </p>
                <ul>
                    <li><strong>Email:</strong> <a
                            href="mailto:info@kalimantanexplorer.com">info@kalimantanexplorer.com</a></li>
                    <li><strong>Telepon:</strong> +62 123 456 789</li>
                    <li><strong>Alamat:</strong> Jl. Contoh No. 123, Kota Wisata, Kalimantan</li>
                </ul>
            </div>
            <!-- Formulir Kontak -->
            <form id="contact-form" action="pesan.php" method="post">
                <label for="nama_ul">Nama:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Pesan:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Kirim Pesan</button>
            </form>
        </section>
    </main>
    <footer class="container">
        <div class="footer-bottom">
            <p>&copy; 2023 KalimantanExplorer | Dibuat dengan ❤️ oleh deamelyaa</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>