<?php 
session_start(); // memulai session
if(!isset($_SESSION["login"])) { // jika session login belum ada
    header("Location: ../login.php"); // redirect ke halaman login.php
    exit; // menghentikan script
}
require '../functions.php'; // memanggil file functions.php untuk digunakan di halaman tambah.php

$id = $_GET["id"]; // ambil id dari url

// query data user berdasarkan id
$usr = query("SELECT * FROM users WHERE id = $id")[0]; // query untuk menampilkan data dari tabel user berdasarkan id

// Cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])) {

    // cek apakah data berhasil diubah atau tidak
    if(edit($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diedit!');
                document.location.href = 'admin.php'; 
            </script>"; // jika berhasil, kembali ke halaman admin.php
    } else {
        echo "<script>
                alert('Data gagal diedit!');
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
    <title>Edit User</title>
</head>
<body>
    <h1>Edit Data User</h1>
<!-- action untuk menentukan akan dikiram kemana data yg ada dalam form. Method post supaya data yg dikirim tidak tampil di url -->
    <form action="" method="post"> 

        <ul>
            <input type="hidden" name="id" value="<?= $usr["id"]; ?>"> <!-- hidden untuk menyimpan id user yang akan diedit -->
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id= "username" required value="<?= $usr["username"]; ?>">  
                <!-- required untuk menangani agar user tidak mengosongkan data. Value diisi secara dinamis dari url-->
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="text" name="password" id= "password" required value="<?= $usr["password"];?>">
            </li>
        <li>
            <button type="submit" name="submit"> Edit Data </button>
        </li>
        </ul>
    </form>
</body>
</html>