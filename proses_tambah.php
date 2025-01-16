<?php
include 'koneksi.php';

$tiket = $_POST['tiket'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$pesan = $_POST['pesan'];

$query = "INSERT INTO aduan (tiket, nama, alamat, no_telp, pesan, status) VALUES ('$tiket', '$nama', '$alamat', '$no_telp', '$pesan', 'Pending')";
if (mysqli_query($koneksi, $query)) {
    echo "Data berhasil ditambahkan.";
    header('Location: index.php');
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}
?>
