<?php
session_start();
include("../db_config.php");  // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
// if (!isset($_SESSION['u_id'])) {
//     header("Location: ../login.php");
//     exit;
// }

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

// ดึงข้อมูล service_type, service, และ employees
$serviceTypeSql = "SELECT * FROM service_type";
$serviceSql = "SELECT * FROM service";
$employeeSql = "SELECT * FROM employees";

// เตรียมและดำเนินการ SQL สำหรับ service_type
$serviceTypeStmt = $db_con->prepare($serviceTypeSql);
$serviceTypeStmt->execute();
$serviceTypes = $serviceTypeStmt->fetchAll(PDO::FETCH_ASSOC);

// เตรียมและดำเนินการ SQL สำหรับ service
$serviceStmt = $db_con->prepare($serviceSql);
$serviceStmt->execute();
$services = $serviceStmt->fetchAll(PDO::FETCH_ASSOC);

// เตรียมและดำเนินการ SQL สำหรับ employees
$employeeStmt = $db_con->prepare($employeeSql);
$employeeStmt->execute();
$employees = $employeeStmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mira Comprehensive Beauty Center</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../layouts/index.css">

    <!-- Google Fonts - Prompt -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- jquery -->
    <script type="text/javascript" src="../index.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>

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

        .reservation strong {
            font-size: 30px;
        }

        .red-text {
            color: red;
        }

        .calendar strong {
            font-size: 30px;
        }

        .d-flex {
            text-align: center;
        }

        h1, h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            width: 14%;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            height: 50px;
        }
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .nav-buttons a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
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
                <a class="nav-link" href="../user/employee.php">ตารางพนักงาน</a>
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

    <div class="calendar">
        <div class="row justify-content-center">
            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; margin-top: 20px;">
                <strong>การจองคิว</strong>
                    <div class="container-fluid">
                        <div id="calendar"></div>
                    </div>

                    <!-- คำอธิบาย -->
                    <div style="font-size: 20px; margin: 20px">
                        <p class="black-text">>>คลิกวันที่เพื่อเลือกการจองคิว<<</p>
                    </div>
            </span>
        </div>
    </div>

    <!-- Modal booking -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="bookingForm" method="POST" action="api/addreservation.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">กรอกข้อมูลการจองคิว</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="date" class="form-label">วันที่การจองคิว</label>
                            <input type="text" class="form-control" id="date" name="date" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="serviceType" class="form-label">กลุ่มบริการ</label>
                            <select class="form-select" id="service_type" name="service_type" required>
                                <option value="" disabled selected>เลือกกลุ่มบริการ</option>
                                <?php foreach ($serviceTypes as $serviceType): ?>
                                    <option value="<?= htmlspecialchars($serviceType['service_type_id']) ?>"><?= htmlspecialchars($serviceType['service_type_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="service" class="form-label">บริการ</label>
                            <select class="form-select" id="service" name="service" required>
                                <option value="" disabled selected>เลือกบริการ</option>
                                <?php foreach ($services as $service): ?>
                                    <option value="<?= htmlspecialchars($service['service_id']) ?>" data-time="<?= htmlspecialchars($service['service_time']) ?>" data-price="<?= $service['service_price'] ?>">
                                        <?= htmlspecialchars($service['service_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">ราคา</label>
                            <input type="text" class="form-control" id="price" name="price" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="deposit_price" class="form-label">ราคาค่ามัดจำ</label>
                            <input type="text" class="form-control" id="deposit_price" name="deposit_price" readonly>
                        </div>


                        <div class="mb-3">
                            <label for="selectEmployees" class="form-label">เลือกพนักงาน</label>
                            <select class="form-select" id="employees" name="employees" required>
                                <option value="" disabled selected>เลือกพนักงาน</option>
                                <?php foreach ($employees as $employee): ?>
                                    <option value="<?= htmlspecialchars($employee['emp_id']) ?>">
                                        <?= htmlspecialchars($employee['fname']) . " " . htmlspecialchars($employee['lname']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="start_time" class="form-label">เวลาเริ่มต้น</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_time" class="form-label">เวลาสิ้นสุด</label>
                            <input type="text" class="form-control" id="end_time" name="end_time" readonly>
                        </div>

                        <div style="font-size: 10px; margin: 10px;">
                            <p class="red-text">**ในการจองแต่ละครั้งสามารถเลื่อนคิวได้ 1 ครั้งเท่านั้น**</p>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">จองคิว</button>
                    </div>
                    
                </form>
            </div>
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
                events: 'api/fetchevents.php' // ดึงเหตุการณ์จากเซิร์ฟเวอร์
            });

            calendar.render();
        });

        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch('api/addreservation.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var calendar = FullCalendar.getCalendar(document.getElementById('calendar'));
                    calendar.addEvent({
                        title: 'Pending Approval',
                        start: formData.get('date') + 'T' + formData.get('start_time'),
                        end: formData.get('date') + 'T' + formData.get('end_time'),
                        extendedProps: {
                            employee: formData.get('employees')
                        }
                    });
                    var modal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
                    modal.hide();
                } else {
                    alert('การจองล้มเหลว กรุณาลองอีกครั้ง');
                }
            });
        });

        var startTimeInput = document.getElementById('start_time');
        var endTimeInput = document.getElementById('end_time');
        var serviceSelect = document.getElementById('service');
        var priceInput = document.getElementById('price');
        var depositPriceInput = document.getElementById('deposit_price');

        serviceSelect.addEventListener('change', function() {
            var selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            var servicePrice = selectedOption ? selectedOption.getAttribute('data-price') : 0;
            var serviceTime = selectedOption ? selectedOption.getAttribute('data-time') : 0;
            
            // อัปเดตราคา
            priceInput.value = servicePrice;

            // คำนวณราคาค่ามัดจำ
        var depositPrice = servicePrice * 0.10;
        depositPriceInput.value = depositPrice.toFixed(2);

            // คำนวณเวลาสิ้นสุด
            calculateEndTime();
        });

        startTimeInput.addEventListener('change', calculateEndTime);

        function calculateEndTime() {
            var startTime = startTimeInput.value;
            var selectedService = serviceSelect.options[serviceSelect.selectedIndex];
            var serviceTime = selectedService ? parseInt(selectedService.getAttribute('data-time')) : 0;

            if (startTime && serviceTime) {
                var [hours, minutes] = startTime.split(':').map(Number);

                // คำนวณเวลาสิ้นสุด
                var endMinutes = minutes + serviceTime;
                var endHours = hours + Math.floor(endMinutes / 60);
                endMinutes = endMinutes % 60;

                // รูปแบบเวลาสิ้นสุดเป็น HH:MM
                var formattedEndTime =
                    String(endHours).padStart(2, '0') + ':' +
                    String(endMinutes).padStart(2, '0');

                endTimeInput.value = formattedEndTime;
            }
        }

    </script>

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
