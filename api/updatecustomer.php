<?php

include("../db_config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // รับค่าจากฟอร์ม
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    $password_cf = $_POST['password_cf'];
    $customer_id = $_POST['customer_id'];
    $user_id = $_POST['user_id']; // รับค่า user_id จากฟอร์มหรือที่เกี่ยวข้อง

    // อัปเดตข้อมูลในตาราง customer
    $sql = "UPDATE customer SET name=?, surname=?, email=?, phone=?, age=?, password=? WHERE customer_id=?";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $surname);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $phone);
    $stmt->bindParam(5, $age);
    $stmt->bindParam(6, $password);
    $stmt->bindParam(7, $customer_id);

    $result = $stmt->execute();

    // อัปเดตข้อมูลในตาราง users
    $sql_users = "UPDATE users SET email=?, password=? WHERE user_id=?";
    $stmt_users = $db_con->prepare($sql_users);
    $stmt_users->bindParam(1, $email);
    $stmt_users->bindParam(2, $password);
    $stmt_users->bindParam(3, $user_id);

    $result_users = $stmt_users->execute();

    // ตรวจสอบการอัปเดตข้อมูล
    if ($result && $result_users) {
        $response['status'] = 'ok';
        header("Location: ../profile.php");
        exit();
    } else {
        $response['status'] = 'error';
    }
} else {
    $response['status'] = 'no-request';
}

echo json_encode($response);

?>
