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
    <title>Mira Comprehensive Beauty Center</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="layouts/index.css">

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
    <script type="text/javascript" src="index.js"></script>

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
                <a class="nav-link" href="about.php">เกี่ยวกับเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="employee.php">ตารางพนักงาน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product.php">สินค้าและบริการ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="promotion.php">โปรโมชั่น</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="result.php">ผลลัพธ์ลูกค้า</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">ติดต่อเรา</a>
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
                                        <h5 class="modal-title" id="exampleModalLabel">กรอกข้อมูลการจองคิว</h5>
					                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                <!-- <span aria-hidden="true">&times;</span> -->
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="bookingForm">
                                                <div class="form-group">
                                                    <label for="date">วันที่จอง</label>
                                                    <input type="date" class="form-control" id="date" name="date">
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
                                                    <label for="serviceGroup" class="col-form-label">กลุ่มบริการ</label>
                                                    <div class="col-auto">
                                                        <select class="form-select" id="serviceGroup">
                                                            <option selected>กลุ่มบริการ...</option>
                                                            <option value="1">กลุ่มบริการ: ...........</option>
                                                            <option value="2">กลุ่มบริการ: ...........</option>
                                                            <option value="3">กลุ่มบริการ: ...........</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="serve" class="col-form-label">บริการ</label>
                                                    <div class="col-auto">
                                                        <select class="form-select" id="serve">
                                                            <option selected>บริการ...</option>
                                                            <option value="1">บริการ: ...........</option>
                                                            <option value="2">บริการ: ...........</option>
                                                            <option value="3">บริการ: ...........</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="selectEmployees" class="col-form-label">เลือกพนักงาน</label>
                                                    <div class="col-auto">
                                                        <select class="form-select" id="selectEmployees">
                                                            <option selected>เลือกพนักงาน...</option>
                                                            <option value="1">ชื่อ: ...........</option>
                                                            <option value="2">ชื่อ: ...........</option>
                                                            <option value="3">ชื่อ: ...........</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div style="font-size: 10px; margin: 10px;">
                                                    <p class="red-text">**ในการจองแต่ละครั้งสามารถเลื่อนคิวได้ 1 ครั้งเท่านั้น**</p>
                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                            <button type="button" class="btn btn-primary" onclick="saveBooking()">ต่อไป</button>
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
