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
    <title>Mira Comprehensive Beauty Center</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../layouts/index.css">
    
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
    <script type="text/javascript" src="../index.js"></script>

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

        .form strong {
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
                    <a class="widget-item-logolink">
                        <img class="widget-item-logoimg" src="../images/logo.png" alt=" ">
                    </a>
                </div>
            </div>
            
            <nav class="navbar navbar-light">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="profile.php">ข้อมูลส่วนตัว <?php echo " " . htmlspecialchars($username)?></a>
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

        <div class="profileuser">
            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist" style="margin-top: 20px;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">ข้อมูลส่วนตัว</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-reservation-tab" data-bs-toggle="pill" data-bs-target="#pills-reservation" type="button" role="tab" aria-controls="pills-reservation" aria-selected="false">จองคิว</button>
                </li>
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-face-tab" data-bs-toggle="pill" data-bs-target="#pills-face" type="button" role="tab" aria-controls="pills-face" aria-selected="false">การประเมินใบหน้า</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-form-tab" data-bs-toggle="pill" data-bs-target="#pills-form" type="button" role="tab" aria-controls="pills-form" aria-selected="false">ความคิดเห็น</button>
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
                                        <input type="hidden" id="customer_id" name="customer_id" value="<?= htmlspecialchars($data['customer_id']) ?>">
                                        <input type="hidden" id="u_id" name="u_id" value="<?= htmlspecialchars($data['u_id']) ?>">

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">ชื่อผู้ใช้</span>
                                            <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($data['username']) ?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">ชื่อ</span>
                                            <input type="text" id="firstname" name="firstname" class="form-control" value="<?= htmlspecialchars($data['firstname']) ?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">นามสกุล</span>
                                            <input type="text" id="lastname" name="lastname" class="form-control" value="<?= htmlspecialchars($data['lastname']) ?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">อีเมล์</span>
                                            <input type="text" id="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">เบอร์โทรศัพท์</span>
                                            <input type="number" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($data['phone']) ?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">อายุ</span>
                                            <input type="date" id="age" name="age" class="form-control" value="<?= htmlspecialchars($data['age']) ?>">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default" aria-describedby="passwordHelp">รหัสผ่าน</span>
                                            <input type="password" id="password" name="password" class="form-control" value="<?= htmlspecialchars($data['password']) ?>">
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
                            <strong style="font-size: 30px;">จองคิว</strong>
                            <div class="container mt-5">
                                
                                <div class="row">
                                    <div class="col" align="right">
                                        <a href="../reservation/reservation_form.php" class="btn btn-primary">เพิ่ม</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <table class="table" id="reservationData">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                                <!-- <th scope="col">ชื่อจองคิว</th>
                                                <th scope="col">เบอร์โทรศัพท์</th> -->
                                                <th scope="col">วันที่</th>
                                                <th scope="col">เวลา</th>
                                                <th scope="col">พนักงาน</th>
                                                <th scope="col">จัดการ</th>
                                            </tr>
                                        </thead>

                                        <tbody id="content">
                                            <?php include 'api/fetch_reservation.php'; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reservationModalLabel">แก้ไขข้อมูลการจองคิว</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body" id="modalBodyContent">
                                <div class="mb-3">
                                    <form method="POST" id="bookingForm" class="form-horizontal" action="api/updatereservation.php">
                                        <input type="hidden" id="customer_id" name="customer_id" value="<?= htmlspecialchars($customer_id) ?>">
                                        <input type="hidden" id="queue_id" name="queue_id" value="<?= htmlspecialchars($queue_id) ?>">

                                        <div class="form-group">
                                            <label for="date">วันที่จอง</label>
                                            <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($queue_date) ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="time">เวลาจอง</label>
                                            <input type="time" class="form-control" id="time" name="time" value="<?= htmlspecialchars($queue_time) ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="selectEmployees" class="col-form-label">เลือกพนักงาน</label>
                                            <select class="form-select" id="employees" name="employees" required>
                                                <option value="" disabled selected><?= htmlspecialchars($employee_name) ?></option>
                                                <?php foreach ($employees as $employee): ?>
                                                    <option value="<?= htmlspecialchars($employee['emp_id']) ?>">
                                                        <?= htmlspecialchars($employee['fname']) . " " . htmlspecialchars($employee['lname']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- ปุ่ม submit อยู่ภายในฟอร์ม -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Deposit -->
                <div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="depositModalLabel">.ใบเสร็จค่ามัดจำ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modalBodyContent">
                                <input type="hidden" id="customer_id" name="customer_id">
                                <div id="depositContent"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).on('show.bs.modal', '#depositModal', function (event) {
                        var customer_id = $(event.relatedTarget).data('customer-id'); // Get customer ID from button data attribute
                        
                        // Set the hidden input field value
                        $('#customer_id').val(customer_id);

                        // Fetch slip image via AJAX
                        $.ajax({
                            url: 'api/fetch_slip.php',
                            type: 'POST',
                            data: { customer_id: customer_id },
                            dataType: 'json',
                            success: function (response) {
                                if (response.slip) {
                                    // Display the image in the modal
                                    $('#depositContent').html('<img src="../image_payment/' + response.slip + '" width="300" height="300" alt="Payment Slip">');
                                } else {
                                    // Display error message
                                    $('#depositContent').html('<p class="text-danger">No slip found</p>');
                                }
                            },
                            error: function () {
                                $('#depositContent').html('<p class="text-danger">Error fetching slip</p>');
                            }
                        });
                    });

                    function deleteQueue(queue_id) {
                        Swal.fire({
                            title: 'คุณต้องการลบการจองคิว?',
                            text: "",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ใช่, ลบเลย!',
                            cancelButtonText: 'ยกเลิก'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: 'api/delete_queue.php',  // ไฟล์ PHP ที่จะใช้ลบข้อมูล
                                    type: 'POST',
                                    data: { queue_id: queue_id },
                                    success: function(response) {
                                        // ตรวจสอบผลลัพธ์จาก PHP
                                        if (response.success) {
                                            Swal.fire(
                                                'ลบสำเร็จ!',
                                                'การจองคิวของคุณถูกลบแล้ว.',
                                                'success'
                                            ).then(() => {
                                                location.reload();  // โหลดหน้าใหม่เพื่อแสดงข้อมูลที่อัปเดต
                                            });
                                        } else {
                                            Swal.fire(
                                                'เกิดข้อผิดพลาด!',
                                                'ไม่สามารถลบการจองคิวได้.',
                                                'error'
                                            );
                                        }
                                    }
                                });
                            }
                        });
                    }
                    
                </script>
                
                <!-- ประเมินใบหน้า -->
                <div class="tab-pane fade" id="pills-face" role="tabpanel" aria-labelledby="pills-face-tab">
                    <div class="face">
                        <div class="row justify-content-center">
                            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; height: 500px">
                                <strong>การประเมินใบหน้า</strong>
                                <div class="container mt-5">
                                    <div class="row">
                                        <div class="col" align="right">
                                            <a href="../estimate/estimate.php" class="btn btn-primary">เพิ่ม</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" id="customer_id" name="customer_id" value="<?= htmlspecialchars($customer_id) ?>">
                                        <table class="table" id="estimateData">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">รายละเอียด</th>
                                                    <th scope="col">รูปภาพใบหน้า</th>
                                                    <th scope="col">ข้อมูล</th>
                                                </tr>
                                            </thead>
                                            <tbody id="estimateContent">
                                                <?php include 'api/fetch_estimate.php'; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="estimateModal" tabindex="-1" aria-labelledby="estimateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="estimateModalLabel">การตอบกลับ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modalBodyContent">
                                <input type="hidden" id="estimate_id" name="estimate_id">
                                <div id="responseContent"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Javascript -->
                <script>
                    $(document).ready(function() {
                        $('#estimateModal').on('show.bs.modal', function (e) {
                            var estimateId = $(e.relatedTarget).data('estimate_id'); // ดึง estimate_id จากปุ่มที่เปิดโมดัล

                            $.ajax({
                                url: 'api/getestimate.php', // URL ของสคริปต์ PHP ที่ดึงข้อมูล
                                type: 'POST',
                                dataType: 'json',
                                contentType: 'application/json',
                                data: JSON.stringify({ estimate_id: estimateId }), // ส่ง estimate_id ไปยัง getestimate.php
                                success: function(response) {
                                    console.log(response); // ดูการตอบกลับจาก PHP ว่าได้อะไรบ้าง
                                    if (response.response) {
                                        $('#responseContent').text(response.response); // แสดงข้อมูลในโมดัล
                                    } else {
                                        $('#responseContent').text(response.error);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', status, error); // ตรวจสอบข้อผิดพลาด
                                    $('#responseContent').text('เกิดข้อผิดพลาดในการโหลดข้อมูล');
                                }
                            });
                        });
                    });

                    function deleteEstimate(estimateId) {
                        Swal.fire({
                            title: 'คุณแน่ใจว่าต้องการลบข้อมูลนี้?',
                            text: "",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ใช่, ลบข้อมูล!',
                            cancelButtonText: 'ยกเลิก'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: 'api/delete_estimate.php', // URL ของสคริปต์ PHP สำหรับการลบข้อมูล
                                    type: 'POST',
                                    dataType: 'json',
                                    contentType: 'application/json',
                                    data: JSON.stringify({ estimate_id: estimateId }), // ส่ง estimate_id ไปยัง delete_estimate.php
                                    success: function(response) {
                                        if (response.success) {
                                            Swal.fire(
                                                'ลบข้อมูลสำเร็จ!',
                                                '',
                                                'success'
                                            ).then(() => {
                                                location.reload(); // โหลดหน้าใหม่เพื่ออัปเดตตาราง
                                            });
                                        } else {
                                            Swal.fire(
                                                'เกิดข้อผิดพลาด!',
                                                'ไม่สามารถลบข้อมูลได้: ' + response.error,
                                                'error'
                                            );
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error:', status, error); // ตรวจสอบข้อผิดพลาด
                                        Swal.fire(
                                            'เกิดข้อผิดพลาด!',
                                            'ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้',
                                            'error'
                                        );
                                    }
                                });
                            }
                        });
                    }
                </script>

                <!-- แบบประเมิน -->
                <div class="tab-pane fade" id="pills-form" role="tabpanel" aria-labelledby="pills-form-tab">
                    <form method="POST" id="comment" class="form-horizontal" action="api/updatecomment.php" onsubmit="return updateComment()">
                        <div class="row justify-content-center">
                            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; height: 500px">
                                <strong style="font-size: 30px;">แสดงความคิดเห็น</strong>
                                <input type="hidden" id="customer_id" name="customer_id" value="<?= htmlspecialchars($data['customer_id']) ?>">
                                <input type="hidden" id="u_id" name="u_id" value="<?= htmlspecialchars($data['u_id']) ?>">

                                <div class="mb-3" style="margin-top: 20px;">
                                    <textarea class="form-control" id="commentTextarea1" name="comment" rows="5" placeholder="กรุณาใส่ความคิดเห็นของคุณ"></textarea>
                                </div>

                                <button type="submit" class="btn btn-warning" value="เพิ่มความคิดเห็น">
                                    เพิ่มความคิดเห็น
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                <script>
                    function updateComment() {
                        // รับค่าจาก input elements
                        const comment = document.getElementById('commentTextarea1').value;

                        // ตรวจสอบว่ามีการกรอกความคิดเห็นหรือไม่
                        if (comment === "") {
                            Swal.fire({
                                title: "กรุณากรอกความคิดเห็น",
                                icon: "warning"
                            });
                            return false; // ยกเลิกการส่งฟอร์ม
                        }
                    }
                </script>
                
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