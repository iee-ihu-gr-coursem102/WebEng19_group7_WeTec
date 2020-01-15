<?php
	include './definitions.php';
	
	/**
	Add Favorite Service
	**/
	
	$userID = $_POST['userID'];
	$keyword = $_POST['keyword'];
	$weatherDateTime = $_POST['weatherDateTime'];
	$minTemp = $_POST['minTemp'];
	$maxTemp = $_POST['maxTemp'];
	$pressure = $_POST['pressure'];
	$humidity = $_POST['humidity'];
	$icon = $_POST['icon'];
	$weatherDescription = $_POST['weatherDescription'];
	$windSpeed = $_POST['windSpeed'];

	$result = mysqli_prepare($connectionDB, "INSERT INTO `favorites`(`userID`,`keyword`, `weatherDateTime`, `minTemp`, `maxTemp`, `pressure`, `humidity`, `icon`, `weatherDescription`, `windSpeed`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
	mysqli_stmt_bind_param($result, 'issddddssd', $userID , $keyword , $weatherDateTime, $minTemp, $maxTemp, $pressure, $humidity,$icon, $weatherDescription,$windSpeed);
	mysqli_stmt_execute($result);
	mysqli_stmt_close($result);
	mysqli_close($connectionDB);
	header("Location: $domain/home.php");
?>

