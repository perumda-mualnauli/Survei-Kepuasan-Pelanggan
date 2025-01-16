<?php
$conn = new mysqli("localhost", "root", "", "db_survei");

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$response = [
    "totalAduan" => 0,
    "averageRating" => 0,
    "aduanData" => [],
    "ratingStats" => [],
];

// Total aduan
$totalAduanResult = $conn->query("SELECT COUNT(*) AS total FROM aduan");
$response["totalAduan"] = $totalAduanResult->fetch_assoc()["total"] ?? 0;

// Rating rata-rata
$averageRatingResult = $conn->query("SELECT AVG(rating) AS average FROM aduan WHERE rating IS NOT NULL");
$response["averageRating"] = $averageRatingResult->fetch_assoc()["average"] ?? 0;

// Data aduan
$aduanResult = $conn->query("SELECT * FROM aduan");
while ($row = $aduanResult->fetch_assoc()) {
    $response["aduanData"][] = $row;
}

// Statistik rating
$ratingStatsResult = $conn->query("SELECT rating, COUNT(*) AS count FROM aduan WHERE rating IS NOT NULL GROUP BY rating");
while ($row = $ratingStatsResult->fetch_assoc()) {
    $response["ratingStats"][$row["rating"]] = $row["count"];
}

echo json_encode($response);
$conn->close();
?>

