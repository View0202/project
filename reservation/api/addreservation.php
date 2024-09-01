<?php
session_start(); // เริ่มต้นเซสชัน

include("../../db_config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $customer_id = $_POST['customer_id'];
    // $queue_date = $_POST['date'];
    // $queue_time = $_POST['start_time'];
    // $service_type_id = $_POST['service_type'];
    // $service_id = $_POST['service'];
    // $price = $_POST['service_price'];
    // $total = $_POST['deposit_price'];
    // $emp_id = $_POST['employees'];

    // ดึงข้อมูลจากฟอร์ม
    $customer_id = $_POST['customer_id'];
    $service_type_id = $_POST['service_type'];
    $service_id = $_POST['service'];
    $emp_id = $_POST['employees'];
    $queue_date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $price = $_POST['price'];
    $total = $_POST['deposit_price'];

    // คำนวณ queue_time โดยใช้เวลาเริ่มต้นและเวลาสิ้นสุด
    $queue_time = $start_time . '-' . $end_time;

    try {
        // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลในตาราง queue
        $sql = "INSERT INTO queue (customer_id, queue_date, queue_time, service_type_id, service_id, price, total, emp_id) VALUES (:customer_id, :date, :time, :service_type, :service, :service_price, :deposit_price, :employees)";
        $stmt = $db_con->prepare($sql);

        // Bind ค่าพารามิเตอร์เข้ากับ statement
        $stmt->bindParam(":customer_id", $customer_id);
        $stmt->bindParam(":date", $queue_date);
        $stmt->bindParam(":time", $queue_time);
        $stmt->bindParam(":service_type", $service_type_id);
        $stmt->bindParam(":service", $service_id);
        $stmt->bindParam(":service_price", $price);
        $stmt->bindParam(":deposit_price", $total);
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


