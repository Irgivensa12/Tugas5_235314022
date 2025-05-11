<?php 
require '../functions.php';
// Periksa apakah parameter id ada di URL
if(!isset($_GET["id"])) {
    header("Location: admin.php");
    exit;
}

$id = $_GET["id"];

if(hapus($id) > 0) { // jika id lebih dari 0, maka hapus data
    echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'admin.php'; 
            </script>"; // jika berhasil, kembali ke halaman admin.php
}
else {
    echo "<script>
            alert('Data gagal dihapus!');
            document.location.href = 'admin.php';
        </script>";
}
?>