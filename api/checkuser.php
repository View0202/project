<?php

include("../db_config.php");
session_start(); // เริ่มต้นเซสชัน

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // ตรวจสอบว่าคำขอเป็น POST หรือไม่
    $email = $_POST['email']; // รับอีเมลจากคำขอ
    $password = $_POST['password']; // รับรหัสผ่านจากคำขอ

    // คำสั่ง SQL เพื่อตรวจสอบว่าผู้ใช้งานมีอยู่ในฐานข้อมูลหรือไม่
    $sql = "SELECT * FROM customer WHERE email = ?";
    $stmt = $db_con->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
    $stmt->bindParam(1, $email); // ผูกพารามิเตอร์สำหรับอีเมล
    $stmt->execute(); // ดำเนินการคำสั่ง
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // รับผลลัพธ์ในรูปแบบ associative array

    if ($row) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['customer_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            echo json_encode(['success' => true, 'status' => 'ok']);
        } else {
            echo json_encode(['success' => false, 'status' => 'error', 'message' => 'ไม่สามารถเข้าสู่ระบบได้']);
        }
    } else {
        echo json_encode(['success' => false, 'status' => 'error', 'message' => 'เบอร์โทรศัพท์หรือรหัสผ่านไม่ถูกต้อง']);
    }
    
} else {
    // ถ้าคำขอไม่ใช่ POST ให้ตอบกลับด้วยข้อผิดพลาด
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
