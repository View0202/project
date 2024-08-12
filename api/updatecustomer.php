<?php

include("../db_config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $age = $_POST['age'];
        $customer_id = $_POST['customer_id'];

		$sql = "UPDATE customer SET name=?, surname=?, email=?, phone=?, age=? WHERE customer_id=?";
		$stmt = $db_con -> prepare($sql);
		$stmt -> bindParam(1, $name);
		$stmt -> bindParam(2, $surname);
		$stmt -> bindParam(3, $email);
        $stmt -> bindParam(4, $phone);
        $stmt -> bindParam(5, $age);
		$stmt -> bindParam(6, $customer_id);

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
