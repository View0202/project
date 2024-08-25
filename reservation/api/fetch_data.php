<?php
include("../../db_config.php");

// ดึงข้อมูลบริการ
$stmt_services = $pdo->prepare("SELECT service_type_id, service_type_name FROM service_type");
$stmt_services->execute();
$services = $stmt_services->fetchAll(PDO::FETCH_ASSOC);

// ดึงข้อมูลพนักงาน
$stmt_employees = $pdo->prepare("SELECT emp_id, fname FROM employees");
$stmt_employees->execute();
$employees = $stmt_employees->fetchAll(PDO::FETCH_ASSOC);

// ส่งข้อมูลเป็น JSON
$response = [
    'services' => $services,
    'employees' => $employees
];
header('Content-Type: application/json');
echo json_encode($response);
?>
