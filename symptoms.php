<!DOCTYPE html>
<html>
<head>
	<title>Disorder Symptoms</title>
</head>
<body>
	<h1>Disorder Symptoms</h1>

	<?php
	// Connect to the database
	$db = new mysqli('localhost', 'root', '', 'health_db');
	if ($db->connect_error) {
		die('Connection failed: ' . $db->connect_error);
	}

	// Check if a disorder was selected
	if (isset($_POST['disorder'])) {
		// Sanitize the input
		$disorder_id = intval($_POST['disorder']);

		// Query the database for symptom names
		$sql = "SELECT Symptom.name FROM Symptom
				INNER JOIN Feature ON Symptom.Symptom_id = Feature.Symptom_id
				WHERE Feature.disorder_id = $disorder_id";
		$result = $db->query($sql);

		// Display the symptom names
		if ($result->num_rows > 0) {
			echo '<h2>Symptoms:</h2>';
			while ($row = $result->fetch_assoc()) {
				echo '<p>' . $row['name'] . '</p>';
			}
		} else {
			echo '<p>No symptoms found.</p>';
		}
	}

	// Close the database connection
	$db->close();
	?>
</body>
</html>
