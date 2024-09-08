<?php
// เชื่อมต่อกับฐานข้อมูล
include("../db_config.php");

// ตรวจสอบและเริ่มต้น session ถ้าหาก session ยังไม่ได้เริ่ม
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // เริ่มการใช้งาน session
}

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['u_id'])) {
    echo '<tr><td colspan="4" align="center">กรุณาล็อกอินเพื่อดูข้อมูล</td></tr>';
}

// ดึง customer_id ของผู้ใช้จาก session
$customer_id = $data['customer_id'];

// คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง queue และ employees โดยกรองตาม customer_id
$sql = "SELECT queue.*, employees.* FROM queue 
        JOIN employees ON queue.emp_id = employees.emp_id 
        WHERE queue.customer_id = :customer_id";

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
        echo '<td>' . htmlspecialchars($data['queue_date']) . '</td>';
        echo '<td>' . htmlspecialchars($data['queue_time']) . '</td>';
        echo '<td>' . htmlspecialchars($data['fname']) . '</td>'; // แสดงชื่อพนักงาน
        echo '<td>';
        // แก้ไข customer ID ในแอตทริบิวต์ data
        echo '<button type="button" class="btn btn-primary" style="margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#depositModal" data-customer-id="' . htmlspecialchars($data['customer_id']) . '">ใบเสร็จค่ามัดจำ</button>';
        echo '<button class="btn btn-success" style="margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#reservationModal">เลื่อน</button>';
        echo '<button class="btn btn-warning" style="margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#reservationModal">แก้ไข</button>';
        echo '<button class="btn btn-danger" onclick="deleteQueue(' . htmlspecialchars($data['queue_id']) . ')">ลบการจองคิว</button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4" align="center">ไม่พบข้อมูล</td></tr>';
}

?>
