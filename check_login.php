<?php
    require("db_config.php");

    $form_username=$_POST['username'];
    $form_password=$_POST['password'];

    $user=mysqli_query($con,"SELECT username, password, level FROM user WHERE username='$form_username' AND password='$form_password'");


    list($db_username,$db_password,$level)=mysqli_fetch_row($user);

    if($db_username==$form_username AND $db_password==$form_password){

        $_SESSION['valid_login']=$db_username;
        $_SESSION['user_level']=$level;

        echo "<script>alert('ยินดีต้อนรับเข้าสู่ระบบ')</script>";
    }
    else{

        $_SESSION['valid_login']="";
        $_SESSION['user_level']="";

        echo "<script>alert('Username หรือ Password ไม่ถูกต้อง กรุณา login ใหม่')</script>";
    }

    header("Location:home.php");



?>