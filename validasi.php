<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nama_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$id_tiket = $_POST['id_tiket'];
$id_pelanggan = $_POST['id_pelanggan'];

// Validasi ID Tiket dan ID Pelanggan
$sql = "SELECT * FROM validasi_pelanggan WHERE id_tiket = ? AND id_pelanggan = ? AND valid = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $id_tiket, $id_pelanggan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // ID valid
    echo "<script>
            alert('ID Valid! Silakan isi survei.');
            document.getElementById('form-validasi').style.display = 'none';
            document.getElementById('form-survei').style.display = 'block';
          </script>";
} else {
    // ID tidak valid
    echo "<script>alert('ID Tiket atau ID Pelanggan tidak valid!');</script>";
}

$conn->close();
?>
