<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>การจัดการการจองคิว</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- การจองคิว -->
    <div class="container mt-5">
        <h1 class="text-center">การจัดการการจองคิว</h1>
        <div class="row justify-content-center mt-3">
            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; height: 500px;">
                <strong style="font-size: 30px;">จองคิว</strong>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col" align="right">
                            <a href="../reservation/reservation_form.php" class="btn btn-primary">เพิ่ม</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <table class="table" id="reservationData">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">วันที่</th>
                                    <th scope="col">เวลา</th>
                                    <th scope="col">พนักงาน</th>
                                    <th scope="col">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody id="content">
                                <!-- AJAX loaded content will go here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </span>
        </div>
    </div>

    <!-- Modals -->
    <?php include 'modals.php'; ?>

    <script src="scripts.js"></script>
</body>
</html>
