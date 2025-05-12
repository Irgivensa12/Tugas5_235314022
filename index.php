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
    hapusTodo($user_id, $_GET['hapus']);
    header("Location: index.php");
    exit;
}

// jika tombol toggle ditekan
if (isset($_GET['toggle'])) {
    toggleToDo($user_id, $_GET['toggle']);
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <img src="AkuPDD.jpg" alt="Diriku" width="100">
        <h2>Kristoforus Irgivensa Arielino</h2>
        <h3>235314022</h3>
        <p><a href="logout.php" class="logout">Logout</a></p>
    </header>

    <h1 class="todo">To Do List</h1>
    <!-- form tugas -->
    <form action="" class="tugas" method="post">
        <input type="text" name="tugas" placeholder="Tugas baru" required>
        <button type="submit" name="tambah" class="tambah">Tambah</button>
    </form>

    <ul class="todo">
    <?php foreach ($todos as $todo): ?> 
        <!-- loop untuk menampilkan semua tugas -->
        <?php
        $status = trim(strtolower(str_replace("'", "", $todo['status'])));
        // membersihkan status dari karakter yang tidak diinginkan
        ?>
        <li class="todo-item <?= $status === 'selesai' ? 'task-selesai' : '' ?>">
            <!-- menampilkan status tugas -->
            <span class="todo-text"><?= htmlspecialchars($todo['tugas']) ?></span>
            <!-- menampilkan tugas -->
            <div class="todo-actions">
                <?php if ($status === 'selesai'): ?>
                    <!-- jika status selesai, tampilkan tombol disabled -->
                    <a class="btn selesai disabled">Selesai</a>
                    <!-- setting tombol disabled agar tidak bisa diklik -->
                <?php else: ?>
                    <a href="?toggle=<?= $todo['id'] ?>" class="btn selesai">Selesai</a>
                    <!--jika status belum selesai, tampilkan tombol selesai -->
                <?php endif; ?>
                <a href="?hapus=<?= $todo['id'] ?>" class="btn hapus">Hapus</a>
                <!-- tombol hapus untuk menghapus tugas -->
            </div>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>