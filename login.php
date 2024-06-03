<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<!--Made with love by Mutiullah Samim -->
		<!--Bootsrap 4 CDN-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!--Fontawesome CDN-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<!--Custom styles-->
		<link rel="stylesheet" type="text/css" href="styles.css">
		<style type="text/css">
			/* Made with love by Mutiullah Samim*/
		@import url('https://fonts.googleapis.com/css?family=Numans');
		html,body{
		background-image: url('https://getwallpapers.com/wallpaper/full/0/f/a/920042-pink-computer-wallpaper-2048x1280-for-samsung-galaxy.jpg');
		background-size: cover;
		background-repeat: no-repeat;
		height: 100%;
		font-family: 'Numans', sans-serif;
		}
		.container{
		height: 100%;
		align-content: center;
		}
		.card{
		height: 550px;
		margin-top: 100px;
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
						<h3>Login</h3>
					</div>
					
					<div class="card-body">
						<form ame="formlogin" action="chklogin.php" method="POST" id="login" class="form-horizontal">
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" name="username" class="form-control" placeholder="อีเมล / เบอร์โทรศัพท์">
								
							</div>
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" name="password" class="form-control" placeholder="รหัสผ่าน">
							</div>

							<div class="row align-items-center password1 justify-content-end">
								<a href="your-link-here">ลืมรผัสผ่าน?</a>
							</div>

							<div class="login-group">
								<button class="login-button login-group">
    								<a href="your-page-url">เข้าสู่ระบบ</a>
								</button>
							</div>

							<div class="row align-items-center newmember justify-content-center">
								ยังไม่มีบัญชีใช่ไหม?
								<a href="your-link-here">สมัครสมาชิก</a>
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