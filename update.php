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
    <title>Edit Paket Aktivitas</title>
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
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            text-align: center;
        }

        h3 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #4caf50;
            font-weight: bold;
        }

        button {
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Edit Paket Aktivitas</h3>
        <?php

        // Pastikan ada data yang dikirim melalui metode POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari formulir edit
            $activityId = $_POST['id'];
            $activityName = $_POST['activity_name'];
            $activityDescription = $_POST['activity_description'];

            // Query untuk melakukan update data paket aktivitas
            $updateQuery = "UPDATE paket_aktivitas SET nama_paket = '$activityName', deskripsi = '$activityDescription' WHERE id_paket = $activityId";

            // Jalankan query update
            if ($conn->query($updateQuery) === TRUE) {
                // kembali ke halaman aktivitas.php setelah berhasil update
                echo "<p>Perubahan berhasil disimpan.</p>";
                echo " <form action='aktivitas.php' method='get'>";
                echo " <button type='submit'>Kembali ke Aktivitas</button>";
                echo "</form>";

            } else {
                echo "Error: " . $updateQuery . "<br>" . $conn->error;
            }
        } else {
            echo "<p>Error: Metode tidak valid.</p>";
        }

        $conn->close();
        ?>

    </div>
</body>

</html>