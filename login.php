<?php 
session_start(); // memulai session agar bisa menggunakan session
require 'functions.php';

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) { // jika cookie id dan key ada
    $id = $_COOKIE['id']; // ambil cookie id
    $key = $_COOKIE['key']; // ambil cookie key

    // ambil username berdasarkan id
    $result = mysqli_query($db, "SELECT username FROM users WHERE id = $id"); // query untuk menampilkan data dari tabel user berdasarkan id
    $row = mysqli_fetch_assoc($result); // ambil data dari database

    // cek cookie key dan username
    if($key === hash('sha256', $row['username'])) { // jika cookie key sama dengan hash dari username (key itu username yg diacak)
        $_SESSION['login'] = true; // set session login menjadi true
    }
}

if(isset($_SESSION["login"])  && isset($_SESSION["user_id"])) { // jika session login sudah ada
    header("Location: index.php"); // redirect ke halaman admin
    exit; // hentikan script
}

// cek apakah tombol login sudah ditekan atau belum
if(isset($_POST["login"])) {
    // jika sudah, ambil data dari form login
    $username = $_POST["username"];
    $password = $_POST["password"];

   $result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");

    // cek username dan password
    if(mysqli_num_rows($result) === 1) { // untuk menghitung jumlah baris yang dikembalikan oleh query (ketemu nilai = 1)
    
    // cek password
    $row = mysqli_fetch_assoc($result); // ambil data dari database
    if(password_verify($password, $row["password"])){ // untuk cek sebuah string sama atau tidak dengan hash password yang ada di database
        
        // set session
        $_SESSION["login"] = true;
        $_SESSION["user_id"] = $row["id"]; // simpan id user ke session
        $_SESSION["username"] = $row["username"]; // simpan username juga

        // cek remember me
        if(isset($_POST["remember"])) {
            setcookie('id', $row['id'], time() + 60);
            setcookie('key', hash('sha256', $row['username']), time() + 60);
        }

        // arahkan admin ke halaman khusus
        if ($row['username'] === 'admin') {
            header("Location: admin/admin.php");
            exit;
        }

        // selain admin ke index.php
        header("Location: index.php");
        exit; // hentikan script

    } 
}
    $eror = true; // jika username atau password salah, tampilkan pesan error
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login</h1>

    <?php 
    
    if(isset($eror)) : ?>
        <p style="color: red; font-style: italic;">Username atau password salah!</p>
    <?php endif; ?>

    <!-- form untuk login -->
<form action="" method="post">
    <ul>
        <li>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </li>
        <li>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </li>
        <li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
        </li>
        <li>
            <button type="submit" name="login">Submit</button>
        </li>
        <li>
            <p><a href="registrasi.php">Register Now!</a></p>
        </li>
    </ul>
</form>

</body>
</html>