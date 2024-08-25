<?php
include("../db_config.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['u_id'])) {
    echo '<tr><td colspan="4" align="center">กรุณาล็อกอินเพื่อดูข้อมูล</td></tr>';
    exit;
}

$u_id = $_SESSION['u_id'];

// echo 'Customer ID: ' . htmlspecialchars($u_id); // ตรวจสอบค่า customer_id

$sql = "SELECT estimate_id, detail, file FROM estimate WHERE customer_id = :customer_id";
$stmt = $db_con->prepare($sql);
$stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

try {
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $index = 1;
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $index++ . '</td>';
            echo '<td>' . htmlspecialchars($data['detail']) . '</td>';
            echo '<td><img src="../image_estimate/' . htmlspecialchars($data['file']) . '" alt="Image" style="max-width: 150px;"></td>';
            echo '<td>';
            echo '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#estimateModal">การตอบกลับ</button>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="4" align="center">ไม่พบข้อมูล</td></tr>';
    }
} catch (PDOException $e) {
    echo '<tr><td colspan="4" align="center">Error: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
}
?>
