<?php
	include './definitions.php';
	session_start();
	/**
	Register Service
	**/
	
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	$birth = $_POST['birth'];
	
	$result = mysqli_prepare($connectionDB, "INSERT INTO `users`( `name`, `surname`, `birth`, `email`, `password`) VALUES (?, ?, ?, ?, ?);");
	mysqli_stmt_bind_param($result, 'sssss', $name , $surname , $birth, $email , $hashedPassword);
	mysqli_stmt_execute($result);
	if (mysqli_stmt_affected_rows($result) > 0) {
		session_start();
		$_SESSION['id'] = mysqli_insert_id($connectionDB); // get user ID for login flow
		$_SESSION['name'] = $name;
		$_SESSION['privileged'] = 0; // user by default is not privileged
		$_SESSION['done'] = "done";
		$_SESSION['start'] = time(); // Taking now logged in time.
		// Ending a session in 30 minutes from the starting time.
		// (30 * 60)
		$_SESSION['expire'] = $_SESSION['start'] + (2 * 30 * 60); //  1 hour
		header("Location: $domain/home.php");
	}else{
		// create error case if user exist or is problem with database connection
		
		$userID = "-1"; // default invalid value
		$result = mysqli_prepare($connectionDB, "SELECT ID FROM `users` WHERE email= ? ;"); // email is also unique key
		mysqli_stmt_bind_param($result, 's', $email);
		mysqli_stmt_execute($result);
		mysqli_stmt_bind_result($result, $userID);
		while(mysqli_stmt_fetch($result))
		{
			$userID = $userID;
		}
		mysqli_stmt_close($result);
		
		if (strcmp($userID, "-1") !== 0){
			$_SESSION['error'] = "User with email $email exists, try to login";
		}else{
			$_SESSION['error'] = "Something went wrong, try again later";
		}
		
		header("Location: $domain/index.php");
	}
	mysqli_stmt_close($result);
	mysqli_close($connectionDB);
?>

