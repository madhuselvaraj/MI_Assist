<?php
	//initialize session
	session_start();
	
	//removes all session data and destroy it
	session_unset();
	session_destroy();
	
	header('Location: index.html');
?>