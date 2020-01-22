<?php
	include './definitions.php';
	
	/**
	Update Job Service -- ADMIN ONLY
	**/

	$ID = $_POST['jobID'];
	$jobName = $_POST['jobName'];
	$minTemp = $_POST['minTemp'];
	$maxTemp = $_POST['maxTemp'];
	$minHumidity = $_POST['minHumidity'];
	$maxHumidity = $_POST['maxHumidity'];
	$minWindSpeed = $_POST['minWindSpeed'];
	$maxWindSpeed = $_POST['maxWindSpeed'];
	
	$result = mysqli_prepare($connectionDB, "UPDATE `jobs` SET `jobName`= ?,`minTemp`= ?,`maxTemp`= ?,`minHumidity`=?,`maxHumidity`= ?,`minWindSpeed`= ?,`maxWindSpeed`= ? WHERE `ID`= ?");
	mysqli_stmt_bind_param($result, 'sddddddi', $jobName, $minTemp, $maxTemp, $minHumidity, $maxHumidity, $minWindSpeed, $maxWindSpeed, $ID);
	mysqli_stmt_execute($result);
	mysqli_stmt_close($result);

	mysqli_close($connectionDB);
	header("Location: $domain/admin.php");
?>

