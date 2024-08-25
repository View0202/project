<?php

include("../../db_config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // รับค่าจากฟอร์ม
    if (isset($_POST['comment'], $_POST['customer_id'], $_POST['u_id'])) {
        $comment = $_POST['comment'];
        $customer_id = $_POST['customer_id'];
        $user_id = $_POST['u_id'];

        // อัปเดตคอมเมนต์ของลูกค้าในฐานข้อมูล
        $sql = "UPDATE customer SET comment=? WHERE customer_id=?";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(1, $comment);
        $stmt->bindParam(2, $customer_id);

        $result = $stmt->execute();

        // ตรวจสอบการอัปเดตข้อมูล
        if ($result) {
            $response['status'] = 'ok';
            header("Location: ../profile.php");
            exit();
        } else {
            $response['status'] = 'error';
        }
    } else {
        $response['status'] = 'missing-data';
    }
} else {
    $response['status'] = 'no-request';
}

echo json_encode($response);

?>
