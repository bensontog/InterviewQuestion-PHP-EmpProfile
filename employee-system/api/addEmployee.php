<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");

	$data = json_decode(file_get_contents("php://input"), true);

	if (
		empty($data['name']) ||
		empty($data['gender']) ||
		empty($data['maritalStatus']) ||
		empty($data['phone']) ||
		empty($data['email']) ||
		empty($data['address']) ||
		empty($data['dob']) ||
		empty($data['nationality']) ||
		empty($data['hireDate']) ||
		empty($data['department'])
	) {
		echo json_encode([
			"success" => false,
			"message" => "All fields are required"
		]);
		exit;
	}

	if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
		echo json_encode([
			"success" => false,
			"message" => "Invalid email format"
		]);
		exit;
	}

	if (!preg_match("/^\d{10,15}$/", $data['phone'])) {
		echo json_encode([
			"success" => false,
			"message" => "Invalid phone number"
		]);
		exit;
	}

	$file = "employees.json";

	$employees = file_exists($file)
	? json_decode(file_get_contents($file), true)
    : [];

	$employees[] = $data;

	file_put_contents($file, json_encode($employees, JSON_PRETTY_PRINT));

	echo json_encode([
		"success" => true,
		"message" => "Employee added successfully"
	]);
?>