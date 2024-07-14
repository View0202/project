<?php
    include("../db_config.php");

    $response = array();

    // รับข้อมูลจากฟอร์ม
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $surname = $_POST['surname'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_cf = $_POST['password_cf'];

        // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูล
        $sql = "INSERT INTO user (username, surname, age, phone, email, password, password_cf) VALUES (:username, :surname, :age, :phone, :email, :password, :password_cf)";
        $stmt = $db_con -> prepare($sql);
        $stmt -> bindParam(":username", $username);
        $stmt -> bindParam(":surname", $surname);
        $stmt -> bindParam(":age", $age);
        $stmt -> bindParam(":phone", $phone);
        $stmt -> bindParam(":email", $email);
        $stmt -> bindParam(":password", $password);
        $stmt -> bindParam(":password_cf", $password_cf);

        $result = $stmt -> execute();

        // ตรวจสอบการเพิ่มข้อมูล
        if ($result) {
            $response['status'] = 'ok';
        } else {
            $response['status'] = 'error';
        }

    }

    // ปิดการเชื่อมต่อ
    echo json_encode($response);
?>
