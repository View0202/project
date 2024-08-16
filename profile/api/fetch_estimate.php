<?php
// เชื่อมต่อกับฐานข้อมูล
include("../db_config.php");

// คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง estimate
$sql = "SELECT * FROM estimate";
$stmt = $db_con->query($sql);

// ตรวจสอบว่ามีข้อมูลในตารางหรือไม่
if ($stmt->rowCount() > 0) {
    $index = 1; // เริ่มต้นที่ 1
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $index++ . '</td>'; // แสดงหมายเลขแถว
        echo '<td>' . $row['detail'] . '</td>';
        echo '<td><img src="../image_estimate/' . $row['file'] . '" alt="Image" style="max-width: 150px;"></td>';
        echo '<td>';
        echo '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#estimateModal">การตอบกลับ</button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4" align="center">ไม่พบข้อมูล</td></tr>';
}
?>
