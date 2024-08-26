<?php
session_start(); // เริ่มต้นเซสชัน

include("../../db_config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $customer_id = $_POST['customer_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $service_type = $_POST['service_type'];
    $service = $_POST['service'];
    $service_price = $_POST['service_price'];
    $employees = $_POST['employees'];

    try {
        // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลในตาราง reservation
        $sql = "INSERT INTO reservation (customer_id, date, time, name, phone, service_type, service, service_price, employees) VALUES (:customer_id, :date, :time, :name, :phone, :service_type, :service, :service_price, :employees)";
        $stmt = $db_con->prepare($sql);

        // Bind ค่าพารามิเตอร์เข้ากับ statement
        $stmt->bindParam(":customer_id", $customer_id);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":time", $time);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":service_type", $service_type);
        $stmt->bindParam(":service", $service);
        $stmt->bindParam(":service_price", $service_price);
        $stmt->bindParam(":employees", $employees);

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
