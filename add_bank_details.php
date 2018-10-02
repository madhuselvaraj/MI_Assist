<?php
	//include parent file
	include "BankAccountDetail/BankAccountDetail.php";
	
	//defining input
	$input = $_POST;
	
	//initializing database
	$add_bank_detail = new BankAccountDetail();
	
	//calling add_user_bank_detail() function to add bank details
	$result = $add_bank_detail->add_user_bank_detail($input);
	
	if($result){
		
		header('Location: list_bank_details.php');
			
	}else{
		header('Location: list_bank_details.php');
	}
?>