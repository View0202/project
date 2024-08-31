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
$sql = "SELECT users.*, customer.* FROM users
    INNER JOIN customer ON users.username = customer.username
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

    // ตัวอย่างการเข้าถึงข้อมูล
    $user_id = $data['u_id']; // มีหลายฟิลด์อาจต้องระบุชัดเจน
    $username = $data['username']; // ตรวจสอบชื่อฟิลด์ในตาราง
    $customer_id = $data['customer_id'];

    // แสดงข้อมูล
    echo "User ID: " . htmlspecialchars($user_id) . "<br>";
    echo "Username: " . htmlspecialchars($username) . "<br>";
    echo "Customer ID: " . htmlspecialchars($customer_id) . "<br>";

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
    <title>Mira comprehensive beauty center</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../layouts/index.css">

    <!-- Google Fonts - Prompt -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script type="text/javascript" src="../index.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Inline Styles for Font Family -->
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
    </style>
</head>
<body>

<div class="container1">
    <div class="container2">
        <header id="header">
            <div class="logo">
                <div class="widget-header-logo widget-header-logo-0">
                    <a class="widget-item-logolink">
                        <img class="widget-item-logoimg" src="../images/logo.png" alt="Logo">
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
                <a class="nav-link" href="aboutuser.php">เกี่ยวกับเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reservationuser.php">ตารางพนักงาน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="productuser.php">สินค้าและบริการ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="promotionuser.php">โปรโมชั่น</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">ผลลัพธ์ลูกค้า</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contactuser.php">ติดต่อเรา</a>
            </li>
        </ul>
    </div>

    <div class="result">
    <div class="row justify-content-center">
        <div class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; margin-top: 20px;">
            <strong>ผลลัพธ์ลูกค้า</strong>
            <!-- <div class="container">
                <div class="row align-items-center" style="margin: 20px;">
                        <?php foreach ($uniqueResults as $result): ?>
                            <div class="col-md-4 col-12 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"><?php echo htmlspecialchars($result['name']); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><?php echo htmlspecialchars($result['comment']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                </div>
            </div> -->
        </div>
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
