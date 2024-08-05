<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mira Comprehensive Beauty Center</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="layouts/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="index.js"></script>
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
            cursor: pointer; /* เปลี่ยนเคอร์เซอร์เป็น pointer เมื่อชี้ */
        }
        .info {
            font-size: 18px;
            color: #000;
            margin-top: 20px;
        }
        hr {
            border: 2px solid #ddd;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .info-box {
            width: 100%;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            display: none; /* ซ่อนกล่องข้อมูลเริ่มต้น */
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
        function selectGateway(id) {
            let info;
            switch(id) {
                case 1:
                    info = 'ข้อมูลสำหรับการชำระเงิน "เลขบัญชี"';
                    break;
                case 2:
                    info = 'ข้อมูลสำหรับการชำระเงิน "พร้อมเพย์"';
                    break;
                default:
                    info = 'ข้อมูลไม่ถูกต้อง';
            }
            document.getElementById('paymentInfo').innerText = info;
            document.getElementById('paymentSeparator').style.display = 'block'; // แสดง <hr> เมื่อคลิก
            document.getElementById('infoBox').style.display = 'block'; // แสดงกล่องข้อความเมื่อคลิก
            document.getElementById('buttonContainer').style.display = 'block'; // แสดงปุ่มเมื่อคลิก
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

    <div class="payment">
        <div class="row justify-content-center">
            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; margin-top: 20px;">
                <strong>ช่องทางการชำระเงิน</strong>
                <div class="row justify-content-center align-items-center">
                    <fieldset class="wrap_content">
                        <fieldset class="body_content">
                            <fieldset>
                                <div class="coin">
                                    <div>
                                        <span style="font-size: 20px; color: #000;">ราคา :</span>
                                        <span>
                                            <font style="color: var(--font-my-coin);font-size: 20px;">
                                                ........ บาท
                                            </font>  
                                        </span>
                                    </div>
                                </div>
                                <div class="list_gateway" style="margin-top: 20px; padding: 20px">
                                    <div style="font-size: 20px;" class="head_text"> กรุณาเลือกช่องทางการชำระเงิน </div>
                                    <div class="row justify-content-center align-items-center" id="wrap_gateway">
                                        <div class="col-auto">
                                            <div class="card" style="width: 20rem;">
                                                <div class="img_gateway gateway_1" value="">
                                                    <img src="images/payment.png" style="width:100%;" onclick="selectGateway(1);"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="card" style="width: 20rem;">
                                                <div class="img_gateway gateway_2" value="24">
                                                    <img src="images/payment-QR.png" style="width:100%;" onclick="selectGateway(2);" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <hr> ที่จะแสดงขึ้นเมื่อคลิก -->
                                <hr id="paymentSeparator" style="display: none;" />
                                <!-- div สำหรับแสดงข้อมูลการชำระเงิน -->
                                <div id="paymentInfo" class="info">
                                    <!-- ข้อมูลการชำระเงินจะถูกเพิ่มที่นี่ -->
                                </div>
                                <!-- div สำหรับแสดงข้อมูล -->
                                <div id="infoBox" class="info-box center-content">
                                    <!-- ข้อมูลเพิ่มเติมจะถูกเพิ่มที่นี่ -->
                                </div>
                                <!-- ปุ่มที่จะแสดงขึ้นเมื่อคลิก -->
                                <div id="buttonContainer" class="btn-container">
                                    <a href="uploadimageuser.php" class="btn btn-success" role="button">อัพโหลดหลักฐาน</a>
                                    <a href="reservation_form.php" class="btn btn-warning" role="button">ย้อนกลับ</a>
                                </div>
                            </fieldset>
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
