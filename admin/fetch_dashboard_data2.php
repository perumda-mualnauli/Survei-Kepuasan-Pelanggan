<?php
$conn = new mysqli("localhost", "root", "", "db_survei");

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$response = [
    "ratingStats" => []
];

// Hitung jumlah orang untuk setiap bintang (1 sampai 5)
$ratingStatsResult = $conn->query("
    SELECT rating, COUNT(*) AS count 
    FROM aduan 
    WHERE rating BETWEEN 1 AND 5
    GROUP BY rating 
    ORDER BY rating ASC
");

while ($row = $ratingStatsResult->fetch_assoc()) {
    $response["ratingStats"][$row["rating"]] = (int)$row["count"];
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
?>
