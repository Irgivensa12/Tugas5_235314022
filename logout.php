<?php 

session_start(); // memulai session
session_unset(); // menghapus semua session yang ada
session_destroy(); // menghancurkan session yang sudah ada

header("Location: login.php"); // redirect ke halaman login.php
exit; // menghentikan script
?>