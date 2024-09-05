<?php
include("../db_config.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['u_id'])) {
    echo '<tr><td colspan="4" align="center">กรุณาล็อกอินเพื่อดูข้อมูล</td></tr>';
    exit;
}

$sql = "SELECT estimate_id, detail, file FROM estimate WHERE customer_id = :customer_id";
$stmt = $db_con->prepare($sql);
$stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
$stmt->execute();

$estimates = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($estimates as $index => $estimate) {
    echo '<tr>';
    echo '<td>' . ($index + 1) . '</td>';
    echo '<td>' . htmlspecialchars($estimate['detail']) . '</td>';
    echo '<td><img src="../image_estimate/' . htmlspecialchars($estimate['file']) . '" width="100" height="100" /></td>';
    echo '<td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#estimateModal" data-estimate_id="' . htmlspecialchars($estimate['estimate_id']) . '">การตอบกลับ</button>
            <button type="button" class="btn btn-danger" onclick="deleteEstimate(' . htmlspecialchars($estimate['estimate_id']) . ')">ลบข้อมูล</button>
          </td>';
    echo '</tr>';
}
?>
