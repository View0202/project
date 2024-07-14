<?php
session_start();
include("../db_config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $sql = "SELECT * FROM user WHERE phone = ? AND password = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(1, $phone);
    $stmt->bindParam(2, $password);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Set session variables
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        // Respond with success
        echo json_encode(['success' => true]);
    } else {
        // If login fails, respond with error
        echo json_encode(['success' => false, 'message' => 'เบอร์โทรศัพท์หรือรหัสผ่านไม่ถูกต้อง']);
    }
} else {
    // If the request method is not POST, respond with error
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
