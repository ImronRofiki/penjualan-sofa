<?php
session_start(); // Mulai session

// Hancurkan semua data session
session_unset();

// Hancurkan session itu sendiri
session_destroy();

// Arahkan kembali ke halaman index atau halaman lain setelah logout
header('Location: ../index.php');
exit();
?>