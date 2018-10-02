<?php
	//include parent file
	include "Database/Database.php";
	
	session_start();
	error_reporting(0);
	
	class UserInfo{
		
		//define variables
		public $db_name;
		public $table_name = "user_info";
		
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

		//function to insert user information
		public function insert_userinfo($user_name,$password){
			
			//sql
			$sql = "INSERT INTO ".$this->table_name."(`user_id`, `user_name`, `user_password`) VALUES ('','".$user_name."',MD5('".$password."'))";
			//runs query
			$query = $this->connect_database->run_sql_query($sql);
			return $query;				
		}
		
		//function to valid user sign in
		public function valid_user_sign_in($user_name,$user_password){
			
			//sql query to select username and user password
			$sql = "SELECT user_id,user_name, user_password FROM ".$this->table_name ." WHERE user_name ='".$user_name."' AND user_password = MD5('".$user_password."')";
			
			//fetching data
			$query = $this->connect_database->run_sql_query($sql);
			$result = $this->connect_database->fetch_data($query);
			//validation
			if($result){
				
				//validate username
				/*if($user_name == $result['user_name']){
					
					//validate password
					if($user_password == $result['user_password']){
					*/	
						//define username and user_id in session
						$output = array(1,"successfully logged in");
						$_SESSION["user_name"]= $user_name; 						
						$_SESSION["user_id"]= $result['user_id']; 						
						
					/*}else{
						$output = array(0,"invalid password");
					}
				}else{
					$output = array(0,"invalid username");
				}*/
			}else{
				//returns if the user name or password is invalid
				$output = array(0,"invalid username and password");				
			}
			return $output;
		}
	}
	
?>