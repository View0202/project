<?php

include("../../db_config.php");

$response = array();

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // ดึงข้อมูลและกรองข้อมูลที่รับมา
        $customer_id = filter_var($_POST['customer_id'], FILTER_SANITIZE_NUMBER_INT);
        $detail = filter_var($_POST['detail']);

        // ตรวจสอบว่ามีฟิลด์ที่ว่างหรือไม่
        if (empty($customer_id) || empty($detail)) {
            throw new Exception("ต้องระบุรหัสลูกค้าและรายละเอียด");
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

            // กำหนดเส้นทางสำหรับอัปโหลดไฟล์
            $uploadFileDir = '../../image_estimate/';
            $dest_path = $uploadFileDir . $fileName;

            // ย้ายไฟล์ที่อัปโหลดไปยังโฟลเดอร์ปลายทาง
            if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                throw new Exception("เกิดข้อผิดพลาดในการย้ายไฟล์ที่อัปโหลด");
            }

            // เส้นทางที่เก็บในฐานข้อมูล
            $db_file_path = '' . $fileName;

        } else {
            throw new Exception("ไฟล์ไม่ได้ถูกอัปโหลด");
        }

        // เตรียมและดำเนินการคำสั่ง SQL สำหรับเพิ่มข้อมูล
        $sql = "INSERT INTO estimate (customer_id, detail, file) VALUES (?, ?, ?)";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(1, $customer_id);
        $stmt->bindParam(2, $detail);
        $stmt->bindParam(3, $db_file_path);

        $result = $stmt->execute();

        if ($result) {
            $response['status'] = 'ok';
            header("Location: ../../profile/profile.php?id=pills-face");
            exit();
            $response['message'] = 'เพิ่มการประเมินเรียบร้อยแล้ว';
        } else {
            throw new Exception("การเพิ่มข้อมูลลงฐานข้อมูลล้มเหลว");
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
