<?php
session_start();

// ตรวจสอบสถานะการล็อกอิน
if ($_SESSION["status"] != "active") {
    // ถ้าไม่ล็อกอิน ให้เปลี่ยนเส้นทางไปที่หน้าเข้าสู่ระบบ
    header("Location: login.php");
    exit();
}

// ตรวจสอบประเภทผู้ใช้
$user_status = $_SESSION["user_status"];

if ($user_status == "superadmin") {
    // เข้าถึงสิทธิ์ของ superadmin
} elseif ($user_status == "admin") {
    // เข้าถึงสิทธิ์ของ admin
} elseif ($user_status == "employee") {
    // เข้าถึงสิทธิ์ของ employee
} elseif ($user_status == "customer") {
    header("Location: home.php"); // เปลี่ยนเส้นทางไปยังหน้า home.php
    exit(); // หยุดการทำงานของสคริปต์หลังการเปลี่ยนเส้นทาง
} else {
    // ผู้ใช้ไม่มีสิทธิ์เข้าถึง
    echo "คุณไม่มีสิทธิ์เข้าถึงหน้านี้.";
    header("Location: index.php");
    exit();
}

// ที่เหลือของโค้ดที่ต้องการให้ทุกประเภทผู้ใช้สามารถเข้าถึงได้
?>
