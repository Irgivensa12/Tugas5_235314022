<?php 
require '../functions.php';
$id = $_GET["id"]; // mengambil id dari url

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