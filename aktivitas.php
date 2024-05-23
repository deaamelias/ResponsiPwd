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
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Ambil data role dari hasil query
    $row = $result->fetch_assoc();
    $userRole = $row['role'];

    // Periksa apakah pengguna adalah admin
    $admin_roles = ['Admin'];
    $can_edit_delete = in_array($userRole, $admin_roles);
} else {
    // Handle jika query tidak mengembalikan hasil
    $can_edit_delete = false;
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
        <!-- Activitas -->
        <section id="activities" class="container">
            <h2>Aktivitas di Kalimantan</h2>

            <!-- Deskripsi Aktivitas -->
            <div class="activity-description">
                <p>
                    Kalimantan menawarkan berbagai aktivitas wisata yang menarik dan unik.
                    Mulai dari trekking hutan hujan tropis yang megah, menyusuri sungai yang mengalir
                    di tengah alam liar, hingga mengunjungi suku-suku pedalaman yang mempertahankan
                    tradisi kuno mereka.
                </p>
            </div>

            <!-- Foto dan Video -->
            <div class="activity-media">
                <div class="media-item">
                    <img src="trekking.png" alt="Trekking Hutan Kalimantan">
                    <p>Trekking Hutan Kalimantan</p>
                </div>
                <div class="media-item">
                    <img src="river.png" alt="River Cruise di Sungai Kalimantan">
                    <p>River Cruise di Sungai Kalimantan</p>
                </div>
                <div class="media-item">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/MFbVr2VMmOI?si=u7SlQj56c3ybZF26"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                    <p>Video: Menyusuri Sungai Kapuas</p>
                </div>
            </div>

            <!-- Paket Aktivitas -->
            <div class="activity-packages">
                <h3>Paket Aktivitas</h3>

                <?php
                // Ambil data paket aktivitas dari database
                $query = "SELECT * FROM paket_aktivitas";
                $result = $conn->query($query);

                // Periksa apakah query berhasil dijalankan
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $activityId = $row['id_paket'];
                        $activityName = $row['nama_paket'];
                        $activityDescription = $row['deskripsi'];

                        echo '<div class="package-item">';
                        echo '<h4>' . $activityName . '</h4>';
                        echo '<p>' . $activityDescription . '</p>';

                        // Jika pengguna adalah admin, maka dapat edit dan hapus 
                        if ($can_edit_delete) {
                            echo '<div class="admin-actions">';
                            echo '<a href="edit.php?id=' . $activityId . '">Edit</a>';
                            echo '<a href="delete.php?id=' . $activityId . '">Hapus</a>';
                            echo '</div>';
                        }
                        // Namun jika bukan admin tidak dapat melihat tombol edit dan hapus
                        echo '</div>';
                    }
                } else {
                    echo "<p>Tidak ada paket aktivitas.</p>";
                }

                // Jika admin dapat menambahkan paket aktivitas
                if ($can_edit_delete) {
                    echo '<div class="admin-actions">';
                    echo '<a href="create.php">Tambah Paket Aktivitas</a>';
                    echo '</div>';
                }
                ?>

            </div>
        </section>
    </main>
    <footer class="container">
        <div class="footer-bottom">
            <p>&copy; 2023 KalimantanExplorer | Dibuat dengan ❤️ oleh deamelyaa</p>
        </div>
    </footer>
    <!-- JavaScript untuk Slider -->
    <script src="script.js"></script>
</body>
</html>