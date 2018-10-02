<?php
	//initialize session
	session_start();
	error_reporting(0);
	
	//checks whether session is null
	if($_SESSION == NULL){
		
		header('Location: index.html');
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style/bootstrap/css/bootstrap.min.css"/>
		<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
		<script src="style/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<style>
	.jumbotron{
		margin-left: 200px;
		margin-right: 590px;
		margin-top: 50px;		
	}
	.container{
		padding-left: 0px;
		padding-right: 0px;
		margin-left:-120px;
	}
	.profile{
		margin-left: 973px;
		
	}
	</style>
	<body>
		<br>
		<span class = "glyphicon glyphicon-user profile"><?php echo "  ".$_SESSION['user_name'];?></span><br><br>
		<a href = "signout.php" class = "btn btn-primary profile" role = "button">Sign Out</a>
		<div class ="form-group" "row">
			<div class="col-sm-4">
				<div class = "container">
					<div class = "jumbotron">
						<a href ="list_expense_details.php" data-toggle="tooltip" data-placement="bottom" title="value">Expense</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class = "container">
					<div class = "jumbotron">
						<a href="list_bank_details.php">Bank Details</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class = "container">
					<div class = "jumbotron">
						<a href="#" data-toggle="tooltip" data-placement="bottom" title="value">Savings</a>
					</div>
				</div>
			</div>			
		</div>
		<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip(); 
			});
			
			$(document).ready(function(){
				$('[data-toggle="popover"]').popover();   
			});
		</script>
	</body>
</html>
