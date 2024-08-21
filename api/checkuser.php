<?php
session_start();
include("../db_config.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        // Check if the password is correct
        $hashed_password = $row['password'];
        if ($password==$hashed_password) {
            // Set session variables
            $_SESSION['login'] = 'yes';
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['customer_id'] = $row['customer_id'];
            $_SESSION['email'] = $row['email'];
            // Respond with success
            echo json_encode(['status' => 'ok']);
            header("Location: ../home.php");
            exit();
        } else {
            // If password is incorrect
            echo json_encode(['status' => 'error', 'message' => 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง']);
        }
    } else {
        // If email is not found
        echo json_encode(['status' => 'error', 'message' => 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง']);
    }
?>