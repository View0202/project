<?php

include("../db_config.php");
session_start(); // เริ่มต้นเซสชัน

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // ตรวจสอบว่าคำขอเป็น POST หรือไม่
    $email = $_POST['email']; // รับอีเมลจากคำขอ
    $password = $_POST['password']; // รับรหัสผ่านจากคำขอ

    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $password);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Set session variables
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        // Respond with success
        echo json_encode(['success' => true]);
    } else {
        // If login fails, respond with error
        echo json_encode(['success' => false, 'message' => 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง']);
    }
} else {
    // ถ้าคำขอไม่ใช่ POST ให้ตอบกลับด้วยข้อผิดพลาด
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>


