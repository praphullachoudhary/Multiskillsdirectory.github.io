<?php
include 'db.php';

$skill_filter = isset($_GET['skill']) ? $_GET['skill'] : '';
$place_filter = isset($_GET['place']) ? $_GET['place'] : '';
$age_filter = isset($_GET['age']) ? $_GET['age'] : '';

$sql = "SELECT * FROM users WHERE role = 'skilled'";

if ($skill_filter != '') {
    $sql .= " AND skills LIKE '%$skill_filter%'";
}
if ($place_filter != '') {
    $sql .= " AND place LIKE '%$place_filter%'";
}
if ($age_filter != '') {
    $sql .= " AND age = '$age_filter'";
}

$sql .= " ORDER BY id DESC"; // Show newest first (Auto increment effect)

$result = $conn->query($sql);
$data = array();

while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>