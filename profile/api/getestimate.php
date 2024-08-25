<?php
include("../../db_config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    echo "Customer ID: " . htmlspecialchars($customer_id); // ตรวจสอบค่า customer_id

    // เตรียมคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง estimate ตาม customer_id ที่ส่งมา
    $sql = "SELECT response FROM estimate WHERE customer_id = :customer_id";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($data)) {
            $response['data'] = $data;
        } else {
            $response['data'] = array();
        }
    } else {
        $errorInfo = $stmt->errorInfo(); // เพิ่ม error handling
        $response['error'] = "เกิดข้อผิดพลาดในการดึงข้อมูล: " . $errorInfo[2];
    }
} else {
    $response['error'] = "ไม่มี customer_id หรือไม่ได้ใช้วิธี GET";
}

echo json_encode($response);
?>
