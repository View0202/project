<?php

include("../../db_config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // รับค่าจากฟอร์ม
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    $password_cf = $_POST['password_cf'];
    $customer_id = $_POST['customer_id'];
    $user_id = $_POST['u_id']; // รับค่า user_id จากฟอร์มหรือที่เกี่ยวข้อง

		$sql = "UPDATE customer SET username=?, firstname=?, lastname=?, email=?, phone=?, age=?, password=? WHERE customer_id=?";
		$stmt = $db_con -> prepare($sql);
        $stmt -> bindParam(1, $username);
		$stmt -> bindParam(2, $firstname);
		$stmt -> bindParam(3, $lastname);
		$stmt -> bindParam(4, $email);
        $stmt -> bindParam(5, $phone);
        $stmt -> bindParam(6, $age);
		$stmt -> bindParam(7, $password);
		$stmt -> bindParam(8, $customer_id);

    $result = $stmt->execute();

    // อัปเดตข้อมูลในตาราง users
    $sql_users = "UPDATE users SET username=?, firstname=?, lastname=?, password=? WHERE u_id=?";
    $stmt_users = $db_con->prepare($sql_users);
    $stmt_users->bindParam(1, $username);
    $stmt_users->bindParam(2, $firstname);
	$stmt_users->bindParam(3, $lastname);
    $stmt_users->bindParam(4, $password);
    $stmt_users->bindParam(5, $u_id);

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
