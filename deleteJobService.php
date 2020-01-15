<?php
	include './definitions.php';
	
	/**
	Delete Job Service -- ADMIN ONLY
	**/

	$jobID = $_POST['jobID'];
	$result = mysqli_prepare($connectionDB, "DELETE FROM `jobs` WHERE ID = ?;");
	mysqli_stmt_bind_param($result, 'i', $jobID);
	mysqli_stmt_execute($result);
	mysqli_stmt_close($result);
	mysqli_close($connectionDB);
	header("Location: $domain/admin.php");
?>

