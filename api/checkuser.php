<?php
session_start();
include("../db_config.php");

$username = $_POST['username'];
$password = $_POST['password'];

// Query to check if the user exists
$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $db_con->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data) {
    // Check if the password is correct
    $hashed_password = $data['password'];
    if ($password==$hashed_password) {
        // Set session variables
        $_SESSION['login'] = 'yes';
        $_SESSION['u_id'] = $data['u_id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION["user_status"] = $data['status']; // เก็บสถานะผู้ใช้ใน session

        // Respond with success
        echo json_encode(['status' => 'ok']);
        header("Location: ../home.php");
        exit();
    } else {
        // If password is incorrect
        echo json_encode(['status' => 'error', 'message' => 'รหัสผ่านไม่ถูกต้อง']);
    }
} else {
    // If username is not found
    echo json_encode(['status' => 'error', 'message' => 'ชื่อผู้ใช้ไม่ถูกต้อง']);
}
?>
