<?php
session_start(); // เริ่มต้นเซสชัน

include("../db_config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $password = $_POST['password'];

    // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลในตาราง customer
    $sql = "INSERT INTO customer (firstname, lastname, username, email, phone, age, password) VALUES (:firstname, :lastname, :username, :email, :phone, :age, :password)";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":age", $age);
    $stmt->bindParam(":password", $password);

    // Execute the statement
    $result = $stmt->execute();

    if ($result) {
        // รับ ID ของลูกค้าที่เพิ่งเพิ่ม
        $customer_id = $db_con->lastInsertId();

        // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลในตาราง users พร้อมกับสถานะ
        $sql_users = "INSERT INTO users (firstname, lastname, username, password, status) VALUES (:firstname, :lastname, :username, :password, :status)";
        $stmt_users = $db_con->prepare($sql_users);
        $status = 'customer'; // กำหนดสถานะเป็น customer
        $stmt_users->bindParam(":firstname", $firstname);
        $stmt_users->bindParam(":lastname", $lastname);
        $stmt_users->bindParam(":username", $username);
        $stmt_users->bindParam(":password", $password);
        $stmt_users->bindParam(":status", $status);

        $result_users = $stmt_users->execute();

        // ตรวจสอบการเพิ่มข้อมูล
        if ($result_users) {
            $_SESSION["status"] = "active";
            $_SESSION["user_status"] = "customer"; // กำหนด session เป็น customer
            $response['status'] = 'ok';
        } else {
            $response['status'] = 'error';
        }
    } else {
        $response['status'] = 'error';
    }
}

// ปิดการเชื่อมต่อ
echo json_encode($response);
?>
