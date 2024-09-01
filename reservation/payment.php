<?php
session_start();
include("../db_config.php");  // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['u_id'])) {
    header("Location: ../login.php");
    exit;
}

// ดึง user_id และ customer_id จากเซสชัน
$u_id = $_SESSION['u_id'];

// เตรียมคำสั่ง SQL โดยใช้ INNER JOIN
$sql = "
    SELECT users.*, customer.*, estimate.*, queue.*, employees.fname, employees.lname 
    FROM users
    INNER JOIN customer ON users.username = customer.username
    LEFT JOIN estimate ON customer.customer_id = estimate.customer_id
    LEFT JOIN queue ON customer.customer_id = queue.customer_id
    LEFT JOIN employees ON queue.emp_id = queue.emp_id
    WHERE users.u_id = :u_id
";

// เตรียมคำสั่ง SQL
$stmt = $db_con->prepare($sql);
$stmt->bindParam(':u_id', $u_id, PDO::PARAM_INT);

// ดำเนินการคำสั่ง SQL
$stmt->execute();

// ดึงข้อมูลทั้งหมดจากผลลัพธ์
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// ตรวจสอบว่าพบข้อมูลหรือไม่
if ($data) {
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';

    // ตัวอย่างการเข้าถึงข้อมูล
    $user_id = $data['u_id']; // มีหลายฟิลด์อาจต้องระบุชัดเจน
    $username = $data['username']; // ตรวจสอบชื่อฟิลด์ในตาราง
    $customer_id = $data['customer_id'];
    $estimate_id = $data['estimate_id'];
    $queue_id = $data['queue_id'];
    $total = $data['total'];

    // แสดงข้อมูล
    echo "User ID: " . htmlspecialchars($user_id) . "<br>";
    echo "Username: " . htmlspecialchars($username) . "<br>";
    echo "Customer ID: " . htmlspecialchars($customer_id) . "<br>";
    echo "Estimate ID: " . htmlspecialchars($estimate_id) . "<br>";
    echo "Queue ID: " . htmlspecialchars($queue_id) . "<br>";

    // การใช้งานข้อมูลต่อไป...
} else {
    // กรณีไม่พบข้อมูล
    echo "ไม่พบข้อมูลที่ตรงตามเงื่อนไข";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mira Comprehensive Beauty Center</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="../layouts/index.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="../index.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Prompt', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Prompt', sans-serif;
        }
        p, .card-title, .card-text, .widget-item-shortdesc {
            font-family: 'Prompt', sans-serif;
        }
        .payment strong {
            font-size: 30px;
        }
        .col-auto {
            margin: 0 50px; /* เพิ่มระยะห่างซ้ายและขวาให้รวมกันเป็น 50px */
        }
        .img_money {
            border: 1px solid black; /* เพิ่มขอบสีดำขนาด 1px */
            border-radius: 5px; /* เพิ่มความโค้งมนให้ขอบ */
        }
        .img_gateway {
            width: 500px; /* กำหนดความกว้างของภาพ */
            height: auto; /* ปรับความสูงอัตโนมัติตามอัตราส่วนของภาพ */
            max-width: 100%; /* ป้องกันการขยายขนาดเกินกว่าอัตราส่วนของคอลัมน์ */
            cursor: pointer; /* เปลี่ยนเคอร์เซอร์เป็น pointer เมื่อชี้ */
        }
        .info {
            font-size: 18px;
            color: #000;
            margin-top: 20px;
        }
        .btn-container {
            margin: 20px;
            display: none; /* ซ่อนปุ่มเริ่มต้น */
        }
        .center-content {
            display: flex;
            justify-content: center; /* จัดตำแหน่งกลางในแนวนอน */
            align-items: center; /* จัดตำแหน่งกลางในแนวตั้ง */
            height: 100%; /* ใช้ความสูงเต็มที่ของบรรทัดที่บรรจุ */
        }
        
    </style>

    <script>
        var countdownTimer; // ประกาศตัวแปรสำหรับ setInterval
        var time; // ประกาศตัวแปรสำหรับเวลา

        function selectGateway(id) {
            let info;
            let imageSrc;
            switch(id) {
                case 1:
                    info = 'ข้อมูลสำหรับการชำระเงิน "เลขบัญชี"';
                    imageSrc = '../images/payment_bank.png'; // เปลี่ยนเป็นเส้นทางไปยังภาพสำหรับ gateway 1
                    break;
                case 2:
                    info = 'ข้อมูลสำหรับการชำระเงิน "พร้อมเพย์"';
                    imageSrc = '../images/payment_promptpay.png'; // เปลี่ยนเป็นเส้นทางไปยังภาพสำหรับ gateway 2
                    break;
                default:
                    info = 'ข้อมูลไม่ถูกต้อง';
                    imageSrc = ''; // ไม่มีภาพสำหรับการเลือกที่ไม่ถูกต้อง
            }

            // ตั้งเวลา 15 นาที (900 วินาที)
            time = 15 * 60;

            // แสดงข้อมูลการชำระเงินและส่วนต่างๆ
            document.getElementById('paymentInfo').innerText = info;
            document.getElementById('paymentSeparator').style.display = 'block';
            document.getElementById('countdown').style.display = 'block';
            document.getElementById('infoBox').style.display = 'block'; // แสดง infoBox
            document.getElementById('buttonContainer').style.display = 'block';

            // อัปเดต infoBox ด้วยภาพ
            document.getElementById('infoBox').innerHTML = '<img src="' + imageSrc + '" style="width:100%; max-width:400px; height:auto;">';

            // เคลียร์ตัวจับเวลาถ้ามีอยู่แล้ว
            clearInterval(countdownTimer);

            // เริ่มการนับถอยหลังใหม่
            countdownTimer = setInterval(updateCountdown, 1000);
        }

        // ฟังก์ชันการอัปเดตตัวนับถอยหลัง
        function updateCountdown() {
            var minutes = Math.floor(time / 60);
            var seconds = time % 60;

            // การจัดรูปแบบให้มีสองหลักเสมอ
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            // แสดงเวลาที่เหลือ
            document.getElementById('countdown').innerText = minutes + ":" + seconds;

            // เมื่อหมดเวลา ให้ย้อนกลับไปยังหน้าก่อนหน้า
            if (time <= 0) {
                clearInterval(countdownTimer); // เคลียร์ตัวจับเวลาหลังหมดเวลา
                window.history.back();
            } else {
                time--;
            }
        }
    </script>
    
</head>
<body>

<!-- ส่วนหัวตาราง -->
<div class="container1">
    <div class="container2">
        <header id="header">
            <div class="logo">
                <div class="widget-header-logo widget-header-logo-0">
                    <a class="widget-item-logolink">
                        <img class="widget-item-logoimg" src="../images/logo.png" alt=" ">
                    </a>
                </div>
            </div>
            
            <nav class="navbar navbar-light">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../profile/profile.php">ข้อมูลส่วนตัว <?php echo " " . htmlspecialchars($username)?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="logoutuser()">ออกจากระบบ</a>
                    </li>
                </ul>
            </nav>
        </header>
    </div>

    <div class="container2">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="../home.php">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/aboutuser.php">เกี่ยวกับเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/reservationuser.php">ตารางพนักงาน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/productuser.php">สินค้าและบริการ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/promotionuser.php">โปรโมชั่น</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/resultuser.php">ผลลัพธ์ลูกค้า</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/contactuser.php">ติดต่อเรา</a>
            </li>
        </ul>
    </div>

    <div class="payment">
        <div class="row justify-content-center">
            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; margin-top: 20px;">
                <strong>ช่องทางการชำระเงิน</strong>
                <div class="row justify-content-center align-items-center">
                    <fieldset class="wrap_content">
                        <fieldset class="body_content">
                            
                            <div style="display: flex; justify-content: center;">
                                <div style="font-size: 25px; margin: 20px; font-weight: bold; border: 1px solid black; width: 300px;" class="coin"> 
                                    ราคา: <?php echo " " . htmlspecialchars($total) ?> บาท 
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-auto">
                                    <img id="gateway1" class="img_gateway" src="../images/bank.png" alt="Gateway 1" onclick="selectGateway(1)">
                                </div>
                                <div class="col-auto">
                                    <img id="gateway2" class="img_gateway" src="../images/payment-QR.png" alt="Gateway 2" onclick="selectGateway(2)">
                                </div>
                                
                                <div style="font-size: 20px;"> 
                                    >>คลิกเลือกช่องทางการชำระ<<
                                </div>
                                    
                            </div>

                            <hr id="paymentSeparator" style="display: none;" />


                            <div id="paymentInfo" class="info"></div>
                            <div id="countdown" class="info" style="display: none;">00:00</div>
                            <div id="infoBox" class="info-box"></div>

                            <div id="buttonContainer" class="btn-container">
                                <a href="uploadpayment.php" class="btn btn-success" role="button">อัพโหลดหลักฐาน</a>
                                <a href="reservation_form.php" class="btn btn-warning" role="button">ย้อนกลับ</a>
                            </div>
                        </fieldset>
                    </fieldset>
                </div>
            </span>
        </div>
    </div>
    
    <hr>

    <div class="container2">
        <footer id="footer">
            <nav class="navbar navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="login.php">
                        Copyright 2024 @ Mira One Stop Services Beauty Center
                    </a>
                </div>
            </nav>
        </footer>
    </div>
</div>
</body>
</html>