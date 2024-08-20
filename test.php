<?php
// เชื่อมต่อกับฐานข้อมูล
include("../db_config.php");

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    echo '<tr><td colspan="4" align="center">กรุณาล็อกอินเพื่อดูข้อมูล</td></tr>';
    exit;
}

// ดึง customer_id จากเซสชัน
$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null; // ตรวจสอบให้แน่ใจว่าได้ตั้งค่า customer_id ในเซสชัน

// ตรวจสอบว่า customer_id มีอยู่หรือไม่
if (empty($customer_id)) {
    echo '<tr><td colspan="4" align="center">ไม่พบข้อมูลสำหรับคุณ</td></tr>';
    exit;
}

// คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง estimate โดยกรองตาม customer_id
$sql = "SELECT * FROM estimate WHERE customer_id = :customer_id";
$stmt = $db_con->prepare($sql);
$stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

// ดำเนินการคำสั่ง SQL
$stmt->execute();

// ตรวจสอบว่ามีข้อมูลในตารางหรือไม่
if ($stmt->rowCount() > 0) {
    $index = 1; // เริ่มต้นที่ 1
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $index++ . '</td>'; // แสดงหมายเลขแถว
        echo '<td>' . htmlspecialchars($data['detail']) . '</td>';
        echo '<td><img src="../image_estimate/' . htmlspecialchars($data['file']) . '" alt="Image" style="max-width: 150px;"></td>';
        echo '<td>';
        echo '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#estimateModal" data-estimate_id="' . htmlspecialchars($data['estimate_id']) . '">การตอบกลับ</button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4" align="center">ไม่พบข้อมูล</td></tr>';
}
?>
