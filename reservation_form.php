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

        .reservation strong {
            font-size: 30px;
        }

        .red-text {
            color: red;
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
                <a class="nav-link" href="#">หน้าแรก</a>
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
        <strong>ตารางพนักงาน</strong>
        <div class="container">
            <div class="row align-items-center">
                <iframe src="https://calendar.google.com/calendar/embed?src=rungpairin.nut%40gmail.com&ctz=Asia%2FBangkok" style="border: 0" width="500" height="500" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>
    </div>

    <hr>

    <div class="reservation">
        <div class="row justify-content-center">
            <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1000px;">
            <strong>กรอกข้อมูลการจองคิว</strong>
                <div class="row mb-3" style="max-width: 500px; margin-left: 200px">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">ชื่อจองคิว</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="ชื่อจองคิว">
                        </div>
                </div>

                <div class="row mb-3" style="max-width: 500px; margin-left: 200px">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">เบอร์โทรศัพท์</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="เบอร์โทรศัพท์">
                        </div>
                </div>

                <div class="row mb-3" style="max-width: 500px; margin-left: 200px">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">เลือกพนักงาน</label>
                        <div class="col-sm-10">
                            <div class="col-auto">
                                <select class="form-select" id="autoSizingSelect">
                                    <option selected>เลือกพนักงาน...</option>
                                    <option value="1">ชื่อ: ...........</option>
                                    <option value="2">ชื่อ: ...........</option>
                                    <option value="3">ชื่อ: ...........</option>
                                </select>
                            </div>
                        </div>
                </div>

                <div class="row mb-3" style="max-width: 500px; margin-left: 200px">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">วันที่</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control form-control-sm" id="colFormLabelSm" placeholder="วันที่">
                        </div>
                </div>

                <div class="row mb-3" style="max-width: 500px; margin-left: 200px">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">เวลาจอง</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control form-control-sm" id="colFormLabelSm" placeholder="เวลาจอง">
                        </div>
                </div>

                <div class="row mb-3" style="max-width: 500px; margin-left: 200px">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">กลุ่มบริการ</label>
                        <div class="col-sm-10">
                            <div class="col-auto">
                                <select class="form-select" id="autoSizingSelect">
                                    <option selected>กลุ่มบริการ...</option>
                                    <option value="1">กลุ่มบริการ: ...........</option>
                                    <option value="2">กลุ่มบริการ: ...........</option>
                                    <option value="3">กลุ่มบริการ: ...........</option>
                                </select>
                            </div>
                        </div>
                </div>

                <div class="row mb-3" style="max-width: 500px; margin-left: 200px">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">บริการ</label>
                        <div class="col-sm-10">
                            <div class="col-auto">
                                <select class="form-select" id="autoSizingSelect">
                                    <option selected>บริการ...</option>
                                    <option value="1">บริการ: ...........</option>
                                    <option value="2">บริการ: ...........</option>
                                    <option value="3">บริการ: ...........</option>
                                </select>
                            </div>
                        </div>
                </div>

                <div style="font-size: 10px;">
                    <p class="red-text">*ในการจองแต่ละครั้งสามารถเลื่อนคิวได้ 1 ครั้งเท่านั้น</p>
                </div>

                <div class="modal-footer justify-content-center">
                    <a href="paymentuser.php" class="btn btn-success" role="button">ต่อไป</a>
                    <a href="home.php" class="btn btn-secondary" role="button">ยกเลิก</a>
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
