<?php
	include './definitions.php';
	
	/**
	Insert Job Service -- ADMIN ONLY
	**/

	$jobName = $_POST['jobName'];
	$minTemp = $_POST['minTemp'];
	$maxTemp = $_POST['maxTemp'];
	$minHumidity = $_POST['minHumidity'];
	$maxHumidity = $_POST['maxHumidity'];
	$minWindSpeed = $_POST['minWindSpeed'];
	$maxWindSpeed = $_POST['maxWindSpeed'];
	
	$result = mysqli_prepare($connectionDB, "INSERT INTO `jobs`(`jobName`, `minTemp`, `maxTemp`, `minHumidity`, `maxHumidity`, `minWindSpeed`, `maxWindSpeed`) VALUES (?, ?, ?, ?, ?, ?, ?);");
	mysqli_stmt_bind_param($result, 'sdddddd', $jobName, $minTemp, $maxTemp, $minHumidity, $maxHumidity, $minWindSpeed, $maxWindSpeed);
	mysqli_stmt_execute($result);
	mysqli_stmt_close($result);

	mysqli_close($connectionDB);
	header("Location: $domain/admin.php");
?>

