<?php

session_start();
include("db_config.php");

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // เปลี่ยนเส้นทางกลับไปหน้า login หากผู้ใช้ยังไม่ได้เข้าสู่ระบบ
    exit;
}

// สร้าง SQL query ด้วย INNER JOIN ระหว่างตาราง users, customer และ estimate
$sql = "SELECT u.*, c.*, e.*
        FROM users u
        INNER JOIN customer c ON c.customer_id = c.customer_id
        INNER JOIN estimate e ON e.customer_id = e.customer_id
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
    $estimate_id = $row['estimate_id']; // หรือชื่อคอลัมน์ที่คุณใช้ในตาราง estimate
    $response = $row['response']; // สมมติว่าชื่อคอลัมน์ในตาราง estimate คือ response

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
			$('#editCustomer').data();
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

        .face strong {
            font-size: 30px;
        }
    </style>

    <script type="text/javascript">
		$(document).ready(function() {
			$('#estimateData').DataTable();
		});
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
                            <div class="justify-content-center align-items-center">
                                <div class="card-body" >
                                    <form  method="POST" id="editCustomer" class="form-horizontal" action="api/updatecustomer.php" onsubmit="return updateForm()">
                                        <input type="hidden" id="customer_id" name="customer_id" value="<?=$customer_id?>">
                                        <input type="hidden" id="user_id" name="user_id" value="<?=$user_id?>">

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">ชื่อ</span>
                                            <input type="text" id="name" name="name" class="form-control" value="<?=$row['name']?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">นามสกุล</span>
                                            <input type="text" id="surname" name="surname" class="form-control" value="<?=$row['surname']?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">อีเมล์</span>
                                            <input type="text" id="email" name="email" class="form-control" value="<?=$row['email']?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">เบอร์โทรศัพท์</span>
                                            <input type="number" id="phone" name="phone" class="form-control" value="<?=$row['phone']?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">อายุ</span>
                                            <input type="date" id="age" name="age" class="form-control" value="<?=$row['age']?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default" aria-describedby="passwordHelp">รหัสผ่าน</span>
                                            <input type="password" id="password" name="password" class="form-control" value="<?=$row['password']?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">ยืนยันรหัสผ่าน</span>
                                            <input type="password" id="password_cf" name="password_cf" class="form-control">
                                        </div>

                                        <button type="submit" class="btn btn-warning" value="แก้ไขข้อมูล">
                                            แก้ไขข้อมูล
                                        </button>
                                    </form>

                                    <script>
                                        function updateForm() {
                                            // รับค่าจาก input elements
                                            const password = document.getElementById('password').value;
                                            const password_cf = document.getElementById('password_cf').value;

                                            // ตรวจสอบว่ารหัสยืนยันถูกกรอกหรือไม่
                                            if (password_cf === "") {
                                                Swal.fire({
                                                    title: "กรุณากรอกรหัสยืนยัน",
                                                    icon: "warning"
                                                });
                                                return false; // ยกเลิกการส่งฟอร์ม
                                            }

                                            // ตรวจสอบว่ารหัสผ่านและรหัสยืนยันตรงกันหรือไม่
                                            if (password !== password_cf) {
                                                Swal.fire({
                                                    title: "รหัสผ่านไม่ตรงกัน",
                                                    text: "",
                                                    icon: "error"
                                                });
                                                return false; // ยกเลิกการส่งฟอร์ม
                                            }
                                        }
                                    </script>
                                    
                                </div>
                            </div>       
                        </span>
                    </div>  
                </div>

                <!-- การจองคิว -->
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

                <!-- ประเมินใบหน้า -->
                <div class="tab-pane fade" id="pills-face" role="tabpanel" aria-labelledby="pills-face-tab">
                    <div class="face">
                        <div class="row justify-content-center">
                            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px;">
                            <strong>การประเมินใบหน้า</strong>
                            <div class="container mt-5">
                                
                                <div class="row">
                                    <div class="col" align="right">
                                        <a href="estimate.php" class="btn btn-primary">เพิ่ม</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <table class="table" id="estimateData">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Detail</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Manage</th>
                                            </tr>
                                        </thead>

                                        <tbody id="content">
                                            <?php include 'fetch_estimate.php'; ?>
                                        </tbody>
                                        
                                    </table>
                                </div>

                            </div>

                            </span>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="estimateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="estimateModalLabel">การตอบกลับ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body" id="modalBodyContent">
                                <input type="hidden" id="estimate_id" name="estimate_id" value="<?=$estimate_id?>">
                                <input type="hidden" id="customer_id" name="customer_id" value="<?=$customer_id?>">

                                <div class="mb-3">
                                    <p class="card-text"><?php echo $response; ?></p>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                                
                            </div>

                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#estimateModal').on('show.bs.modal', function (e) {
                            var estimateId = $(e.relatedTarget).data('estimate_id'); // ดึง estimate_id จากปุ่มที่เปิดโมดัล

                            $.ajax({
                                url: 'api/getestimate.php', // URL ของสคริปต์ PHP ที่ดึงข้อมูล
                                type: 'GET',
                                dataType: 'json',
                                data: { estimate_id: estimateId }, // ส่ง estimate_id ไปยัง getestimate.php
                                success: function(response) {
                                    if (response.data && response.data.length > 0) {
                                        var content = '<ul>';
                                        $.each(response.data, function(index, item) {
                                            content += '<li>' + item.response + '</li>'; // เปลี่ยน `response` เป็นชื่อคอลัมน์ที่ต้องการ
                                        });
                                        content += '</ul>';
                                        $('#modalBodyContent').html(content); // แสดงข้อมูลในโมดัล
                                    } else {
                                        $('#modalBodyContent').html('ไม่มีข้อมูล');
                                    }
                                },
                                error: function() {
                                    $('#modalBodyContent').html('เกิดข้อผิดพลาดในการโหลดข้อมูล');
                                }
                            });
                        });
                    });
                </script>

                <!-- แบบประเมิน -->
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
