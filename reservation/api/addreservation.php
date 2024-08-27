<?php
session_start(); // เริ่มต้นเซสชัน

include("../../db_config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $customer_id = $_POST['customer_id'];
    $queue_date = $_POST['date'];
    $queue_time = $_POST['time'];
    // $name = $_POST['name'];
    // $phone = $_POST['phone'];
    $service_type_id = $_POST['service_type'];
    $service_id = $_POST['service'];
    $price = $_POST['service_price']; // แก้ไขการใช้ number_format
    $emp_id = $_POST['employees'];

    try {
        // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลในตาราง queue
        $sql = "INSERT INTO queue (customer_id, queue_date, queue_time, service_type_id, service_id, price, emp_id) VALUES (:customer_id, :date, :time, :service_type, :service, :service_price, :employees)";
        $stmt = $db_con->prepare($sql);

        // Bind ค่าพารามิเตอร์เข้ากับ statement
        $stmt->bindParam(":customer_id", $customer_id);
        $stmt->bindParam(":date", $queue_date);
        $stmt->bindParam(":time", $queue_time);
        // $stmt->bindParam(":name", $name);
        // $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":service_type", $service_type_id);
        $stmt->bindParam(":service", $service_id);
        $stmt->bindParam(":service_price", $price);
        $stmt->bindParam(":employees", $emp_id);

        // Execute statement
        $result = $stmt->execute();

        // ตรวจสอบการเพิ่มข้อมูล
        if ($result) {
            $response['status'] = 'ok';
            header("Location: ../payment.php");
            exit();
        } else {
            $response['status'] = 'error';
        }
    } catch (PDOException $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

// ปิดการเชื่อมต่อ
echo json_encode($response);
?>


