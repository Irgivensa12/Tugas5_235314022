<?php 
session_start(); // memulai session
if (!isset($_SESSION["login"]) || $_SESSION["username"] !== 'admin') { // jika session login belum ada atau username bukan admin
    header("Location: ../login.php"); // redirect ke halaman login
    exit;
}
require '../functions.php'; // memanggil file functions.php untuk digunakan di halaman admin
$users = query("SELECT * FROM users"); // query untuk menampilkan data dari tabel user
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>

<a href="../logout.php">Logout</a>
    <h1> Daftar User </h1>
<a href="tambah.php"> Tambah User </a>
<br><br>

<table border="1" cellpadding= "10" cellspacing= "0">

    <tr>
        <th>Id.</th> 
        <th>Username</th>
        <th>Password</th>
        <th>Aksi</th>
    </tr>
<?php $i = 1; ?>
    <?php foreach($users as $row):?>
    <tr>
        <td><?= $i;?></td>
        <td><?= $row["username"];?></td>
        <td><?= $row["password"];?></td>
        <td><a href="hapus.php?id=<?= $row["id"];?>" onclick="return confirm('Apakah Anda Ingin menghapus user ini?');">Hapus</a>
        <a href="edit.php?id=<?= $row["id"];?>">Edit</a></td>
    </tr>
    <?php $i++; ?>
    <?php  endforeach; ?>
</table>
</body>
</html>
