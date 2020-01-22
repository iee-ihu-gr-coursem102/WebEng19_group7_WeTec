<?php
	// Turn off all error reporting
	error_reporting(0);
	/** Enable Error Debug
	//Error Handling
	error_reporting(9999999);
	ini_set('display_errors', 1);
	**/
	require( './databaseCredentials.php' );
	/**
		Definitions for all files
	**/
	
	$domain = "https://nireas.it.teithe.gr/webeng19g7";
	
	/**
	Database initialization
	**/
	$connectionDB = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);
	mysqli_query($connectionDB, "SET NAMES 'utf8'");
	mysqli_query($connectionDB, "SET CHARACTER SET 'utf8'");
	mysqli_query($connectionDB, "set character_set_client=utf8");
	mysqli_query($connectionDB, "set character_set_connection=utf8");
	mysqli_query($connectionDB, "set collation_connection=utf8");
	mysqli_query($connectionDB, "set character_set_results=utf8");
	
?>
