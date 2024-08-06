<?php
include("../db_config.php");

// คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง estimate
$sql = "SELECT user_id, detail, file FROM estimate";
$stmt = $db_con->prepare($sql);

// ตรวจสอบว่ามีผลลัพธ์หรือไม่
if ($result->num_rows > 0) {
    // แสดงผลข้อมูลของแต่ละแถว
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['detail'] . "</td>";
        echo "<td><img src='" . $row['file'] . "' alt='Image' style='width:100px;height:100px;'></td>";
        echo "<td><a href='edit.php?id=" . $row['user_id'] . "' class='btn btn-warning'>แก้ไข</a>
              <a href='delete.php?id=" . $row['user_id'] . "' class='btn btn-danger'>ลบ</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>ไม่พบข้อมูล</td></tr>";
}

$conn->close();
?>
