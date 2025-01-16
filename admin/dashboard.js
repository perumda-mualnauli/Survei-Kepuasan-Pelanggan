document.addEventListener("DOMContentLoaded", () => {
    fetchDashboardData();
});

function fetchDashboardData() {
    fetch("fetch_dashboard_data.php")
        .then((response) => response.json())
        .then((data) => {
            document.getElementById("total-aduan").innerText = data.totalAduan;
            document.getElementById("average-rating").innerText = data.averageRating.toFixed(2);
            populateTable(data.aduanData);
            renderChart(data.ratingStats);
        });
}

function populateTable(aduanData) {
    const tableBody = document.getElementById("aduan-table");
    aduanData.forEach((aduan) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${aduan.idAduan}</td>
            <td>${aduan.idPelanggan}</td>
            <td>${aduan.nama}</td>
            <td>${aduan.status}</td>
            <td>${aduan.rating || '-'}</td>
            <td>${aduan.komentar || '-'}</td>
        `;
        tableBody.appendChild(row);
    });
}

function renderChart(ratingStats) {
    const ctx = document.getElementById("rating-chart").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: Object.keys(ratingStats),
            datasets: [
                {
                    label: "Jumlah Rating",
                    data: Object.values(ratingStats),
                    backgroundColor: "rgba(54, 162, 235, 0.6)",
                },
            ],
        },
    });
}
