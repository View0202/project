<?php
    session_start();
    include("db_config.php");
?>


<!DOCTYPE html>
<html>
	<head>
		<title>New member</title>
		
		<!--Bootsrap 4 CDN-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		
		<!--Fontawesome CDN-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		
		<!--Custom styles-->
		<link rel="stylesheet" type="text/css" href="styles.css">

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

		<script type="text/javascript">
			$(document).ready(function() {
				$('#login').data();
			});
		</script>

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

		html,body{
		background-image: url('https://getwallpapers.com/wallpaper/full/0/f/a/920042-pink-computer-wallpaper-2048x1280-for-samsung-galaxy.jpg');
		background-size: cover;
		background-repeat: no-repeat;
		height: 100%;
		}
		.container{
		height: 100%;
		align-content: center;
		}
		.card{
		height: 570px;
		margin-top: 80px;
		margin-bottom: auto;
		width: 400px;
		background-color: #FFC2FE  !important;
		}
		.social_icon span{
		font-size: 60px;
		margin-left: 10px;
		color: #FFC312;
		}
		.social_icon span:hover{
		color: white;
		cursor: pointer;
		}
		.card-header h3{
		color: white;
		}
		.social_icon{
		position: absolute;
		right: 20px;
		top: -45px;
		}
		.input-group-prepend span{
		width: 50px;
		background-color: #EB40E8 ;
		color: black;
		border:0 !important;
		}
		input:focus{
		outline: 0 0 0 0  !important;
		box-shadow: 0 0 0 0 !important;
		}
		.password1 a {
            color: white; /* เปลี่ยนสีข้อความเป็นสีขาว */
            text-decoration: white; /* เอาเส้นใต้ลิงก์ออก */
            padding: 5px 10px; /* เพิ่ม padding เพื่อความสวยงาม */
            border-radius: 5px; /* เพิ่มการโค้งมนของขอบ */
            transition: background-color 0.3s ease; /* เพิ่มการเปลี่ยนสีพื้นหลังแบบนุ่มนวล */
        }
		.login {
            color: black;
            background-color: #CACFD2;
            max-width: fit-content;
            padding: 10px; /* เพิ่ม padding เพื่อความสวยงาม */
            border: none; /* เพิ่ม border ให้กับปุ่ม */
            border-radius: 5px; /* เพิ่มการโค้งมนของขอบ */
            display: block; /* ทำให้ปุ่มเป็น block element เพื่อให้ margin ทำงาน */
            margin: 0 auto; /* จัดปุ่มให้ตรงกลางในแนวนอน */
        }
		.newmember {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .newmember a {
            color: white; /* เปลี่ยนสีข้อความของลิงก์ตามที่ต้องการ */
            text-decoration: none; /* เอาเส้นใต้ลิงก์ออก */
            margin-left: 5px; /* เว้นระยะห่าง 5 พิกเซลจากข้อความก่อนหน้า */
            padding: 5px 10px; /* เพิ่ม padding เพื่อความสวยงาม */
            border-radius: 5px; /* เพิ่มการโค้งมนของขอบ */
            transition: background-color 0.3s ease; /* เพิ่มการเปลี่ยนสีพื้นหลังแบบนุ่มนวล */
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
			text-align: center; /* จัดให้ปุ่มอยู่ตรงกลางในแนวนอน */
			margin-bottom: 10px; /* เพิ่มระยะห่างระหว่างปุ่ม */
		}
		.login-button {
			background-color: white;
			color: black; /* เปลี่ยนสีข้อความเป็นสีดำ */
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			text-decoration: none;
			cursor: pointer;
			transition: background-color 0.3s ease;
			display: inline-block; /* ให้ปุ่มอยู่ในบรรทัดเดียวกับข้อความ */
		}
		.login-button a {
			text-decoration: none; /* เอาเส้นใต้ออก */
			color: black; /* เปลี่ยนสีข้อความเป็นสีดำ */
		}
		.login-button1 {
			background-color: white;
			color: black; /* เปลี่ยนสีข้อความเป็นสีดำ */
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			text-decoration: none;
			cursor: pointer;
			transition: background-color 0.3s ease;
			display: inline-block; /* ให้ปุ่มอยู่ในบรรทัดเดียวกับข้อความ */
			width: 300px;
		}
		.login-button1 a {
			text-decoration: none; /* เอาเส้นใต้ออก */
			color: black; /* เปลี่ยนสีข้อความเป็นสีดำ */
		}
		.login-button1 i {
			margin-right: 5px; /* เพิ่มระยะห่างระหว่างไอคอนและข้อความ */
		}
		.login-button:hover {
			background-color: #FDDDFD;
		}
		.links{
		color: white;
		}
		.links a{
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
						<h3>สมัครสมาชิก</h3>
					</div>
					
					<div class="card-body">
						<form method="POST" id="login" class="form-horizontal">
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" id="firstname" name="firstname" class="form-control" placeholder="ชื่อ">
							</div>

                            <div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" id="lastname" name="lastname" class="form-control" placeholder="นามสกุล">
							</div>

							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" id="username" name="username" class="form-control" placeholder="ชื่อผู้ใช้">
							</div>

                            <div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-envelope"></i></span>
								</div>
								<input type="text" id="email" name="email" class="form-control" placeholder="อีเมล์">
							</div>

                            <div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone"></i></span>
								</div>
								<input type="number" id="phone" name="phone" class="form-control" placeholder="เบอร์โทรศัพท์">
							</div>

                            <div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
								</div>
								<input type="date" id="age" name="age" class="form-control" placeholder="อายุ">
							</div>
                            
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน">
							</div>

                            <div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" id="password_cf" name="password_cf" class="form-control" placeholder="ยืนยันรหัสผ่าน">
							</div>

							<div class="login-group">
								<button class="login-button login-group" type="submit" value="สมัครสมาชิก" onclick="savecustomer()">
									สมัครสมาชิก
								</button>
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>