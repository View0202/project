<?php
// เชื่อมต่อกับฐานข้อมูล
include("db_config.php");

// ตรวจสอบและเริ่มต้น session ถ้าหาก session ยังไม่ได้เริ่ม
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // เริ่มการใช้งาน session
}

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['u_id'])) {
    echo '<tr><td colspan="4" align="center">กรุณาล็อกอินเพื่อดูข้อมูล</td></tr>';
    exit; // หยุดการทำงานของสคริปต์
}

// ดึง customer_id ของผู้ใช้จาก session
$customer_id = $_SESSION['u_id']; // ใช้ customer_id ที่มาจาก session

// คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง estimate โดยกรองตาม customer_id
$sql = "SELECT estimate_id, detail, file FROM estimate WHERE customer_id = :customer_id";
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
        echo '<form method="post" action="your_action_page.php">'; // ใส่ action page ของคุณที่ต้องการส่งข้อมูลไป
        echo '<input type="hidden" name="estimate_id" value="' . htmlspecialchars($data['estimate_id']) . '">';
        echo '<button class="btn btn-primary" type="submit" data-bs-toggle="modal" data-bs-target="#estimateModal">การตอบกลับ</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4" align="center">ไม่พบข้อมูล</td></tr>';
}
?>
