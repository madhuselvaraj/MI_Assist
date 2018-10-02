<?php
	//include parent file
	include 'UserInfo/UserInfo.php';
	
	//define POST data
	$user_name = $_POST['username'];
	$password = $_POST['password'];
	
	//initialize database
	$dashboard = new UserInfo();
	//calling validate_user_signin() to validete user sign in
	$valid_user = $dashboard->valid_user_sign_in($user_name,$password);
	
	//valids the user
	if($valid_user[0]){	
	
		header('Location: dashboard.php');
	}else{		
		header('Location: index.html');
	}
?>