<?php
	//include parent file
	include "Database/Database.php";
		
	error_reporting(0);
	session_start();
	
	class UserExpense{
		
		//define variables
		public $db_name;
		public $table_name = "user_expenses";
		
		//constructor
		function __construct(){
			
			//define database name 
			$this-> db_name = "mi_assist";
			//initislize database
			$this->connect_database = new Database();
			
			//returns true if the database is connected or else false
			if($this->connect_database){
				
				$this->connect_database->db_connection($this-> db_name);
			}
		}
		
		//function to retrieve user expense details
		public function get_user_expense_details(){
			
			//sql
			$sql = "select * from user_expenses where user_id = '".$_SESSION['user_id']."'";
			//runs query
			$query = $this->connect_database->run_sql_query($sql);
			//fetches data
			$result = $this->connect_database->fetch_data_array($query);
				
			//returns data if true
			if($result){
				return $result;
			}else{
				return false;
			}
		}
		
		//function to add user expense details
		public function add_user_expense_details($input){
			
			//define input
			$expense_detail = $input['expense_detail'];
			$e_date = $input['e_date'];
			$paid_status = $input['paid_status'];
			$amount = $input['amount'];	
			
			//sql
			$sql = "INSERT INTO ".$this->table_name."(`e_no`, `user_id`, `expense_detail`, `e_date`, `paid_status_id`, `expense_amount`) VALUES ('','".$_SESSION["user_id"]."','".$expense_detail."','".$e_date."','".$paid_status."','".$amount."')";			
			//runs query
			$query = $this->connect_database->run_sql_query($sql);
			
			//returns true if query is executed sucessfully
			if($query){				
				return true;				
			}else{				
				return false;
			}				
		}
		
		//function to edit user expense details
		public function edit_user_expense_details($input){
			
			//define variables from input
			$expense_detail = $input['expense_detail'];
			$e_date = $input['e_date'];
			$expense_amount = $input['expense_amount'];
			$paid_status = $input['paid_status'];
			$e_no = $input['e_no'];
			
			//sql
			$sql = "update ". $this->table_name ." set expense_detail ='".$expense_detail."',e_date = '".$e_date."',paid_status_id ='".$paid_status."',expense_amount ='".$expense_amount."' where e_no = '".$e_no."'";
			//runs query
			$query = $this->connect_database->run_sql_query($sql);
				
			//returns true if query is executed sucessfully
			if($result){
				return true;
			}else{
				return false;
			}
		}
		
		//function to delete user expense detail
		public function delete_user_expense_detail($e_no){
			
			//sql
			$sql = "delete from ". $this->table_name ." where e_no = '".$e_no."'";
			//runs query
			$query = $this->connect_database->run_sql_query($sql);
			
			//returns true if query executes.
			if($query){				
				return true;				
			}else{				
				return false;
			}
		}
	}
?>