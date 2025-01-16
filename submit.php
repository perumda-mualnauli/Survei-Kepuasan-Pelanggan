<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'db_survei');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$id_aduan = $_POST['id_aduan'];
$rating = $_POST['rating'];
$komentar = $_POST['comment'];

// Query untuk memperbarui data di tabel aduan
$sql = "UPDATE aduan SET rating = ?, comment = ? WHERE id_aduan = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("isi", $rating, $komentar, $id_aduan);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Rating berhasil diperbarui."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal memperbarui data : " . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Gagal mempersiapkan statement: " . $conn->error]);
}

$conn->close();
?>
