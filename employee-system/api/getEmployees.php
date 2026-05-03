<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");

	$file = "employees.json";

	if (!file_exists($file)) {
		echo json_encode([]);
		exit;
	}
	
	$data = file_get_contents($file);

	echo $data;
?>