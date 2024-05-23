<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari formulir
    $order_id = $_POST['order_id'];
    $penginapan_id = $_POST['penginapan_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $jumlah_tamu = $_POST['tamu'];
    $nama_bk = $_POST['nama_bk'];
    $no_telp = $_POST['no_telp'];

    $errors = [];

    // Validate form input
    if (empty($nama_bk) || empty($no_telp) || empty($check_in) || empty($check_out) || empty($jumlah_tamu)) {
        $errors[] = "Mohon isi semua kolom dalam formulir pemesanan.";
    }

    if (strtotime($check_in) >= strtotime($check_out)) {
        $errors[] = "Tanggal check-in harus sebelum tanggal check-out.";
    }

    // Validasi tanggal check-in tidak boleh lebih kecil dari hari ini
    if (strtotime($check_in) < strtotime(date("Y-m-d"))) {
        $errors[] = "Tanggal check-in tidak boleh lebih kecil dari hari ini.";
    }

    // Display error messages
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>Error: $error</p>";
        }
        exit;
    }

    $query_get_penginapan = "SELECT * FROM penginapan WHERE id_penginapan = '$penginapan_id'";
    $result_penginapan = $conn->query($query_get_penginapan);

    if ($result_penginapan->num_rows > 0) {
        $row_penginapan = $result_penginapan->fetch_assoc();
        $nama_p = $row_penginapan['nama_p'];
        $alamat = $row_penginapan['alamat'];
        $no_penginapan = $row_penginapan['no'];
        $harga = $row_penginapan['harga'];

        $totalHarga = $jumlah_tamu * $harga;

        $queryInsertBooking = "INSERT INTO booking (akomodasi, check_in, check_out, tamu, nama_bk, no_telp) VALUES ('$penginapan_id', '$check_in', '$check_out', $jumlah_tamu, '$nama_bk', '$no_telp')";

        if ($conn->query($queryInsertBooking) === TRUE) {
            echo "<span style='color: green;'><em><b>Pemesanan berhasil. </b></em></span><br>";
            $order_id = $conn->insert_id;

            // Generate a booking receipt
            $booking_receipt = "
------------------------------------------------------------------------------------------------------
<h2>BUKTI PEMESANAN</h2>
------------------------------------------------------------------------------------------------------

Tanggal Pemesanan: " . date("Y-m-d") . "
Nomor Pemesanan: $order_id

------------------------------------------------------------------------------------------------------
<b>INFORMASI PELANGGAN:</b>

Nama: $nama_bk
Nomor Telepon: $no_telp

------------------------------------------------------------------------------------------------------

<b>DETAIL PESANAN PENGINAPAN:</b>

Nama Penginapan: $nama_p
Alamat Penginapan: $alamat
Nomor Kontak Penginapan: $no_penginapan

Tanggal Check-in: $check_in
Tanggal Check-out: $check_out

Jumlah Kamar: $jumlah_tamu

Harga Kamar: Rp " . number_format($harga, 0, ',', '.') . "

------------------------------------------------------------------------------------------------------

<b>TOTAL PEMBAYARAN:</b>

Total Harga: Rp " . number_format($totalHarga, 0, ',', '.') . "

------------------------------------------------------------------------------------------------------

<b>INSTRUKSI CHECK-IN:</b>

Silakan simpan bukti ini sebagai referensi check-in.

------------------------------------------------------------------------------------------------------

Terima kasih atas pemesanan Anda! Harap simpan bukti ini sebagai referensi.

Selamat menikmati pengalaman menginap Anda!
------------------------------------------------------------------------------------------------------
";

            echo "<pre>$booking_receipt</pre>";
            echo "<br><br><button onclick='window.print()'>Cetak Pemesanan</button>";

            // Agar tombol cetak ga ikut ke print
            echo "<style>
                    @media print {
                        button {
                            display: none;
                        }
                    }
                </style>";
        } else {
            echo "<p>Error: " . $queryInsertBooking . "<br>" . $conn->error . "</p>";
        }
    } else {
        echo "Error: Penginapan tidak ditemukan.";
    }

    $conn->close();
}
?>