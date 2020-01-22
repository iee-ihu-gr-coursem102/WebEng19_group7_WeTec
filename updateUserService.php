<?php
	include './definitions.php';
	
	/**
	Update User Service -- ADMIN ONLY
	**/

	$userID = $_POST['userID'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$birth = $_POST['birth'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$isAdmin = $_REQUEST['privileged'];
	$privileged = 0;
	if(!strcmp($isAdmin , "on"))
	  $privileged = 1;
	else
	  $privileged = 0;
	  
	if($password != null){
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$result = mysqli_prepare($connectionDB, "UPDATE `users` SET `privileged`=?,`name`=?,`surname`=?,`birth`=?,`email`=?,`password`=? WHERE `ID` = ?");
		mysqli_stmt_bind_param($result, 'isssssi', $privileged, $name, $surname, $birth, $email, $hashedPassword, $userID);
		mysqli_stmt_execute($result);
		mysqli_stmt_close($result);
	}else{
		$result = mysqli_prepare($connectionDB, "UPDATE `users` SET `privileged`=?,`name`=?,`surname`=?,`birth`=?,`email`=? WHERE `ID` = ?");
		mysqli_stmt_bind_param($result, 'issssi', $privileged, $name, $surname, $birth, $email, $userID);
		mysqli_stmt_execute($result);
		mysqli_stmt_close($result);
	}
	
	mysqli_close($connectionDB);
	header("Location: $domain/admin.php");
?>

