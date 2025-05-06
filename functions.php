<?php
// Koneksi database
$db = mysqli_connect("localhost", "root", "", "todo"); // username default = root, password = kosong, nama db = todo

// ambil/query data dari tabel users
$result = mysqli_query($db, "SELECT * FROM users"); //query untuk menampilkan data dari tabel user

function register($data) {
    global $db; // mengglobalkan variabel db agar bisa digunakan dalam function
    $username = strtolower(stripslashes($data["username"])); // stripslashes untuk menghilangkan karakter backslash. strtolower untuk mengubah huruf kapital menjadi huruf kecil
    $password = mysqli_real_escape_string($db, $data["password"]); // mysqli_real_escape_string untuk memungkinkan user memasukkan karakter khusus dalam password
    $password2 = mysqli_real_escape_string($db, $data["password2"]); // mysqli_real_escape_string untuk menghindari SQL Injection

    // cek username sudah ada atau belum
    $result = mysqli_query($db, "SELECT username FROM users WHERE username = '$username'"); // query untuk menampilkan data dari tabel user berdasarkan username
    if(mysqli_fetch_assoc($result)) { // jika username sudah ada
        echo "<script>
                alert('Username sudah terdaftar!');
            </script>";
        return false; // jika username sudah ada, kembalikan false
    }

    // cek konfirmasi password
    if($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false; // jika konfirmasi password tidak sesuai, kembalikan false
    }
    //return 1; // jika konfirmasi password sesuai, kembalikan 1

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT); // password di hash (mengacak string) menggunakan algoritma default

    // tambahkan user baru ke database
    mysqli_query($db, "INSERT INTO users VALUES ('', '$username', '$password')"); // query untuk menambahkan data ke dalam tabel users
    return mysqli_affected_rows($db); // mengembalikan jumlah baris yang terpengaruh oleh query terakhir

}