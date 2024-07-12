<?php

	include("../db_config.php");

	$response = array();
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$sql = "SELECT * FROM user";
		$result = $db_con -> query($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$response['data'] = $data;

	}


	echo json_encode($response);

?>