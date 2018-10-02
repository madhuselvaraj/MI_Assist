<?php
	
	//include parent file
	include "UserExpense/UserExpense.php";
	
	//defining input
	$input = $_POST;

	//initializing database
	$add_expense = new UserExpense();
	
	//calling add_user_bank_detail() function to add bank details
	$result = $add_expense->add_user_expense_details($input);
	
	if($result){
		
		header('Location: list_expense_details.php');
			
	}else{
		header('Location: list_expense_details.php');
	}
?>
