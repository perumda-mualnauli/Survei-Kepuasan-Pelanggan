<?php
// create.php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_aduan = $_POST['id_aduan'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $pdo->prepare('INSERT INTO aduan (id_aduan, id_pelanggan, nama, status, rating, comment) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id_aduan ,$id_pelanggan, $nama, $status, $rating, $comment]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container mt-5">
        <section class="mb-5">
            <h2>Tambah Aduan Baru</h2>
            <br>
            <form method="post">
                <div class="mb-3">
                    <label for="id_aduan" class="form-label">ID Tiket</label>
                    <input type="text" class="form-control" id="id_aduan" name="id_aduan" required>
                </div>

                <div class="mb-3">
                    <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                    <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Pending" selected>Pending</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Komentar</label>
                    <textarea class="form-control" id="comment" name="comment"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali ke Daftar Aduan</a>
                </div>
            </form>
        </section>

        <footer class="mt-5 text-center">
            <p>&copy; 2025 Perumda Mual Nauli Tapanuli Tengah</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
