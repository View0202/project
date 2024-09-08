<?php

include("../../db_config.php");

$response = array();

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // ดึงข้อมูลและกรองข้อมูลที่รับมา
        $queue_id = filter_var($_POST['queue_id'], FILTER_SANITIZE_NUMBER_INT);

        // ตรวจสอบว่ามีไฟล์อัปโหลดเข้ามาหรือไม่
        if (isset($_FILES['formFile']) && $_FILES['formFile']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['formFile']['tmp_name'];
            $fileName = $_FILES['formFile']['name'];
            $fileSize = $_FILES['formFile']['size'];
            $fileType = $_FILES['formFile']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // ตรวจสอบนามสกุลไฟล์
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // กำหนดชื่อไฟล์ใหม่เพื่อไม่ให้ซ้ำ
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                // กำหนดเส้นทางไฟล์ที่ต้องการจัดเก็บ
                $uploadFileDir = '../../images_payment/';
                $dest_path = $uploadFileDir . $newFileName;

                // ย้ายไฟล์ไปยังปลายทางที่กำหนด
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $db_file_path = 'images_payment/' . $newFileName;

                    // อัปเดตฐานข้อมูลด้วยเส้นทางของไฟล์
                    $sql = "UPDATE queue SET slip = :slip WHERE queue_id = :queue_id";
                    $stmt = $db_con->prepare($sql);
                    $stmt->bindParam(':slip', $db_file_path, PDO::PARAM_STR);
                    $stmt->bindParam(':queue_id', $queue_id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        $response['status'] = 'success';
                        $response['message'] = 'การอัปโหลดหลักฐานสำเร็จ';
                    } else {
                        throw new Exception("เกิดข้อผิดพลาดในการอัปเดตฐานข้อมูล");
                    }
                } else {
                    throw new Exception("เกิดข้อผิดพลาดในการย้ายไฟล์ที่อัปโหลด");
                }
            } else {
                throw new Exception("นามสกุลไฟล์ไม่ถูกต้อง");
            }
        } else {
            throw new Exception("ไม่มีไฟล์อัปโหลดหรือเกิดข้อผิดพลาดในการอัปโหลดไฟล์");
        }
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
