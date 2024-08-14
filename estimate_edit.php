<?php
include("../db_config.php");

// ดึงข้อมูลของ estimate ที่ต้องการแก้ไข
$sql = "SELECT * FROM estimate WHERE estimate_id = $estimate_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $estimate = $result->fetch_assoc();
} else {
    echo "ไม่พบข้อมูล";
    exit;
}

$conn->close();
?>

<!-- แสดงข้อมูลให้ผู้ใช้แก้ไข -->
<form action="update_estimate.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="estimate_id" value="<?php echo $estimate['estimate_id']; ?>">
    <div class="mb-3">
        <label for="detail" class="form-label">รายละเอียด</label>
        <textarea class="form-control" id="detail" name="detail" rows="3"><?php echo $estimate['detail']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">อัปโหลดรูปภาพใหม่ (ถ้าต้องการ)</label>
        <input class="form-control" type="file" id="file" name="file">
    </div>
    <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
</form>
