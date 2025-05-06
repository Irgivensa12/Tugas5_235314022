<?php 
require 'functions.php';

// kondisi jika tombol register ditekan

if(isset($_POST["register"])) {

    if(register($_POST) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan!');
                document.location.href = 'index.php'; 
            </script>"; // jika berhasil, kembali ke halaman admin.php
}
    else {
        echo mysqli_error($db); //jika gagal query untuk menampilkan data, tampilkan error
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <!-- Styling CSS -->
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
<ul>
    <li>
        <label for="username">Username :</label>
        <input type="text" name="username" id= "username">
    </li>
    <li>
        <label for="password">Password :</label>
        <input type="password" name="password" id= "password">
    </li>
    <li>
        <label for="password2">Konfirmasi Password :</label>
        <input type="password" name="password2" id= "password2">
    </li>
    <li>
        <button type= "submit" name = "register">Register</button>
    </li>
</ul>
    </form>
</body>
</html>