<?php
	class Database{
		
		//define variables
		public $conn;
		public $ar_error = array();
		
		//constructor
		function __construct(){
			
			//connect localhost phpmyadmin
			$this->conn=mysqli_connect('localhost','root','');			
		}
		
		//function to connect database
		public function db_connection($db_name){
			
			//conncting database
			$db_connect = mysqli_select_db($this->conn,$db_name);
			
			//returns true if the connection established or else returns an error message 
			if($db_connect){
				
				return true;				
			}else{
				return $this->ar_error =  "Error: " ."<br>" . mysqli_error($this->conn);
			}
		}
		
		//function to data and returns array of data
		public function fetch_data_array($query){	
			
			//checks for number of rows is greater than 0	
			if(mysqli_num_rows($query) > 0){
				
				//fetch data
				for($i = 0;$i < (mysqli_num_rows($query));$i++){
					
					$fetch_array[] = mysqli_fetch_assoc($query);
				}									
				return $fetch_array;
			}else{				
				return false;
			}	
		}
		
		//fetch a single data
		public function fetch_data($query){
			
			$fetch_array = mysqli_fetch_assoc($query);	
			
				if($fetch_array != NULL){
					
					return $fetch_array;
				}else{				
					return false;
				}	
		}
		
		//function to execute query
		public function run_sql_query($sql){
			
			$query = mysqli_query($this->conn, $sql);

			if($query){
				 
				return $query;			
			}else {
				echo $this->ar_error =  "Error: " . $sql . "<br>" . mysqli_error($this->conn);
			}
		}
	}
?>