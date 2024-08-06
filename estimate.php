<?php

    session_start();
    include("db_config.php");

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

    <div class="estimate">
        <form id="estimateForm" method="POST" enctype="multipart/form-data" action="api/addestimate.php">
            <input type="hidden" name="customer_id" value="<?=$customer_id?>">
            <div class="row justify-content-center">
                <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; margin-top: 20px;">
                    <strong>ประเมินใบหน้า</strong>
                    <div class="row justify-content-center align-items-center" style="margin-bottom: 20px;">
                        <div class="col">
                            <div class="card" style="width: 500px; height: 400px; margin-left: 50px;">
                                <div class="img-container">
                                    <img id="displayImage" src="images/human.jpeg" class="card-img-top">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" id="formFile" name="formFile" style="width: 450px; margin-left: 25px; margin-top: 20px;">
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3 fs-3">
                                <label for="detail" class="form-label">รายละเอียด</label>
                                <textarea class="form-control" id="detail" name="detail" rows="3"></textarea>
                            </div> 

                            <button type="submit" class="btn btn-warning">
                                ส่งประเมินใบหน้า
                            </button> 
                            <a href="home.php" class="btn btn-secondary">ยกเลิก</a>
                        </div>
                        
                    </div>
                </span>
            </div>
        </form>
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

<!-- JavaScript image -->
<script>
    document.getElementById('formFile').addEventListener('change', function(event) {
        const file = event.target.files[0]; // รับไฟล์ที่ถูกเลือก
        if (file) {
            const reader = new FileReader(); // สร้าง FileReader
            reader.onload = function(e) {
                document.getElementById('displayImage').src = e.target.result; // อัปเดต src ของรูปภาพ
            }
            reader.readAsDataURL(file); // อ่านไฟล์เป็น Data URL
        }
    });
</script>

</body>
</html>
