<?php
session_start();
include("../db_config.php");  // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['u_id'])) {
    header("Location: login.php");
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

    <!-- jquery -->
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script type="text/javascript" src="index_employee.js"></script>

    <!-- sweet -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <!-- Full Calender -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

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
                        <img class="widget-item-logoimg" src="../images/logo.png" alt=" ">
                    </a>
                </div>
            </div>
            
            <nav class="navbar navbar-light">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../employeeProfile/profile.php">ข้อมูลส่วนตัว <?php echo " " . htmlspecialchars($username)?> </a>
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
                <a class="nav-link" href="aboutEmployee.php">เกี่ยวกับเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reservationEmployee.php">ตารางพนักงาน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="productEmployee.php">สินค้าและบริการ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="promotionEmployee.php">โปรโมชั่น</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="resultEmployee.php">ผลลัพธ์ลูกค้า</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contactEmployee.php">ติดต่อเรา</a>
            </li>
        </ul>
    </div>

    <div class="calendar">
        <div class="row justify-content-center">
            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; margin-top: 20px;">
                <strong style="font-size: 30px;">ปฏิทิน</strong>
                <div class="container-fluid">
                    <div id="calendar" style="width: 1000px; margin: 0 auto; margin-bottom: 20px;"></div>
                </div>
            </span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                dateClick: function(info) {
                    // แสดงวันที่ที่เลือกใน modal
                    document.getElementById('date').value = info.dateStr;
                    var modal = new bootstrap.Modal(document.getElementById('bookingModal'));
                    modal.show();
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    // ดึงข้อมูลจาก PHP ผ่าน AJAX
                    $.ajax({
                        url: 'reservation/api/fetch_queue_data.php',
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);  // เพิ่มบรรทัดนี้เพื่อตรวจสอบข้อมูลในคอนโซล
                            var events = [];

                            // แปลงข้อมูลเป็น event ใน FullCalendar
                            data.forEach(function(queue) {
                                events.push({
                                    title:  queue.service_name + ', ' + queue.fname,
                                    start: queue.queue_date + 'T' + queue.queue_time
                                });
                            });

                            successCallback(events);
                        },
                        error: function() {
                            failureCallback();
                        }
                    });
                }
            });

            calendar.render();
        });
    </script>

    <hr>

    <div class="product">
        <strong>สินค้าและบริการ</strong>
        <div class="container">
        <p class="text-start fs-3">สินค้า</p>
            <div class="row justify-content-center g-3 align-items-center">
                <div class="col">
                    <div class="card" style="width: 20rem;">
                        <img src="../images/product_test.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="../images/product_test.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="../images/product_test.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
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
                        <img src="../images/service_test1.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="../images/service_test1.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="../images/service_test1.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
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
                        <img src="../images/service_test2.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="../images/service_test2.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card" style="width: 20rem;">
                    <img src="../images/service_test2.jpg" class="card-img-top" alt="..." style="width:100%; height:auto;">
                        <div class="card-body">
                            <h5 class="card-title">สินค้า :</h5>
                            <p class="card-text">ราคา : บาท</p>
                        </div>
                    </div>
                </div>
            </div>

            <a class="btn btn-primary" href="reservation/reservation_form.php" role="button" style="margin-top: 30px;">จองคิว</a>

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
                                    <img src="../images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
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
                                    <img src="../images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
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
                                    <img src="../images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
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
                                    <img src="../images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
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
                                    <img src="../images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
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
                                    <img src="../images/promotion_test.png" class="card-img-top" alt="..." style="width:100%; height:auto;">
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
                        <img src="../icons/facebook.png" alt="Facebook Icon" style="width:30px; height:30px; margin-right:5px;">
                            Facebook : .....................
                    </div>
                </div>
                <div class="col">
                    <div class="alert alert-secondary" role="alert">
                        <img src="../icons/line.png" alt="Line Icon" style="width:30px; height:30px; margin-right:5px;">
                        Line : ....................
                    </div>
                </div>
                <div class="col">
                    <div class="alert alert-secondary" role="alert">
                        <img src="../icons/phone.png" alt="Phone Icon" style="width:30px; height:30px; margin-right:5px;">
                        Phone : 090-3166790
                    </div>
                </div>
            </div>
        </div>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d236.7043517668177!2d98.81794018833246!3d18.33497964530612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30dbb903de457b15%3A0xade4cc5e472c4fdf!2sSS%20Com%20Service!5e0!3m2!1sth!2sth!4v1720606431292!5m2!1sth!2sth" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
    </div>

    <!-- <div class="fixed-bottom">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="margin: 20px;">
            <button type="button" class="btn btn-outline-success" onclick="location.href='../estimate/estimate.php'">
                <i class="bi bi-box-arrow-up-right"></i> ประเมินใบหน้า
            </button>
        </div>
    </div> -->
    
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
