<?php
include 'koneksi.php';

$nama_ul = $_POST['nama_ul'];
$pengalaman = $_POST['pengalaman'];
$review = $_POST['review'];

// Periksa apakah ada kolom yang kosong dalam formulir ulasan
if (empty($nama_ul) || empty($pengalaman) || empty($review)) {
    die("Mohon isi semua kolom dalam formulir ulasan.");
}

// Prepared statement untuk mencegah SQL Injection
$stmt = $conn->prepare("INSERT INTO ulasan (nama_ul, pengalaman, review) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama_ul, $pengalaman, $review);

// Eksekusi pernyataan SQL
$result = $stmt->execute();

// Periksa apakah eksekusi berhasil
if ($result) {
    // Tutup prepared statement
    $stmt->close();
    // Tutup koneksi database
    $conn->close();

    // Redirect ke halaman utama setelah ulasan terkirim
    header('Location: index.php');
    exit;
} else {
    // Jika eksekusi gagal, tampilkan pesan kesalahan
    die("Terjadi kesalahan saat menyimpan ulasan.");
}
?>
