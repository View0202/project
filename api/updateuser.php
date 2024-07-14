<?php
    include("../db_config.php");

    $response = array();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $username = $_POST['username'];
        $surname = $_POST['surname'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_cf = $_POST['password_cf'];
        $id = $_POST['id'];

        $sql = "UPDATE user SET username=?, surname=?, age=?, phone=?, email=?, password=?, password_cf=? WHERE id=?";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $surname);
        $stmt->bindParam(3, $age);
        $stmt->bindParam(4, $phone);
        $stmt->bindParam(5, $email);
        $stmt->bindParam(6, $password);
        $stmt->bindParam(7, $password_cf);
        $stmt->bindParam(8, $id);

        $result = $stmt->execute();

        if ($result) {
            $response['status'] = 'ok';
        } else {
            $response['status'] = 'error';
        }

    } else {
        $response['status'] = 'no-request';
    }

    echo json_encode($response);
?>
