<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "db_survei";

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$id_aduan = $_POST['id_aduan'];
$rating = $_POST['rating'];
$komentar = $_POST['komentar'];

// Validasi input
if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
    die("Rating harus bernilai antara 1 hingga 5.");
}

if (strlen($komentar) > 225) {
    die("Komentar terlalu panjang. Maksimal 225 karakter.");
}

// Update tabel aduan
$sql = "UPDATE aduan SET rating = ?, komentar = ?, updated_at = NOW() WHERE id_aduan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $rating, $komentar, $id_aduan);

if ($stmt->execute()) {
    echo "Penilaian berhasil disimpan!";
} else {
    echo "Error: " . $stmt->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
