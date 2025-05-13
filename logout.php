<?php 

session_start(); // memulai session
session_unset(); // menghapus semua session yang ada
session_destroy(); // menghancurkan session yang sudah ada
setcookie('id', '', time() - 3600); // menghapus cookie id mundurkan 1 jam
setcookie('key', '', time() - 3600); // menghapus cookie key mundurkan 1 jam

header("Location: login.php"); // redirect ke halaman login.php
exit; // menghentikan script
?>