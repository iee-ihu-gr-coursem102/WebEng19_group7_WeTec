<?php
	include './definitions.php';
	
	/**
	Delete Favorite Service
	**/

	$favoriteID = $_POST['favoriteID'];
	$result = mysqli_prepare($connectionDB, "DELETE FROM `favorites` WHERE ID = ?;");
	mysqli_stmt_bind_param($result, 'i', $favoriteID);
	mysqli_stmt_execute($result);
	mysqli_stmt_close($result);
	mysqli_close($connectionDB);
	header("Location: $domain/home.php");
?>

