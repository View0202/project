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
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="row align-items-center">
                            <?php
                                function renderCalendar($year, $month) {
                                    // Months and days in Thai
                                    $months = [
                                        1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 
                                        4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 
                                        7 => 'กรกฎาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 
                                        10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม'
                                    ];

                                    $daysOfWeek = ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'];

                                    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
                                    $numberOfDays = date('t', $firstDayOfMonth);
                                    $dayOfWeek = date('w', $firstDayOfMonth);

                                    echo "<h2>{$months[$month]} $year</h2>";
                                    echo "<table id='calendarTable'>";
                                    echo "<tr>";

                                    // Display days of the week
                                    foreach ($daysOfWeek as $day) {
                                        echo "<th>$day</th>";
                                    }
                                    echo "</tr><tr>";

                                    // Blank cells for days before the first of the month
                                    if ($dayOfWeek > 0) {
                                        echo str_repeat('<td></td>', $dayOfWeek);
                                    }

                                    // Display days of the month
                                    for ($day = 1; $day <= $numberOfDays; $day++) {
                                        echo "<td>";
                                        echo "<button class='btn btn-link' onclick='openBookingModal($year, $month, $day)'>$day</button>";
                                        echo "</td>";

                                        // Start a new row at the end of the week
                                        if (($day + $dayOfWeek) % 7 == 0) {
                                            echo "</tr><tr>";
                                        }
                                    }

                                    // Blank cells for the days after the end of the month
                                    if (($dayOfWeek + $numberOfDays) % 7 != 0) {
                                        echo str_repeat('<td></td>', 7 - (($dayOfWeek + $numberOfDays) % 7));
                                    }

                                    echo "</tr>";
                                    echo "</table>";
                                }

                                $year = 2567;

                                // Get month from URL or default to current month
                                $month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');

                                // Navigation buttons
                                $prevMonth = $month - 1;
                                $nextMonth = $month + 1;

                                if ($prevMonth < 1) {
                                    $prevMonth = 12;
                                    $year--;
                                }

                                if ($nextMonth > 12) {
                                    $nextMonth = 1;
                                    $year++;
                                }

                                echo "<div class='nav-buttons'>";
                                echo "<a href='?month=$prevMonth'>เดือนก่อนหน้า</a>";
                                echo "<a href='?month=$nextMonth'>เดือนถัดไป</a>";
                                echo "</div>";

                                // Render the calendar for the selected month
                                renderCalendar($year, $month);
                            ?>

                            <!-- Booking Text -->
                            <div style="font-size: 20px;">
                                <p class="black-text">>>คลิกวันที่เพื่อเลือกการจองคิว<<</p>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">กรอกข้อมูลการจองคิว</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="bookingForm" class="form-horizontal" action="api/addreservation.php">
                                                <input type="hidden" id="customer_id" name="customer_id" value="<?= htmlspecialchars($customer_id) ?>">

                                                <div class="form-group">
                                                    <label for="date">วันที่จอง</label>
                                                    <input type="date" class="form-control" id="date" name="date" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="time">เวลาจอง</label>
                                                    <input type="time" class="form-control" id="time" name="time" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">ชื่อการจองคิว</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="phone">เบอร์โทรศัพท์</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="serviceType" class="col-form-label">กลุ่มบริการ</label>
                                                    <select class="form-select" id="service_type" name="service_type" required>
                                                        <option value="" disabled selected>เลือกกลุ่มบริการ</option>
                                                        <?php foreach ($serviceTypes as $serviceType): ?>
                                                            <option value="<?= htmlspecialchars($serviceType['service_type_id']) ?>">
                                                                <?= htmlspecialchars($serviceType['service_type_name']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="service" class="col-form-label">บริการ</label>
                                                    <select class="form-select" id="service" name="service" required>
                                                        <option value="" disabled selected>เลือกบริการ</option>
                                                        <?php foreach ($services as $service): ?>
                                                            <option value="<?= htmlspecialchars($service['service_id']) ?>">
                                                                <?= htmlspecialchars($service['service_name']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="service_price" class="col-form-label">ราคา</label>
                                                    <select class="form-select" id="service_price" name="service_price" required>
                                                        <option value="" disabled selected>ราคา</option>
                                                        <?php foreach ($services as $service): ?>
                                                            <option value="<?= htmlspecialchars($service['service_id']) ?>">
                                                                <?= htmlspecialchars($service['service_price']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="selectEmployees" class="col-form-label">เลือกพนักงาน</label>
                                                    <select class="form-select" id="employees" name="employees" required>
                                                        <option value="" disabled selected>เลือกพนักงาน</option>
                                                        <?php foreach ($employees as $employee): ?>
                                                            <option value="<?= htmlspecialchars($employee['emp_id']) ?>">
                                                                <?= htmlspecialchars($employee['fname']) . " " . htmlspecialchars($employee['lname']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div style="font-size: 10px; margin: 10px;">
                                                    <p class="red-text">**ในการจองแต่ละครั้งสามารถเลื่อนคิวได้ 1 ครั้งเท่านั้น**</p>
                                                </div>

                                                <!-- ปุ่ม submit อยู่ภายในฟอร์ม -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                    <button type="submit" class="btn btn-primary">ต่อไป</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function openBookingModal(year, month, day) {
                                    var date = new Date(year, month - 1, day); 
                                    var formattedDate = date.toISOString().substr(0, 10); 
                                    document.getElementById("date").value = formattedDate;
                                    $('#dateModal').modal('show');
                                }

                                // เพิ่มโค้ดตรวจสอบว่าแบบฟอร์มถูกส่งหรือไม่
                                document.getElementById('bookingForm').addEventListener('submit', function(e) {
                                    console.log('Form is being submitted');
                                });
                            </script>

                        </div>
                    </div>
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

<script>
    function openBookingModal(year, month, day) {
        // Set the date field with the selected date
        var date = new Date(year, month - 1, day +1); // Month in JavaScript starts from 0
        var formattedDate = date.toISOString().substr(0, 10); // Format as YYYY-MM-DD
        document.getElementById("date").value = formattedDate;

        // Show the modal
        $('#dateModal').modal('show');
    }

    function saveBooking() {
        var form = document.getElementById('bookingForm');
        var formData = new FormData(form);

        // Validate form data
        if (!formData.get('date') || !formData.get('time') || !formData.get('name') || !formData.get('phone') || !formData.get('serviceGroup') || !formData.get('serve') || !formData.get('selectEmployees')) {
            Swal.fire({
                title: "กรุณากรอกข้อมูลให้ครบ",
                text: "",
                icon: "warning"
            });
            return;
        }

        // Handle form submission, e.g., via AJAX
        Swal.fire({
            title: "แก้ไขข้อมูลสำเร็จ",
            text: "",
            icon: "success"
        }).then(() => {
            $('#dateModal').modal('hide');
        });
    }
</script>

</body>
</html>
