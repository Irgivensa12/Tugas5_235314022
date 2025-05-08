<?php
session_start();
if (!isset($_SESSION['login']) || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php'; // memanggil file functions.php untuk digunakan di halaman index.php

$user_id = $_SESSION['user_id']; // mengambil user_id dari session
$todos = query("SELECT * FROM todos WHERE user_id = $user_id");

// jika tombol tambah ditekan
if (isset($_POST['tambah'])) { 
    tambahTodo($user_id, $_POST['tugas']);
    header("Location: index.php"); // redirect ke halaman index.php setelah menambah tugas
    exit; // menghentikan script setelah redirect
}

// jika tombol selesai ditekan
if (isset($_GET['selesai'])) {
    selesaiTodo($user_id, $_GET['selesai']);
    header("Location: index.php");
    exit;
}

// jika tombol hapus ditekan
if (isset($_GET['hapus'])) {
    hapusTodo($conn, $user_id, $_GET['hapus']);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
</head>
<body>
<header>
        <h2>Kristoforus Irgivensa Arielino</h2>
        <h3>235314022</h3>
        <img src="AkuPDD.jpg" alt="Diriku" width="100">
        <p><a href="logout.php">Logout</a></p>
    </header>

    <h1>To Do List</h1>
    <form action="" method="post">
        <input type="text" name="tugas" placeholder="Tugas baru" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <ul>
        <?php foreach ($todos as $todo): ?> 
            <!-- looping untuk menampilkan semua tugas -->
            <li>
                <?= htmlspecialchars($todo['task']) ?> 
                <!-- menampilkan isi kolom tugas -->
                <?= $todo['status'] === 'belum' ? "<a href='?selesai={$todo['id']}'>Selesai</a>" : "<span style='color:green;'>(Selesai)</span>" ?>
                <a href="?hapus=<?= $todo['id'] ?>">Hapus</a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>