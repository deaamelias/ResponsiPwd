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
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            text-align: center;
        }

        h3 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
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
        // Ambil ID paket aktivitas dari parameter URL
        $activityId = $_GET['id'];

        // Query untuk mendapatkan data paket aktivitas berdasarkan ID
        $query = "SELECT * FROM paket_aktivitas WHERE id_paket = $activityId";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Tampilkan formulir edit
            $row = $result->fetch_assoc();
            ?>
            <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id_paket']; ?>">
                <label for="activity_name">Nama Aktivitas:</label>
                <input type="text" id="activity_name" name="activity_name" value="<?php echo $row['nama_paket']; ?>" required>

                <label for="activity_description">Deskripsi Aktivitas:</label>
                <textarea id="activity_description" name="activity_description" rows="4" required><?php echo $row['deskripsi']; ?></textarea>

                <button type="submit">Simpan Perubahan</button>
            </form>
            <?php
        } else {
            echo "<p>Paket aktivitas tidak ditemukan.</p>";
        }
        ?>
    </div>
</body>
</html>
