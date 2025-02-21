<?php
include("../../db_config.php");

header('Content-Type: application/json');

$response = array();

$data = json_decode(file_get_contents('php://input'), true);
$estimate_id = $data['estimate_id'] ?? null;

if ($estimate_id) {
    try {
        $sql = "SELECT response FROM estimate WHERE estimate_id = :estimate_id";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':estimate_id', $estimate_id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $response['response'] = $result['response'];
        } else {
            $response['error'] = 'ไม่มีข้อมูล';
        }
    } catch (PDOException $e) {
        $response['error'] = 'ข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: ' . $e->getMessage();
    }
} else {
    $response['error'] = 'ไม่มีรหัสการประเมิน';
}

echo json_encode($response);
?>
