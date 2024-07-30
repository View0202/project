<?php
session_start();
include("../db_config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $sql = "SELECT * FROM customer WHERE email = ? AND password = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $password);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
} else {
    // If the request method is not POST, respond with error
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>


