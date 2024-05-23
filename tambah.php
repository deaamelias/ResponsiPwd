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
    <title>Tambah Paket Aktivitas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
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

        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border-radius: 5px;
        }

        .error {
            margin-top: 20px;
            padding: 10px;
            background-color: #f44336;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>

<body>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Aktivitas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
        }

        
        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            margin-top: 20px;
            padding: 10px;
            background-color: #f44336;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Tambah Paket Aktivitas</h3>
        
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newActivityName = htmlspecialchars(trim($_POST["new_activity_name"]));
            $newActivityDescription = htmlspecialchars(trim($_POST["new_activity_description"]));

            if (strlen($newActivityName) > 255) {
                echo '<div class="error">Error: Nama aktivitas terlalu panjang.</div>';
                exit();
            }

            $query = "INSERT INTO paket_aktivitas (nama_paket, deskripsi) VALUES ('$newActivityName', '$newActivityDescription')";

            if ($conn->query($query) === TRUE) {
                echo '<div>Aktivitas berhasil ditambahkan.</div>';
                echo "<form action='aktivitas.php' method='get'>";
                        echo "<button type='submit'>Kembali ke Aktivitas</button>";
                    echo "</form>";
            } else {
                echo '<div class="error">Error: Aktivitas tidak dapat ditambahkan. Silakan coba lagi.</div>';
                echo '<div class="error">Detail Kesalahan: ' . $conn->error . '</div>';
            }
        } else {
            header("Location: index.php");
            exit();
        }

        $conn->close();
        ?>
    </div>
</body>

</html>

