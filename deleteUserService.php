<?php
	include './definitions.php';
	
	/**
	Delete User Service -- ADMIN ONLY
	**/

	$userID = $_POST['userID'];
	
	// delete foreign tables of user
	$result = mysqli_prepare($connectionDB, "DELETE FROM `favorites` WHERE userID = ?;");
	mysqli_stmt_bind_param($result, 'i', $userID);
	mysqli_stmt_execute($result);
	mysqli_stmt_close($result);
	
	// delete user data
	$result = mysqli_prepare($connectionDB, "DELETE FROM `users` WHERE ID = ?;");
	mysqli_stmt_bind_param($result, 'i', $userID);
	mysqli_stmt_execute($result);
	mysqli_stmt_close($result);
	
	mysqli_close($connectionDB);
	header("Location: $domain/admin.php");
?>

