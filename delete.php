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
    <title>Hapus Paket Aktivitas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        h3 {
            color: #333;
        }

        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        p {
            color: #777;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Hapus Paket Aktivitas</h3>
        <?php

        // Ambil ID paket aktivitas dari parameter URL
        $activityId = isset($_GET['id']) ? $_GET['id'] : null;

        // Validasi $activityId 
        if (!is_numeric($activityId) || $activityId <= 0) {
            echo "<p>ID paket sudah dihapus.</p>";
        } else {
            // Query untuk mendapatkan data paket aktivitas berdasarkan ID
            $query = "SELECT * FROM paket_aktivitas WHERE id_paket = $activityId";

            $result = $conn->query($query);

            if ($result === false) {
                echo "Error: " . $query . "<br>" . $conn->error;
            } else {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    ?>
                    <p>Anda yakin ingin menghapus paket aktivitas berikut?</p>
                    <p>Nama Paket:
                        <?php echo $row['nama_paket']; ?>
                    </p>
                    <p>Deskripsi:
                        <?php echo $row['deskripsi']; ?>
                    </p>

                    <form action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id_paket']; ?>">
                        <button type="submit"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus paket aktivitas ini?')">Hapus Paket
                            Aktivitas</button>
                    </form>
                    <?php
                } else {
                    echo "<p>Paket aktivitas tidak ditemukan.</p>";
                }
            }
        }

        // Pastikan ada data yang dikirim melalui metode POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil ID paket aktivitas dari formulir
            $activityId = isset($_POST['id']) ? $_POST['id'] : null;

            // Query untuk menghapus data paket aktivitas berdasarkan ID
            $deleteQuery = "DELETE FROM paket_aktivitas WHERE id_paket = $activityId";

            // Jalankan query penghapusan
            if ($conn->query($deleteQuery) === TRUE) {
                echo "<p>Paket aktivitas berhasil dihapus.</p>";
                echo "<form action='aktivitas.php' method='get'>";
                echo "<button type='submit'>Kembali ke Aktivitas</button>";
                echo "</form>";
            } else {
                echo "Error: " . $deleteQuery . "<br>" . $conn->error;
            }
        }

        // Tutup koneksi
        $conn->close();
        ?>
    </div>
</body>

</html>