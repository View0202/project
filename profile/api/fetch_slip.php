<?php
    include("../../db_config.php");

    if (isset($_POST['customer_id'])) {
        $customer_id = $_POST['customer_id'];
        
        $stmt = $db_con->prepare("SELECT slip FROM queue WHERE customer_id = :customer_id LIMIT 1");
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row && !empty($row['slip'])) {
            // Return the slip image path
            echo json_encode(['slip' => $row['slip']]);
        } else {
            // No slip found or empty
            echo json_encode(['error' => 'No slip found']);
        }
    } else {
        echo json_encode(['error' => 'Customer ID not provided']);
    }
