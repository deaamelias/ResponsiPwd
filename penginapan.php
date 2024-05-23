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
        <section id="accommodations" class="container3">
            <h2>Penginapan di Kalimantan</h2>

            <!-- Hotel dan Penginapan -->
            <div class="search-results">
                <?php
                include 'koneksi.php';

                // Fetch hotel data from the database
                $query = "SELECT * FROM penginapan";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $penginapanId = $row['id_penginapan'];
                        $penginapanName = $row['nama_p'];
                        $penginapanAddress = $row['alamat'];
                        $penginapanPhone = $row['no'];
                        $penginapanImage = $row['gambar'];
                        $penginapanHarga = $row['harga'];
                        ?>
                        <div class="penginapan">
                            <h3>
                                <?php echo $penginapanName; ?>
                            </h3>
                            <img src="<?php echo $penginapanImage; ?>" alt="<?php echo $penginapanName; ?>">
                            <p>
                                <?php echo $penginapanAddress; ?>
                            </p>
                            <p>
                                <?php echo $penginapanPhone; ?>
                            </p><br>
                            <h3><em>Harga</em></h3>
                            <p>
                                <?php echo 'Rp. ' . $penginapanHarga; ?>
                            </p><br>
                            <a href="pesan_online.php?id=<?php echo $penginapanId; ?>" class="booking-button">Pesan</a>

                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Tidak ada data penginapan.</p>";
                }

                $conn->close();
                ?>
            </div>

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