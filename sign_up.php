<?php
	//include parent file
	include 'UserInfo/UserInfo.php';
	
	//define POST data
	$user_name = $_POST['user_name'];
	$user_password = $_POST['user_password'];
	
	//initialize database
	$sign_up = new UserInfo();
	
	//calling function to insert a new user info
	$output = $sign_up->insert_userinfo($user_name,$user_password);
		
	//returns true if user details are inserted successfully
	if($output){
		header('Location: index.html');
	}else{
		header('Location: sign_up.html');
	}
?>