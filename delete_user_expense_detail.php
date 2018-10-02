<?php
	//include parent file
	include "UserExpense/UserExpense.php";
	
	//defining input
	$input = $_POST['e_no'];

	//initializing database
	$delete_expense = new UserExpense();
	
	//calling add_user_bank_detail() function to add bank details
	$result = $delete_expense->delete_user_expense_detail($input);
	
	if($result){
		
		header('Location: list_expense_details.php');
			
	}else{
		header('Location: list_expense_details.php');
	}
?>