<?php 
session_start(); // memulai session agar bisa menggunakan session

if(isset($_SESSION["login"])  && isset($_SESSION["user_id"])) { // jika session login sudah ada
    header("Location: index.php"); // redirect ke halaman admin
    exit; // hentikan script
}
require 'functions.php';

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
        $_SESSION["login"] = true; // cek session login di tiap halaman
        //$loginSuccess = true; // jika login berhasil, set session login menjadi true
        $_SESSION["user_id"] = $row["id"];
        header("Location: index.php"); // jika password benar, redirect ke halaman index
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
            <button type="submit" name="login">Submit</button>
        </li>
    </ul>
</form>

</body>
</html>