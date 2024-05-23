<?php
session_start();
include "koneksi.php";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Ambil id penginapan dari parameter URL
$penginapanId = isset($_GET['id']) ? $_GET['id'] : null;

// Query untuk mendapatkan data penginapan berdasarkan id
$queryPenginapan = "SELECT * FROM penginapan WHERE id_penginapan = $penginapanId";
$resultPenginapan = $conn->query($queryPenginapan);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>KalimantanExplorer - Pesan Online</title>
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
        <!-- Formulir Pemesanan Online -->
        <section id="booking-form" class="container">
            <h2>Pesan Online</h2>

            <?php
            // Periksa apakah data penginapan ditemukan
            if ($resultPenginapan->num_rows > 0) {
                $rowPenginapan = $resultPenginapan->fetch_assoc();
                ?>
                <div class="accommodation">
                    <h3>
                        <?php echo $rowPenginapan['nama_p']; ?>
                    </h3>
                    <img class="accommodation-image" src="<?php echo $rowPenginapan['gambar']; ?>"
                        alt="<?php echo $rowPenginapan['nama_p']; ?>">
                    <p>
                        <?php echo $rowPenginapan['alamat']; ?>
                    </p>
                    <p>
                        <?php echo $rowPenginapan['no']; ?>
                    </p>
                </div>


                <!-- Formulir Pemesanan -->
                <form action="save_booking.php" method="post">
                    <input type="hidden" name="order_id" value="<?php echo uniqid('order_'); ?>">
                    <input type="hidden" name="penginapan_id" value="<?php echo $penginapanId; ?>">

                    <label for="nama_bk">Nama :</label>
                    <input type="text" id="nama_bk" name="nama_bk" required>

                    <label for="no_telp">Nomor Telp :</label>
                    <input type="text" id="no_telp" name="no_telp" required>

                    <label for="check_in">Tanggal Check-in:</label>
                    <input type="date" id="check_in" name="check_in" required>

                    <label for="check_out">Tanggal Check-out:</label>
                    <input type="date" id="check_out" name="check_out" required>

                    <label for="tamu">Jumlah Kamar:</label>
                    <input type="number" id="tamu" name="tamu" min="1" required>

                    <button type="submit">Pesan Sekarang</button>

                    <?php
                    if (!empty($errors)) {
                        echo '<div class="error-message"><ul>';
                        foreach ($errors as $error) {
                            echo '<li>' . $error . '</li>';
                        }
                        echo '</ul></div>';
                    }
                    ?>
                </form>
                <?php
            } else {
                echo "<p>Data penginapan tidak ditemukan.</p>";
            }
            ?>
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