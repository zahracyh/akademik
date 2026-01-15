<?php
session_start();
require 'koneksi.php';

// pastikan user sudah login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];

// pastikan tombol update ditekan
if (isset($_POST['update'])) {

    $nama_lengkap = $_POST['nama_lengkap'];
    $pass = md5($_POST['password']);

    // jika password diisi
    if (!empty($pass)) {
        // enkripsi password dengan MD5
        $password = md5($pass);

        $query = "UPDATE pengguna 
                  SET nama_lengkap='$nama_lengkap', password='$pass'
                  WHERE email='$email'";
    } 
    // jika password tidak diisi
    else {
        $query = "UPDATE pengguna 
                  SET nama_lengkap='$nama_lengkap'
                  WHERE email='$email'";
    }

    // eksekusi query
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Profil berhasil diperbarui');
                window.location='editprofile.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui profil');
                window.history.back();
              </script>";
    }
}
?>