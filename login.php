<?php
include("db_config.php");
$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!--Made with love by Mutiullah Samim -->
    <!--Bootstrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- Google Fonts - Prompt -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script type="text/javascript" src="index.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style type="text/css">
        body {
            font-family: 'Prompt', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Prompt', sans-serif;
        }
        p, .card-title, .card-text, .widget-item-shortdesc {
            font-family: 'Prompt', sans-serif;
        }
        html, body {
            background-image: url('https://getwallpapers.com/wallpaper/full/0/f/a/920042-pink-computer-wallpaper-2048x1280-for-samsung-galaxy.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            font-family: 'Numans', sans-serif;
        }
        .container {
            height: 100%;
            align-content: center;
        }
        .card {
            height: 550px;
            margin-top: 100px;
            margin-bottom: auto;
            width: 400px;
            background-color: #FFC2FE !important;
        }
        .social_icon span {
            font-size: 60px;
            margin-left: 10px;
            color: #FFC312;
        }
        .social_icon span:hover {
            color: white;
            cursor: pointer;
        }
        .card-header h3 {
            color: white;
        }
        .social_icon {
            position: absolute;
            right: 20px;
            top: -45px;
        }
        .input-group-prepend span {
            width: 50px;
            background-color: #EB40E8;
            color: black;
            border: 0 !important;
        }
        input:focus {
            outline: 0 0 0 0 !important;
            box-shadow: 0 0 0 0 !important;
        }
        .password1 a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .login {
            color: black;
            background-color: #CACFD2;
            max-width: fit-content;
            padding: 10px;
            border: none;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
        }
        .newmember {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        .newmember a {
            color: white;
            text-decoration: none;
            margin-left: 5px;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 10px 0;
            font-size: 15px;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid black;
        }
        .divider:not(:empty)::before {
            margin-right: .25em;
        }
        .divider:not(:empty)::after {
            margin-left: .25em;
        }
        .login-group {
            text-align: center;
            margin-bottom: 10px;
        }
        .login-button {
            background-color: white;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
        }
        .login-button a {
            text-decoration: none;
            color: black;
        }
        .login-button1 {
            background-color: white;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            width: 300px;
        }
        .login-button1 a {
            text-decoration: none;
            color: black;
        }
        .login-button1 i {
            margin-right: 5px;
        }
        .login-button:hover {
            background-color: #FDDDFD;
        }
        .links {
            color: white;
        }
        .links a {
            margin-left: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <span class="glyphicon glyphicon-lock"> </span>
                    <h3>เข้าสู่ระบบ</h3>
                </div>
                <div class="card-body">
                    <form name="formlogin" id="loginuser" action="api/checkuser.php" method="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="เบอร์โทรศัพท์">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน">
                        </div>
                        <div class="row align-items-center password1 justify-content-end">
                            <a href="your-link-here">ลืมรผัสผ่าน?</a>
                        </div>
                        <div class="login-group">
                            <button class="login-button login-group" type="submit">
                                เข้าสู่ระบบ
                            </button>
                        </div>
                        <div class="row align-items-center newmember justify-content-center">
                            ยังไม่มีบัญชีใช่ไหม?
                            <a href="newmember.php">สมัครสมาชิก</a>
                        </div>
                        <div class="divider">หรือเข้าสู่ระบบด้วยบัญชี</div>
                        <div class="login-group">
                            <button class="login-button1">
                                <i class="fas fa-envelope"></i>
                                <a href="your-page-url">เข้าสู่ระบบด้วยอีเมล</a>
                            </button>
                        </div>
                        <div class="login-group">
                            <button class="login-button1">
                                <i class="fas fa-mobile-alt"></i>
                                <a href="your-page-url">เข้าสู่ระบบด้วยเบอร์โทรศัพท์</a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
