<?php
// update.php
require 'config.php';

$id = $_GET['id'];

// Cek apakah id_aduan ada
if (empty($id)) {
    die('ID Aduan tidak ditemukan.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_aduan = $_POST['id_aduan'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $pdo->prepare('UPDATE aduan SET id_aduan = ?, id_pelanggan = ?, nama = ?, status = ?, rating = ?, comment = ? WHERE id_aduan = ?');
    $stmt->execute([$id_aduan, $id_pelanggan, $nama, $status, $rating, $comment, $id]);

    header('Location: index.php');
    exit;
} else {
    $stmt = $pdo->prepare('SELECT * FROM aduan WHERE id_aduan = ?');
    $stmt->execute([$id]);
    $aduan = $stmt->fetch();

    // Cek jika data ditemukan
    if (!$aduan) {
        die('Aduan tidak ditemukan.');
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Edit Aduan</h1>

        <form method="post" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="id_aduan" class="form-label">ID Tiket</label>
                <input type="text" class="form-control" id="id_aduan" name="id_aduan" value="<?= htmlspecialchars($aduan['id_aduan']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= htmlspecialchars($aduan['id_pelanggan']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($aduan['nama']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Pending" <?= $aduan['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Selesai" <?= $aduan['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="number" class="form-control" id="rating" name="rating" value="<?= htmlspecialchars($aduan['rating']) ?>" min="1" max="5" required>
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Komentar</label>
                <textarea class="form-control" id="comment" name="comment" rows="4" required><?= htmlspecialchars($aduan['comment']) ?></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
