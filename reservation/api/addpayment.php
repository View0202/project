<?php

include("../../db_config.php");

$response = array();

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // ดึงข้อมูลและกรองข้อมูลที่รับมา
        $queue_id = filter_var($_POST['queue_id'], FILTER_SANITIZE_NUMBER_INT);

        // ตรวจสอบว่ามีฟิลด์ที่ว่างหรือไม่
        if (empty($queue_id)) {
            throw new Exception("ต้องระบุรหัสการจองคิว");
        }

        // การจัดการอัปโหลดไฟล์
        if (isset($_FILES['formFile']) && $_FILES['formFile']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['formFile']['tmp_name'];
            $fileName = $_FILES['formFile']['name'];
            $fileSize = $_FILES['formFile']['size'];
            $fileType = $_FILES['formFile']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // กำหนดชนิดไฟล์ที่อนุญาต
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
            if (!in_array($fileExtension, $allowedfileExtensions)) {
                throw new Exception("อนุญาตเฉพาะไฟล์ JPG, JPEG, PNG, และ GIF เท่านั้น");
            }

            // กำหนดชื่อไฟล์ใหม่เพื่อหลีกเลี่ยงการทับซ้อน
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            // กำหนดเส้นทางสำหรับอัปโหลดไฟล์
            $uploadFileDir = '../../image_payment/';
            $dest_path = $uploadFileDir . $newFileName;

            // ย้ายไฟล์ที่อัปโหลดไปยังโฟลเดอร์ปลายทาง
            if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                throw new Exception("เกิดข้อผิดพลาดในการย้ายไฟล์ที่อัปโหลด");
            }

            // เส้นทางที่เก็บในฐานข้อมูล
            $db_file_path = $newFileName;

        } else {
            throw new Exception("ไฟล์ไม่ได้ถูกอัปโหลด");
        }

        // อัปเดตฐานข้อมูลด้วยเส้นทางของไฟล์
        $sql = "UPDATE queue SET slip = :slip WHERE queue_id = :queue_id";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':slip', $db_file_path, PDO::PARAM_STR);
        $stmt->bindParam(':queue_id', $queue_id, PDO::PARAM_INT);

        $result = $stmt->execute();

        if ($result) {
            $response['status'] = 'ok';
            $response['message'] = 'การอัปโหลดหลักฐานสำเร็จ';
            header("Location: ../../home.php");
            exit();
        } else {
            throw new Exception("เกิดข้อผิดพลาดในการอัปเดตฐานข้อมูล");
        }
    } else {
        $response['status'] = 'no-request';
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

// แสดงผลลัพธ์ในรูปแบบ JSON
echo json_encode($response);

?>
