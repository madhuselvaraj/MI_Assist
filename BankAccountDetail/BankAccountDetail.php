<?php
	
	//include parent file.
	include "BankInfo/BankInfo.php";
	
	error_reporting(0);
	//initialize session
	session_start();
	
	class BankAccountDetail{
		
		//define variables
		public $db_name;
		public $table_name = "bank_account_details";
		
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
			
			//initialize database
			$this->bank_info = new BankInfo();
		}
		
		//function to add bank details
		public function add_user_bank_detail($input){
			
			//define input
			$bank_name = $input['bank_name'];
			$amount = $input['amount'];
			
			//inserting user's bank details and retrieve its id
			$get_bank_id = $this->bank_info->insert_bankinfo($bank_name);			
			
			//define bank id from array
			$bank_id = $get_bank_id["bank_id"];
			
			//sql
			$sql = "INSERT INTO ".$this->table_name."(`s_no`,`user_id`, `bank_id`, `current_amount`,`date_updated`) VALUES ('','".$_SESSION["user_id"]."','".$bank_id."','".$amount."',CURRENT_TIMESTAMP())";
			
			//run query
			$query = $this->connect_database->run_sql_query($sql);
			
			//returns true if the query is executed successfully
			if($query){				
				return true;				
			}else{				
				return false;
			}				
		}
		
		//function to retrieve user bank details
		public function get_user_bank_details(){
			
			//sql
			$sql = "SELECT current_amount,bank_name,bank_info.bank_id FROM bank_info,".$this->table_name ." WHERE bank_info.bank_id = ".$this->table_name . ".bank_id AND user_id = '". $_SESSION['user_id'] ."'";
			
			//run query
			$query = $this->connect_database->run_sql_query($sql);
			
			//fetch data 
			$result = $this->connect_database->fetch_data_array($query);
				
			//returns data if true
			if($result){
				return $result;
			}else{
				return false;
			}
		}
		
		//function to edit user's bank details
		public function edit_user_bank_detail($input){
			
			//define input
			$bank_id = $input['bank_id'];
			$amount = $input['amount'];
			
			//sql
			$sql = "update ".$this->table_name ." set current_amount ='".$amount."' where bank_id = '".$bank_id."'";
			
			//run query
			$query = $this->connect_database->run_sql_query($sql);
			
			//returns true if the query is executed successfully
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>