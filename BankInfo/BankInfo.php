<?php
	//include parent file
	include "Database/Database.php";
	
	class BankInfo{
		
		//define variables
		public $db_name;
		public $table_name = "bank_info";
		
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
	
		//function to insert user's bank info
		public function insert_bankinfo($bank_name){
			
			//check if the bank info is already exist
			$check_bank_exixt = $this->check_bank_exist($bank_name);
			
			//executed if it doesn't exists
			if($check_bank_exixt){
				
				//sql
				$sql = "INSERT INTO ".$this->table_name ."(`bank_id`, `bank_name`) VALUES ('','".$bank_name."')";
				//run query
				$query = $this->connect_database->run_sql_query($sql);
			}
			//retrieving bank_id
			$result = $this->get_bank_id($bank_name);
			
			//returns if bank_id exists
			if($result){
				return $result;
			}else{
				return false;
			}			
		}
		
		//function to retrieve bank_id
		public function get_bank_id($bank_name){
			
			//sql
			$sql = "SELECT `bank_id` FROM ".$this->table_name ." WHERE `bank_name` = '".$bank_name."'";
			//run query
			$query = $this->connect_database->run_sql_query($sql);
			//fetch data
			$result = $this->connect_database->fetch_data($query);
			return $result;	
		}
		
		//function to check whether bank exists
		public function check_bank_exist($bank_name){
			
			//sql
			$sql = "select * from ".$this->table_name ." where bank_name = '".$bank_name."'";
			//run query
			$query = $this->connect_database->run_sql_query($sql);
			
			//returns true if bank exists or else false
			if(mysqli_num_rows($query)){
				
				return false;
			}else{
				return true;
			}
		}
	}
?>