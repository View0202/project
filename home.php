<?php

    session_start();
    include("db_config.php");

    // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); // เปลี่ยนเส้นทางกลับไปหน้า login หากผู้ใช้ยังไม่ได้เข้าสู่ระบบ
        exit;
    }

    // สร้าง SQL query ด้วย INNER JOIN ระหว่างตาราง users และ customer
    $sql = "SELECT u.*, c.* FROM users u
            INNER JOIN customer c ON c.customer_id = c.customer_id
            WHERE u.user_id = ?";

    // เตรียมคำสั่ง SQL และผูกค่า parameter
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(1, $_SESSION['user_id']);
    $stmt->execute();

    // ดึงข้อมูลผลลัพธ์
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบว่ามีข้อมูลหรือไม่ก่อนใช้งาน
    if ($row) {
        // ตัวอย่างการเข้าถึงข้อมูล
        $user_id = $row['user_id'];

        $customer_id = $row['customer_id'];
        $name = $row['name'];

        // การใช้งานข้อมูลต่อไป...
    } else {
        // กรณีไม่พบข้อมูล
        echo "ไม่พบผู้ใช้ที่ตรงตามเงื่อนไข";
    }

?>

<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mira comprehensive beauty center</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="layouts/index.css">

    <!-- Google Fonts - Prompt -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- jquery -->
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script type="text/javascript" src="index.js"></script>

    <!-- sweet -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

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

<!-- ส่วนหัวตาราง -->
<div class="container1">
    <div class="container2">
        <header id="header">
            <div class="logo">
                <div class="widget-header-logo widget-header-logo-0">
                    <a class="widget-item-logolink">
                        <img class="widget-item-logoimg" src="images/logo.png" alt=" ">
                    </a>
                </div>
            </div>
            
            <nav class="navbar navbar-light">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="profile/profile.php">ข้อมูลส่วนตัว</a>
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
                <a class="nav-link" href="#">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user/aboutuser.php">เกี่ยวกับเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user/reservationuser.php">ตารางพนักงาน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user/productuser.php">สินค้าและบริการ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user/promotionuser.php">โปรโมชั่น</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user/resultuser.php">ผลลัพธ์ลูกค้า</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user/contactuser.php">ติดต่อเรา</a>
            </li>
            </ul>
    </div>

    <div class="calendar">
        <strong>ตารางพนักงาน</strong>
        <div class="container">
            <div class="row align-items-center">
                <iframe src="https://calendar.google.com/calendar/embed?src=rungpairin.nut%40gmail.com&ctz=Asia%2FBangkok" style="border: 0" width="800" height="500" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>
    </div>

    <hr>

    <div class="product">
        <strong>สินค้าและบริการ</strong>
        <div class="container">
        <p class="text-start fs-3">สินค้า</p>
            <div class="row justify-content-center g-3 align-items-center">
                <div class="col">
                    <div class="card" style="width: 20rem;">
                        <img src="images/product_test.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="images/product_test.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="images/product_test.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-start fs-3" style="margin-top: 50px;">บริการสักคิ้ว</p>
            <div class="row align-items-center">
                <div class="col">
                    <div class="card" style="width: 20rem;">
                        <img src="images/service_test1.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="images/service_test1.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="images/service_test1.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-start fs-3" style="margin-top: 50px;">บริการทำเล็บ</p>
            <div class="row align-items-center">
                <div class="col">
                    <div class="card" style="width: 20rem;">
                        <img src="images/service_test2.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="images/service_test2.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="images/service_test2.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>
            </div>

            <a class="btn btn-primary" href="reservation_form.php" role="button" style="margin-top: 30px;">จองคิว</a>

        </div>
    </div>

    <hr>

    <div class="promotion">
        <div class="row justify-content-center">
            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; margin-top: 20px;">
            <strong>โปรโมชั่น</strong>
            <div class="container">
                <div class="row justify-content-center g-3 align-items-center">
                    <div class="col">
                        <div class="card" style="width: 30rem;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-start">
                                        <h5 class="card-title">โปรโมชั่น : ..............</h5>
                                        <p class="card-text">เงื่อนไข : .............</p>
                                        <p class="card-detail">สิ้นสุดกิจกรรม : .............</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="width: 30rem;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-start">
                                        <h5 class="card-title">โปรโมชั่น : ..............</h5>
                                        <p class="card-text">เงื่อนไข : .............</p>
                                        <p class="card-detail">สิ้นสุดกิจกรรม : .............</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>

            <div class="container">
                <div class="row justify-content-center g-3 align-items-center">
                    <div class="col">
                        <div class="card" style="width: 30rem;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-start">
                                        <h5 class="card-title">โปรโมชั่น : ..............</h5>
                                        <p class="card-text">เงื่อนไข : .............</p>
                                        <p class="card-detail">สิ้นสุดกิจกรรม : .............</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="width: 30rem;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-start">
                                        <h5 class="card-title">โปรโมชั่น : ..............</h5>
                                        <p class="card-text">เงื่อนไข : .............</p>
                                        <p class="card-detail">สิ้นสุดกิจกรรม : .............</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>

            <div class="container">
                <div class="row justify-content-center g-3 align-items-center">
                    <div class="col">
                        <div class="card" style="width: 30rem; margin: 20px">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-start">
                                        <h5 class="card-title">โปรโมชั่น : ..............</h5>
                                        <p class="card-text">เงื่อนไข : .............</p>
                                        <p class="card-detail">สิ้นสุดกิจกรรม : .............</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="width: 30rem;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-start">
                                        <h5 class="card-title">โปรโมชั่น : ..............</h5>
                                        <p class="card-text">เงื่อนไข : .............</p>
                                        <p class="card-detail">สิ้นสุดกิจกรรม : .............</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>
            </span>
        </div>
    </div>

    <hr>

    <div class="contact">
        <strong>ติดต่อเรา</strong>
        <div class="widget-item-shortdesc">เปิดให้บริการ ทุกวัน เวลา 11.00 - 18.00 น.</div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <div class="alert alert-secondary" role="alert">
                        <img src="icons/facebook.png" alt="Facebook Icon" style="width:30px; height:30px; margin-right:5px;">
                            Facebook : .....................
                    </div>
                </div>
                <div class="col">
                    <div class="alert alert-secondary" role="alert">
                        <img src="icons/line.png" alt="Line Icon" style="width:30px; height:30px; margin-right:5px;">
                        Line : ....................
                    </div>
                </div>
                <div class="col">
                    <div class="alert alert-secondary" role="alert">
                        <img src="icons/phone.png" alt="Phone Icon" style="width:30px; height:30px; margin-right:5px;">
                        Phone : 090-3166790
                    </div>
                </div>
            </div>
        </div>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d236.7043517668177!2d98.81794018833246!3d18.33497964530612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30dbb903de457b15%3A0xade4cc5e472c4fdf!2sSS%20Com%20Service!5e0!3m2!1sth!2sth!4v1720606431292!5m2!1sth!2sth" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
    </div>

    <div class="fixed-bottom">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="margin: 20px;">
            <button type="button" class="btn btn-outline-success" onclick="location.href='estimate/estimate.php'">
                <i class="bi bi-box-arrow-up-right"></i> ประเมินใบหน้า
            </button>
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
