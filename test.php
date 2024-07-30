<?php
    include("db_config.php");

    // รับค่า ID จาก URL
    $id = $_GET['id'];

    // SQL เพื่อดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT * FROM customer WHERE customer_id = ?";

    // เตรียม statement
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();

    // ดึงข้อมูลจากฐานข้อมูล
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mira Comprehensive Beauty Center</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="layouts/index.css">
    
    <!-- Google Fonts - Prompt -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- เพิ่ม jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- เพิ่ม Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

    <!-- เพิ่ม Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <!-- sweet -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jquery -->
    <script type="text/javascript" src="index.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#edituser').data();
        });
    </script>

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
                    <a class="widget-item-logolink" href="index.html">
                        <img class="widget-item-logoimg" src="images/logo.png" alt=" ">
                    </a>
                </div>
            </div>
            
            <nav class="navbar navbar-light">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="profile.php">ข้อมูลส่วนตัว</a>
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
                    <a class="nav-link" href="home.php">หน้าแรก</a>
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
                    <a class="nav-link" href="resultuser.php">ผลลัพธ์ลูกค้า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactuser.php">ติดต่อเรา</a>
                </li>
            </ul>
        </div>

        <div class="profileuser">
            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist" style="margin-top: 20px;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">ข้อมูลส่วนตัว</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-reservation-tab" data-bs-toggle="pill" data-bs-target="#pills-reservation" type="button" role="tab" aria-controls="pills-reservation" aria-selected="false">จองคิว</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-status-tab" data-bs-toggle="pill" data-bs-target="#pills-status" type="button" role="tab" aria-controls="pills-status" aria-selected="false">สถานะการจอง</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-face-tab" data-bs-toggle="pill" data-bs-target="#pills-face" type="button" role="tab" aria-controls="pills-face" aria-selected="false">การประเมินใบหน้า</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-form-tab" data-bs-toggle="pill" data-bs-target="#pills-form" type="button" role="tab" aria-controls="pills-form" aria-selected="false">แบบประเมิน</button>
                </li>
            </ul>

            <!-- แท็กข้อมูลส่วนตัว -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row justify-content-center">
                        <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px;">
                            <div class="row justify-content-center  align-items-center">
                                <div class="col">
                                    <div class="card" style="width: 15rem; margin-left: 150px">
                                    <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <a href="#" class="btn btn-primary">อัพโหลดรูป</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card-body">
                                        <form name="formedit" method="POST" id="editCustomer" class="form-horizontal" action="api/updatecustomer.php">
                                            <input type="hidden" name="customer_id" value="<?=$id?>">

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ชื่อ</span>
                                                <input type="text" id="edit_name" name="name" class="form-control" value="<?=$row['name']?>">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="inputGroup-sizing-default">นามสกุล</span>
                                                <input type="text" id="edit_surname" name="surname" class="form-control" value="<?=$row['surname']?>">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="inputGroup-sizing-default">อีเมล์</span>
                                                <input type="text" id="edit_email" name="email" class="form-control" value="<?=$row['email']?>">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="inputGroup-sizing-default">เบอร์โทรศัพท์</span>
                                                <input type="number" id="edit_phone" name="phone" class="form-control" value="<?=$row['phone']?>">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="inputGroup-sizing-default">อายุ</span>
                                                <input type="date" id="edit_age" name="age" class="form-control" value="<?=$row['age']?>">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="inputGroup-sizing-default" aria-describedby="passwordHelp">รหัสผ่าน</span>
                                                <input type="password" id="edit_password" name="password" class="form-control">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ยืนยันรหัสผ่าน</span>
                                                <input type="password" id="edit_password_cf" name="password_cf" class="form-control">
                                            </div>

                                            <button type="submit" class="btn btn-warning" value="แก้ไขข้อมูล" onclick="updateCustomer()">
                                                แก้ไขข้อมูล
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>       
                        </span>
                    </div>  
                </div>

                <div class="tab-pane fade" id="pills-reservation" role="tabpanel" aria-labelledby="pills-reservation-tab">
                    <div class="reservation">
                        <div class="row justify-content-center">
                            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; height: 500px">
                            <strong>จองคิว</strong>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-status" role="tabpanel" aria-labelledby="pills-status-tab">
                    <div class="status">
                        <div class="row justify-content-center">
                            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; height: 500px">
                            <strong>สถานะการจอง</strong>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-face" role="tabpanel" aria-labelledby="pills-face-tab">
                    <div class="face">
                        <div class="row justify-content-center">
                            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; height: 500px">
                            <strong>การประเมินใบหน้า</strong>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-form" role="tabpanel" aria-labelledby="pills-form-tab">
                    <div class="form">
                        <div class="row justify-content-center">
                            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; height: 500px">
                            <strong>แบบประเมิน</strong>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="container2">
            <header id="footer">
                <nav class="navbar navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="login.php">
                            Copyright 2024 @ Mira One Stop Services Beauty Center
                        </a>
                    </div>
                </nav>
            </header>
        </div>
    </div>

</body>
</html>
