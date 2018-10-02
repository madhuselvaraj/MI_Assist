<?php
	//include parent file
	include "BankAccountDetail/BankAccountDetail.php";
	
	//defining input
	$input = $_POST;
	
	//initializing database
	$edit_bank_detail = new BankAccountDetail();
	
	//calling function to edit user bank details
	$output = $edit_bank_detail->edit_user_bank_detail($input);
	
	header('Location: list_bank_details.php');
		
?>