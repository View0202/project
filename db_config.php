<?php

	$db_name = "project";
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$port = 3307;

	try {
		$db_con = new PDO("mysql:host={$db_host}; dbname={$db_name}; port={$port}", $db_user, $db_pass);
		$db_con -> exec("set names utf8");
		$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e -> getMessage();
	}

?>