<?php
session_start();

session_unset();

// Hancurkan session
session_destroy();
echo "Anda telah sukses keluar sistem <b>LOGOUT</b>";
echo "<br>Silahkan login : <a href='login.php'>LOGIN</a>";
// Redirect ke halaman login
header('Location: login.php');
exit;


