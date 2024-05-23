<?php
include "koneksi.php";
$nama_user = $_POST['nama_user'];
$username = $_POST['username'];
$email = $_POST['email'];
$role = $_POST['role'];
$password = md5($_POST['password']);

$sql = "INSERT INTO user (username, password, nama_user, email, role) VALUES ('$username', '$password', '$nama_user', '$email', '$role')";
$query = mysqli_query($conn, $sql);
mysqli_close($conn);

header("Location: login.php");