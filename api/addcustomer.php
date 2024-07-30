<?php
    include("../db_config.php");

    $response = array();

    // รับข้อมูลจากฟอร์ม
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $age = $_POST['age'];
        $password = $_POST['password'];

        // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูล
        $sql = "INSERT INTO customer (name, surname, email, phone, age, password) VALUES (:name, :surname, :email, :phone, :age, :password)";
        $stmt = $db_con -> prepare($sql);
        $stmt -> bindParam(":name", $name);
        $stmt -> bindParam(":surname", $surname);
        $stmt -> bindParam(":email", $email);
        $stmt -> bindParam(":phone", $phone);
        $stmt -> bindParam(":age", $age);
        $stmt -> bindParam(":password", $password);

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
