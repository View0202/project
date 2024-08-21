<?php
include("../db_config.php");

$response = array();

// รับข้อมูลจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $password = $_POST['password'];

    // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลในตาราง customer
    $sql = "INSERT INTO customer (name, surname, email, phone, age, password) VALUES (:name, :surname, :email, :phone, :age, :password)";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":surname", $surname);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":age", $age);
    $stmt->bindParam(":password", $password);

    // Execute the statement
    $result = $stmt->execute();

    if ($result) {
        // รับ ID ของลูกค้าที่เพิ่งเพิ่ม
        $customer_id = $db_con->lastInsertId();

        // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลในตาราง users
        $sql_users = "INSERT INTO users (customer_id, email, password) VALUES (:customer_id, :email, :password)";
        $stmt_users = $db_con->prepare($sql_users);
        $stmt_users->bindParam(":customer_id", $customer_id);
        $stmt_users->bindParam(":email", $email);
        $stmt_users->bindParam(":password", $password); // ควรจะทำการแฮชรหัสผ่านที่นี่

        $result_users = $stmt_users->execute();

        // ตรวจสอบการเพิ่มข้อมูล
        if ($result_users) {
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
