<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Kepuasan Pengguna</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
    <img src="LOGO PERUMDA MUAL NAULI TERBARU 2024.png" alt="Logo Perusahaan" class="me-3" style="width: 100px; height: 100px;">
    <h1 class="text-center mb-4"><b>Survei Kepuasan Pelanggan <br> Perumda Mual Nauli Tapanuli Tengah</b></h1>
        <!-- Form Pencarian -->
        <div class="card p-4 mb-4">
            <form method="GET" action="">
                <div class="mb-3">
                    <label for="idaduan" class="form-label"><b>ID Tiket Aduan Pelanggan</b></label>
                    <input type="text" id="idaduan" name="idaduan" class="form-control" placeholder="Masukkan ID Tiket">
                </div>
                <div class="mb-3">
                    <label for="idpelanggan" class="form-label"><b>ID Pelanggan</b></label>
                    <input type="text" id="idpelanggan" name="idpelanggan" class="form-control" placeholder="Masukkan ID Pelanggan">
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <!-- Tabel Data Aduan -->
        <div class="card p-4">
            <h5 class="card-title"><b>Biodata Pelanggan</b></h5>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Field</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
               
                <?php
                    // Koneksi ke database
                    $conn = new mysqli('localhost', 'root', '', 'db_survei');

                    // Cek koneksi
                    if ($conn->connect_error) {
                        die('Koneksi gagal: ' . $conn->connect_error);
                    }

                    // Ambil data dari input
                    $idaduan = isset($_GET['idaduan']) ? $_GET['idaduan'] : '';
                    $idpelanggan = isset($_GET['idpelanggan']) ? $_GET['idpelanggan'] : '';

                    // Variabel untuk menentukan apakah data ditemukan
                    $dataFound = false;

                    // Tampilkan data hanya jika ada pencarian
                    if (!empty($idaduan) || !empty($idpelanggan)) {
                        // Query pencarian
                        $sql = "SELECT * FROM aduan WHERE 1=1";
                        if ($idaduan) {
                            $sql .= " AND id_aduan = '$idaduan'";
                        }
                        if ($idpelanggan) {
                            $sql .= " AND id_pelanggan = '$idpelanggan'";
                        }

                        $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        $dataFound = true; // Set dataFound ke true jika data ditemukan
                        while ($row = $result->fetch_assoc()) {
                            echo "
                                    <tr><td>ID Tiket</td><td>{$row['id_aduan']}</td></tr>
                                    <tr><td>ID Pelanggan</td><td>{$row['id_pelanggan']}</td></tr>
                                    <tr><td>Nama</td><td>{$row['nama']}</td></tr>
                                    <tr><td>Status</td><td>{$row['status']}</td></tr>
                                    <tr><td>Rating</td><td>{$row['rating']}</td></tr>
                                    <tr><td>Komentar</td><td>{$row['comment']}</td></tr>
                                ";
                        }
                    } else {
                        echo '<tr><td colspan="10">Data Tidak DiTemukan</td></tr>';
                    }
                    } else {
                        // Tabel kosong jika belum ada input pencarian
                        echo '<tr><td colspan="10">Silakan masukkan ID Tiket Dan ID Pelanggan untuk mencari data.</td></tr>';
                    }

                    // Tutup koneksi
                    $conn->close();
                ?>
                </tbody>
            </table>
        </div>

        <?php
        $conn = new mysqli("localhost", "root", "", "db_survei");
        $result = $conn->query("SELECT rating, COUNT(*) as count FROM aduan GROUP BY rating");
        $ratings = [];
        $total = 0;

        while ($row = $result->fetch_assoc()) {
            $ratings[$row['rating']] = $row['count'];
            $total += $row['count'];
        }
        ?>

        <script src="script.js" defer></script>
              <!-- Form Penilaian -->
              <?php
                if ($dataFound) {
            ?>
            <div class="survey-container">
                <div class="form">
                    <h3 class="card-title"><b>Beri Penilaian</b></h3><br>
                    <div id="stars" class="mb-3">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="star btn btn-outline-warning" data-value="<?= $i ?>">&#9734;</span>
                        <?php endfor; ?>
                    </div>
                    <textarea id="comment" name="comment" placeholder="Input saran yang membangun (Optional)"></textarea>
                    <input type="hidden" id="rating" name="rating" />
                    <input type="hidden" id="id_aduan" name="id_aduan" value="<?php echo htmlspecialchars($idaduan); ?>" />
                    <button id="submitBtn" onclick="submitRating()">Kirim</button>
                    <br><br><ul class="list-unstyled mb-3">
                        <li><strong>Bintang Satu:</strong> Tidak Puas</li>
                        <li><strong>Bintang Dua:</strong> Kurang Puas</li>
                        <li><strong>Bintang Tiga:</strong> Cukup</li>
                        <li><strong>Bintang Empat:</strong> Puas</li>
                        <li><strong>Bintang Lima:</strong> Sangat Puas</li>
                    </ul>
                </div>
              
                
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    // Menangani klik pada bintang untuk memberi rating
                    const stars = document.querySelectorAll('.star');
                    stars.forEach(star => {
                        star.addEventListener('click', function () {
                            const value = this.getAttribute('data-value');
                            stars.forEach(s => s.innerHTML = '&#9734;');  // Reset semua bintang
                            for (let i = 0; i < value; i++) {
                                stars[i].innerHTML = '&#9733;';  // Menandai bintang yang dipilih
                            }
                            document.getElementById('rating').value = value; // Simpan nilai rating di input tersembunyi
                        });
                    });

                    // Fungsi untuk mengirim rating dan komentar ke server
                    function submitRating() {
                        const id_aduan = document.getElementById('id_aduan').value;
                        const rating = document.getElementById('rating').value;
                        const comment = document.getElementById('comment').value;

                        if (!rating) {
                            alert("Silakan pilih rating.");
                            return;
                        }

                        // Kirim ke server menggunakan AJAX
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "submit.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onload = function () {
                            if (xhr.status === 200) {
                                const response = JSON.parse(xhr.responseText);
                                alert(response.message);
                                if (response.status === "success") {
                                    location.reload(); // Refresh halaman untuk memperbarui tabel
                                }
                            } else {
                                alert("Terjadi kesalahan. Silakan coba lagi.");
                            }
                        };
                        xhr.send(`id_aduan=${encodeURIComponent(id_aduan)}&rating=${encodeURIComponent(rating)}&comment=${encodeURIComponent(comment)}`);
                    }
                </script>

                <?php
                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "db_survei");

                    // Cek koneksi
                    if ($conn->connect_error) {
                        die("Koneksi database gagal: " . $conn->connect_error);
                    }

                    // Query untuk menghitung rata-rata rating dan jumlah penilaian
                    $query = "SELECT AVG(rating) AS average_rating, COUNT(rating) AS total_ratings FROM aduan";
                    $result = $conn->query($query);

                    $averageRating = 0;
                    $totalRatings = 0;
                    if ($result && $row = $result->fetch_assoc()) {
                        $averageRating = round($row['average_rating'], 1); // Rata-rata dengan 1 desimal
                        $totalRatings = $row['total_ratings']; // Total jumlah penilaian
                    }

                    // Tutup koneksi
                    $conn->close();
                ?>

                    <div class="result">
                    <b><h2 class="card-title mb-3">Hasil Survei</b></h2>
                        <!-- Total Penilaian dan Rata-rata Rating -->
                        <div class="d-flex justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-thumbs-up text-primary mr-2"></i>
                                <div>
                                    <h5 class="mb-0"><strong>Total Penilaian:</strong></h5 >
                                    <h3 class="text-success"><?= $total ?: 0 ?></h3>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="fas fa-star-half-alt text-warning mr-2"></i>
                                <div>
                                    <h5 class="mb-0"><strong>Rata-rata Rating:</strong></h5>
                                    <h3 class="text-warning"><?= $averageRating ?: 0 ?> ★</h3>
                                </div>
                            </div>
                        </div>
                    <ul class="list-group">
                        <?php for ($i = 5; $i >= 1; $i--): 
                            $count = $ratings[$i] ?? 0;
                            $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                            $colorClass = ''; // Kelas warna default

                            // Tentukan kelas warna berdasarkan bintang
                            switch ($i) {
                                case 5: $colorClass = 'bg-success'; break; // Hijau
                                case 4: $colorClass = 'bg-primary'; break; // Biru
                                case 3: $colorClass = 'bg-info'; break;    // Cyan
                                case 2: $colorClass = 'bg-warning'; break; // Kuning
                                case 1: $colorClass = 'bg-danger'; break;  // Merah
                            }
                        ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <!-- Bintang -->
                                <span class="<?= str_replace('bg-', 'text-', $colorClass) ?>"><?= $i ?> ★</span>
                                
                               <!-- Progress Bar -->
                            <div class="progress w-50">
                                <div class="progress-bar <?= $colorClass ?>" role="progressbar" 
                                    style="width: <?= $percentage ?>%" 
                                    aria-valuenow="<?= $percentage ?>" 
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            
                            <!-- Persentase -->
                            <span class="<?= str_replace('bg-', 'text-', $colorClass) ?>">(<?= number_format($percentage, 2) ?>%)</span>
                        </li>
                    <?php endfor; ?>
                </ul>
                                </div>
                </div>
                <?php
            }
            ?>
    </div>
    <footer class="dashboard-footer">
        <p>© 2025 Perumda Mual Nauli Tapanuli Tengah</p>
    </footer>        
</body>
</html>

