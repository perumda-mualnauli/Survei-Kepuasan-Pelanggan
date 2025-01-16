<?php
// index.php
require 'config.php';

$stmt = $pdo->query('SELECT * FROM aduan');
$aduan = $stmt->fetchAll();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>

<!DOCTYPE html>
<html lang="id">
<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Survei Kepuasan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard">
        <header class="dashboard-header d-flex">
            <img src="../LOGO PERUMDA MUAL NAULI TERBARU 2024.png" alt="Logo Perusahaan" class="me-3" style="width: 80px; height: 80px;">
            <h1><b>Admin Dashboard</b></h1>
            <div class="logout-button">
                <a href="logout.php">Logout</a>
            </div>
        </header>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <div class="dashboard-content">
            <section class="summary">
                <h2><b>Ringkasan</b></h2>
                <div class="cards">
                    <div class="card">
                        <h2><b>Total Survei</b></h2>
                        <p id="total-aduan">0</p>
                    </div>
                    
                    <div class="card">
                        <h2><b>Rating Rata-Rata</b></h2>
                        <p id="average-rating">0</p>
                    </div>
                </div>
            </section><br>

            <section class="data-tables">
            <h1>Daftar Aduan Pelanggan</h1>
            <a href="create.php" class="btn btn-primary mb-3">
                <i class="bi bi-plus-circle"></i> Tambah Aduan
            </a><br>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID Aduan</th>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aduan as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_aduan']) ?></td>
                        <td><?= htmlspecialchars($row['id_pelanggan']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['rating']) ?></td>
                        <td><?= htmlspecialchars($row['comment']) ?></td>
                        <td>
                        <a href="update2.php?id=<?php echo urlencode($row['id_aduan']); ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <a href="delete.php?id=<?php echo urlencode($row['id_aduan']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <i class="bi bi-trash"></i> Hapus
                        </a>



                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </section>

            <section class="charts">
                <h3><b>Statistik Jumlah Pilihan Bintang</h3>
                <div class="chart-container">
                    <canvas id="rating-chart"></canvas>
                </div>
            </section>

        </div>
        <footer class="dashboard-footer">
            <p>© 2025 Perumda Mual Nauli Tapanuli Tengah</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mengambil data dari fetch_dashboard_data.php
        fetch('fetch_dashboard_data.php')
            .then(response => response.json())
            .then(data => {
                console.log(data); // Debugging untuk melihat data yang diterima

                // Menampilkan Total Aduan
                document.getElementById('total-aduan').textContent = data.totalAduan;

                // Menampilkan Rating Rata-Rata
                document.getElementById('average-rating').textContent = parseFloat(data.averageRating).toFixed(2);

                // Menampilkan Daftar Aduan
                const aduanTableBody = document.getElementById('aduan-table');
                aduanTableBody.innerHTML = '';  // Kosongkan isi tabel sebelum menambah data baru
                data.aduanData.forEach(aduan => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${aduan.id_aduan}</td>
                        <td>${aduan.id_pelanggan}</td>
                        <td>${aduan.nama}</td>
                        <td>${aduan.status}</td>
                        <td>${aduan.rating}</td>
                        <td>${aduan.komentar}</td>
                        <td>
                            <a href="update2.php?id=${encodeURIComponent(aduan.id_aduan)}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="delete.php?id=${encodeURIComponent(aduan.id_aduan)}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    `;
                    aduanTableBody.appendChild(row);
                });

                // Menampilkan Statistik Rating pada Grafik
                /*const ratingStats = data.ratingStats;
                const ratingLabels = Object.keys(ratingStats);
                const ratingCounts = Object.values(ratingStats);

                const ctx = document.getElementById('rating-chart').getContext('2d');
                const ratingChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ratingLabels,
                        datasets: [{
                            label: 'Jumlah Aduan Berdasarkan Rating',
                            data: ratingCounts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });*/
            })
            .catch(error => {
                console.error('Error fetching data:', error);
        });
    </script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Ambil data dari fetch_dashboard_data.php
    fetch('fetch_dashboard_data2.php')
        .then(response => response.json())
        .then(data => {
            const ratingStats = data.ratingStats;

            // Data untuk grafik
            const labels = ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5'];
            const values = [ratingStats[1] || 0, ratingStats[2] || 0, ratingStats[3] || 0, ratingStats[4] || 0, ratingStats[5] || 0];

            // Render grafik
            const ctx = document.getElementById('rating-chart').getContext('2d');
            const ratingChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pilihan Bintang',
                        data: values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>
</body>
</html>
