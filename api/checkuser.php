<?php
    session_start();
    include("../db_config.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Query to check if the user exists
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row && password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            // Respond with success
            echo json_encode(['status' => 'ok']);
        } else {
            // If login fails, respond with error
            echo json_encode(['status' => 'error', 'message' => 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง']);
        }
    } else {
        // If the request method is not POST, respond with error
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    }
    
?>


