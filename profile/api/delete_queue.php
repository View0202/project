<?php
// เชื่อมต่อฐานข้อมูล
include("../../db_config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่า queue_id จากคำขอ POST
    $queue_id = $_POST['queue_id'];

    // ตรวจสอบว่ามีค่า queue_id หรือไม่
    if (!empty($queue_id)) {
        // คำสั่ง SQL เพื่อทำการลบ
        $sql = "DELETE FROM queue WHERE queue_id = :queue_id";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':queue_id', $queue_id, PDO::PARAM_INT);

        // ตรวจสอบว่าการลบสำเร็จหรือไม่
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'ไม่สามารถลบได้']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ไม่พบค่า queue_id']);
    }
}
?>

