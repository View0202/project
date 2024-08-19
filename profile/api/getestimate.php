<?php
include("../db_config.php");

$response = array(); // ใช้ array แทน string เพื่อการจัดการข้อมูลที่ดีกว่า

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $estimate_id = isset($_GET['estimate_id']) ? intval($_GET['estimate_id']) : 0; // รับพารามิเตอร์ id และแปลงเป็นจำนวนเต็ม

    try {
        // เตรียมคำสั่ง SQL
        $sql = "SELECT * FROM estimate WHERE estimate_id = ?";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(1, $estimate_id, PDO::PARAM_INT);
        $stmt->execute();

        // ดึงข้อมูล
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // ใช้ fetchAll แทน fetch เพื่อรับข้อมูลหลายแถว

        // เตรียมข้อมูลตอบกลับ
        if ($data) {
            $response['data'] = $data; // ส่งข้อมูลทั้งหมดที่ดึงมา
        } else {
            $response['data'] = []; // ส่ง array ว่างแทนที่จะเป็นข้อความ
        }
    } catch (PDOException $e) {
        $response['error'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
    }
}

// ส่งข้อมูลกลับเป็น JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
