<?php
	include './definitions.php';
	
	/**
	Login Service
	**/
	
	session_start();
	$email = $_POST['email'];
	$password = $_POST['password'];
	$hashedPassword = "";
	$userID = "-1"; // default invalid value
	$name = "";
	$privileged = 0;
	$result = mysqli_prepare($connectionDB, "SELECT ID, name, privileged, password FROM `users` WHERE email= ? ;"); // email is also unique key
	mysqli_stmt_bind_param($result, 's', $email);
	mysqli_stmt_execute($result);
	mysqli_stmt_bind_result($result, $userID, $name, $privileged, $hashedPassword);
	while(mysqli_stmt_fetch($result))
	{
		$userID = $userID;
		$name = $name;
		$privileged = $privileged;
		$hashedPassword = $hashedPassword;
	}
	mysqli_stmt_close($result);

	if (strcmp($userID, "-1") !== 0 && password_verify($password, $hashedPassword)){
	  $_SESSION['id'] = $userID;
	  $_SESSION['name'] = $name;
	  $_SESSION['privileged'] = $privileged;
	  $_SESSION['done'] = "done";
	  $_SESSION['start'] = time(); // Taking now logged in time.
	  // Ending a session in 30 minutes from the starting time.
	  // (30 * 60)
	  $_SESSION['expire'] = $_SESSION['start'] + (2 * 30 * 60); //  1 hour
	  header("Location: $domain/home.php");
	}else{
		$_SESSION['error'] = "Invalid credentials, try again";
		header("Location: $domain/index.php");
	}
	mysqli_close($connectionDB);
?>

