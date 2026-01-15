<?php
session_start();
require 'koneksi.php';

// pastikan user sudah login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];
$query = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE email='$email'");
$data = mysqli_fetch_assoc($query);
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 350px;">
            <h4 class="text-center fw-bold mb-4">Edit Profil</h4>
                <form action="proses_editprofile.php" method="POST">
                    <!-- kirim email -->
                    <input type="hidden" name="email" value="<?= $data['email']; ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?= $data['nama_lengkap']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?= $data['email']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti password
                        </small>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
                <div class="text-center mt-3">
                    <a href="index.php" class="text-decoration-none">Kembali</a>
                </div>
        </div>
    </div>
</body>
</html>
