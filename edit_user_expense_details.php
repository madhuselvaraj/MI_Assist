<?php
	//include parent file
	include "UserExpense/UserExpense.php";
	
	//defining input
	$input = $_POST;

	//initializing database
	$edit_expense = new UserExpense();
	
	//calling add_user_bank_detail() function to add bank details
	$result = $edit_expense->edit_user_expense_details($input);
	
	if($result){
		
		header('Location: list_expense_details.php');
			
	}else{
		header('Location: list_expense_details.php');
	}
?>
