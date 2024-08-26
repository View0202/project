<?php
session_start();
include("db_config.php");  // เชื่อมต่อฐานข้อมูล

function getReservations($year, $month) {
    global $db_con; // เชื่อมต่อฐานข้อมูล

    // คำนวณวันที่เริ่มต้นและสิ้นสุดของเดือน
    // $startDate = "$year-$month-01";
    // $endDate = date('Y-m-t', strtotime($startDate)); // วันสุดท้ายของเดือน

    // คำสั่ง SQL สำหรับดึงข้อมูลการจองในเดือนที่ระบุ
    $sql = "SELECT date, name, employees FROM reservation WHERE reservation_id = :reservation_id";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(':reservation_id', $reservation_id);
    // $stmt->bindParam(':endDate', $endDate);
    $stmt->execute();

    // ดึงข้อมูลทั้งหมดและจัดระเบียบเป็นอาเรย์
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $reservedDates = [];

    foreach ($reservations as $reservation) {
        $date = $reservation['reservation_date'];
        if (!isset($reservedDates[$date])) {
            $reservedDates[$date] = [];
        }
        $reservedDates[$date][] = [
            'name' => $reservation['name'],
            'employees' => $reservation['employees']
        ];
    }

    return $reservedDates;
}

function renderCalendar($year, $month, $reservedDates) {
    // เดือนและวันในภาษาไทย
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
    echo "<table id='calendarTable' class='table table-bordered'>";
    echo "<tr>";

    foreach ($daysOfWeek as $day) {
        echo "<th>$day</th>";
    }
    echo "</tr><tr>";

    if ($dayOfWeek > 0) {
        echo str_repeat('<td></td>', $dayOfWeek);
    }

    for ($day = 1; $day <= $numberOfDays; $day++) {
        $date = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        $hasReservation = isset($reservedDates[$date]);

        echo "<td>";
        echo "<button class='btn " . ($hasReservation ? "btn-danger" : "btn-link") . "' onclick='openBookingModal($year, $month, $day)'>$day</button>";

        if ($hasReservation) {
            echo "<ul>";
            foreach ($reservedDates[$date] as $reservation) {
                echo "<li>" . htmlspecialchars($reservation['name']) . " - " . htmlspecialchars($reservation['employee']) . "</li>";
            }
            echo "</ul>";
        }
        echo "</td>";

        if (($day + $dayOfWeek) % 7 == 0) {
            echo "</tr><tr>";
        }
    }

    if (($dayOfWeek + $numberOfDays) % 7 != 0) {
        echo str_repeat('<td></td>', 7 - (($dayOfWeek + $numberOfDays) % 7));
    }

    echo "</tr>";
    echo "</table>";
}

$year = 2567;
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
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

$reservedDates = getReservations($year, $month);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ปฏิทินพร้อมการจอง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Prompt', sans-serif;
        }
        #calendarTable {
            width: 100%;
            border-collapse: collapse;
        }
        #calendarTable th, #calendarTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        #calendarTable .btn {
            width: 100%;
            height: 100%;
            padding: 5px;
            font-size: 14px;
        }
        #calendarTable .btn-link {
            color: #007bff;
        }
        #calendarTable .btn-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
    <script>
        function openBookingModal(year, month, day) {
            // ฟังก์ชันสำหรับจัดการการคลิกวันที่
            alert(`เปิดโมดัลสำหรับวันที่ ${year}-${month}-${day}`);
        }
    </script>
</head>
<body>

<div class="container mt-4">
    <div class="text-center">
        <div class="nav-buttons mb-3">
            <a href="?month=<?php echo $prevMonth; ?>" class="btn btn-primary">เดือนก่อนหน้า</a>
            <a href="?month=<?php echo $nextMonth; ?>" class="btn btn-primary">เดือนถัดไป</a>
        </div>

        <?php renderCalendar($year, $month, $reservedDates); ?>
    </div>
</div>

</body>
</html>
