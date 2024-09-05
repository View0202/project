<?php
// เชื่อมต่อฐานข้อมูล
include("../../db_config.php");  // เชื่อมต่อฐานข้อมูล

try {
    // ดึงข้อมูลจากตาราง queue พร้อมกับ service_name และ fname จากตาราง service และ employees
    $stmt = $db_con->prepare("SELECT q.queue_date, q.queue_time, s.service_name, e.fname
        FROM queue q
        JOIN service s ON q.service_id = s.service_id  -- เชื่อมกับตาราง service
        JOIN employees e ON q.emp_id = e.emp_id        -- เชื่อมกับตาราง employees
        WHERE q.queue_date IS NOT NULL
    ");
    
    $stmt->execute();
    $queues = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($queues) {
        echo json_encode($queues);  // ส่งข้อมูลกลับในรูปแบบ JSON
    } else {
        echo json_encode(['error' => 'No data found']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
