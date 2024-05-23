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
            <nav class="navbar">
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
        <section id="home-slider" class="container">
            <h2><i>Selamat datang,
                    <?php echo $username;
                    "!" ?>!
                </i></h2>
            <div class="slider grab">
                <div class="slide">
                    <img src="lb.png" alt="Kalimantan Slide 1">
                </div>
                <div class="slide">
                    <img src="kalbar.jpg" alt="Kalimantan Slide 2">
                </div>
                <div class="slide">
                    <img src="kaltim.jpg" alt="Kalimantan Slide 3">
                </div>
            </div>
        </section>

        <!-- Informasi -->
        <section id="interesting-info" class="container">
            <h2>Menjadi Saksi Keajaiban Kalimantan</h2>
            <div class="info-content">
                <p>Terletak di jantung Indonesia, Kalimantan mempesona dengan keindahan alamnya yang menakjubkan. Dari
                    hutan
                    hujan tropis yang melimpah hingga sungai yang membelah tanah, setiap sudut Kalimantan menawarkan
                    pengalaman yang tak terlupakan.</p>
                <div class="highlights">
                    <div class="highlight-item">
                        <img src="hutanhujan.png" alt="Hutan Hujan">
                        <p><em>Hutan hujan tropis yang melimpah</p>
                    </div>
                    <div class="highlight-item">
                        <img src="sungai.png" alt="Sungai">
                        <p>Sungai yang membelah tanah Kalimantan</p>
                    </div>
                    <div class="highlight-item">
                        <img src="ff.png" alt="Flora dan Fauna">
                        <p>Keberagaman flora dan fauna yang menakjubkan</em></p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Tips -->
        <section id="travel-tips" class="container">

            <div class="travel-tips">
                <h2>Tips Wisata di Kalimantan</h2>
                <ul>
                    <li>Berhubungan dengan masyarakat setempat dan hormati kebiasaan lokal.</li>
                    <li>Pilih pakaian yang nyaman dan sesuai dengan kondisi iklim.</li>
                    <li>Waktu terbaik untuk mengunjungi Kalimantan adalah selama musim kemarau.</li>
                    <li>Gunakan tabir surya dan seringlah minum air untuk menjaga kesehatan.</li>
                </ul>
            </div>
        </section>
        <!-- Form Ulasan -->
        <div class="reviews">
            <h3>Ulasan Pengunjung</h3>
            <form id="review-form" method="post" action="save_review.php">
                <label for="nama_ul">Nama:</label>
                <input type="text" id="nama_ul" name="nama_ul" required>
                <label for="pengalaman">Pengalaman:</label>
                <select id="pengalaman" name="pengalaman" required>
                    <option value="Aktivitas">Aktivitas</option>
                    <option value="Penginapan">Penginapan</option>
                </select>

                <label for="review">Ulasan:</label>
                <textarea id="review" name="review" rows="4" required></textarea>
                <button type="submit">Kirim Ulasan</button>
            </form>
            <?php
            include 'koneksi.php';

            // Query untuk mengambil data ulasan
            $sql = "SELECT * FROM ulasan";
            $result = $conn->query($sql);

            // Periksa apakah query berhasil dijalankan
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='review-item'>";
                    echo "<p><strong>" . $row["nama_ul"] . "</strong></p>";
                    echo "<p><em> " . $row["pengalaman"] . "</em></p>";
                    echo "<p>" . $row["review"] . "</p>";
                    echo "<p><small><i> " . $row["tgl"] . "</i></small></p>";
                    echo "</div>";
                }
            } else {
                echo "<p>Tidak ada ulasan.</p>";
            }

            $conn->close();
            ?>
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