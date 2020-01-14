<?php
	include './definitions.php';
	
	/**
	Logout Service
	**/
	
    /*
     * session_start();
     * Starting a new session before clearing it
     * assures you all $_SESSION vars are cleared
     * correctly, but it's not strictly necessary.
     */
    session_start();
    $_SESSION['done'] = "not";
    session_destroy();
    session_unset();
    header("Location: $domain/index.php");
?>
