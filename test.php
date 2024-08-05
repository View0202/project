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

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="index.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Inline Styles for Font Family -->
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Prompt', sans-serif;
        }

        p, .card-title, .card-text, .widget-item-shortdesc {
            font-family: 'Prompt', sans-serif;
        }

        /* Responsive styles */
        .container1 {
            max-width: 100%;
            margin: 0 auto;
            display: flex;
        }

        .card {
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
        }

        .img-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        #displayImage {
            max-width: 100%;
            height: auto;
        }

        #formFile {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .estimate {
            padding: 20px 0;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-container {
            background-color: #f8f9fa;
        }

        footer {
            padding: 10px 0;
            text-align: center;
            width: 100%;
        }

    </style>
    
</head>
<body>

<!-- Main Container -->
<div class="container1">
    <!-- Header -->
    <header id="header" class="py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="index.html">
                    <img src="images/logo.png" alt="Mira Comprehensive Beauty Center" style="height: 60px;">
                </a>
            </div>
            <nav class="navbar navbar-expand-md">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="profile.php">ข้อมูลส่วนตัว</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="logoutuser()">ออกจากระบบ</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid justify-content-center">
            <ul class="navbar-nav">
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
    </nav>

    <!-- Estimate Section -->
    <div class="estimate">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="border border-secondary bg-white rounded-3 shadow-lg p-4">
                    <strong class="d-block text-center mb-4">ประเมินใบหน้า</strong>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="img-container">
                                    <img id="displayImage" src="images/haman.png" class="card-img-top" alt="Face">
                                </div>
                                <div class="mb-3 mt-4">
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="textarea1" class="form-label">รายละเอียด</label>
                                <textarea class="form-control" id="textarea1" rows="6"></textarea>
                            </div> 

                            <button type="submit" class="btn btn-warning w-100" onclick="saveestimate()">
                                ส่งประเมินใบหน้า
                            </button> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <hr>

    <!-- Footer -->
    <div class="footer-container">
        <footer id="footer" class="py-3">
            <nav class="navbar navbar-light">
                <div class="container-fluid justify-content-center">
                    <a class="navbar-brand" href="login.php">
                        Copyright 2024 © Mira One Stop Services Beauty Center
                    </a>
                </div>
            </nav>
        </footer>
    </div>
</div>

</body>
</html>
