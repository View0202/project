<?php
include("../db_config.php");

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT id, detail, file FROM estimate";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = [];
}

echo json_encode($data);

$conn->close();
?>
