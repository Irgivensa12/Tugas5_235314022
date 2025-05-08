<?php 
session_start(); // memulai session
if(!isset($_SESSION["login"])) { // jika session login belum ada
    header("Location: ../login.php"); // redirect ke halaman login.php
    exit; // menghentikan script
}
require '../functions.php'; // memanggil file functions.php untuk digunakan di halaman tambah.php
// koneksi ke database
//$db = mysqli_connect("localhost", "root", "", "todo"); 

// Cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if(tambah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'admin.php'; 
            </script>"; // jika berhasil, kembali ke halaman admin.php
    } else {
        echo "<script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'admin.php';
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>
    <h1>Tambah Data User</h1>
<!-- action untuk menentukan akan dikiram kemana data yg ada dalam form. Method post supaya data yg dikirim tidak tampil di url -->
    <form action="" method="post"> 

        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id= "username" required> 
                <!-- required untuk menangani agar user tidak mengosongkan data -->
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="text" name="password" id= "password" required>
            </li>
        <li>
            <button type="submit" name="submit"> Tambah Data </button>
        </li>
        </ul>
    </form>
</body>
</html>