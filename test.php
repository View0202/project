<?php
    session_start();
	include("db_config.php");
	// $id = $_GET['id'];
	$sql = "SELECT * FROM customer WHERE customer_id = 0000000197";

	$stmt = $db_con -> prepare($sql);
	$stmt -> bindParam(1, $id);
	$stmt -> execute();

	$row = $stmt -> fetch();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mira Comprehensive Beauty Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2>Customer IDs</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Customer ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // แสดงข้อมูลแต่ละแถว
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["customer_id"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='1'>No results found</td></tr>";
            }
            // ปิดการเชื่อมต่อ
    echo json_encode($response);
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
