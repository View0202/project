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
                <a class="nav-link" href="#">โปรโมชั่น</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="resultuser.php">ผลลัพธ์ลูกค้า</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contactuser.php">ติดต่อเรา</a>
            </li>
            </ul>
    </div>

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
