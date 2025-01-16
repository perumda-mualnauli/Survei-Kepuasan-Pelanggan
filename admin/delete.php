<?php
// delete.php
require 'config.php';

// Memastikan ID yang valid diterima dari URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_aduan = $_GET['id'];  // Mendapatkan ID Aduan dari URL

    // Query untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM aduan WHERE id_aduan = :id_aduan";

    try {
        // Menyiapkan dan mengeksekusi query
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_aduan', $id_aduan, PDO::PARAM_STR);  // Binding parameter untuk ID Aduan
        $stmt->execute();

        // Redirect ke halaman index setelah berhasil menghapus data
        header("Location: index.php?status=success");
        exit();

    } catch (\PDOException $e) {
        // Menangani error jika terjadi masalah dalam penghapusan
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID Aduan tidak ditemukan.";
}
?>
