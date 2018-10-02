<?php
	//initialize session
	session_start();
	
	//checks whether session is null
	if($_SESSION == NULL){
		
		header('Location:index.html');
	}	
	//includes parent file
	include "UserExpense/UserExpense.php";
	
	//initializing database
	$user_expense_detail = new UserExpense();
	
	//calling function to retrieve expense details
	$output = $user_expense_detail->get_user_expense_details();
	
	/*if(!$output){
		
		echo "something went wrong.Try again!";
	}*/
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style/bootstrap/css/bootstrap.min.css"/>
		<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
		<script src="style/bootstrap/js/bootstrap.min.js"></script>
		<style>
			.well{
				margin-left: 20px;
				margin-right: 20px;
				margin-top: 20px;
				
			}
			.table{
				background-color: #ffffff;
				margin-bottom:0px
			}
			.back{
				margin-left: 870;
			}
			.p{
				margin-left: 790;
			}
			.dropdown-menu{
				min-width:90px;
			}
			.dropdown{
				margin-top: -35px;
				margin-left: 150px;
			}
			.not-paid{
				color:red;
			}
			.paid{
				color:lawngreen;
			}
		</style>
	</head>
	<body>
		<div class = "well well-lg">
			<div class="container">
				<a class = "btn btn-primary back" href = "dashboard.php" role = "button">Back</a><br><br>
				<button class = "btn btn-primary" data-toggle="modal" data-target="#add_expense">Add an Expense</button>
				<div class="modal fade" id="add_expense" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								  <button type="button" class="close" data-dismiss="modal">&times;</button>
								  <h1 class="modal-title">Add Expense</h1>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" action="add_user_expense.php" method="post">
										<div class ="form-group" "row">
											<div class="col-sm-5">Expense</div><div class="col-sm-1">:</div><div class="col-sm-6"><input type = "text" class = "form-control" name = "expense_detail" required></div><br><br>
											<div class="col-sm-5">Date</div><div class="col-sm-1">:</div><div class="col-sm-6"><input type = "date" class = "form-control" name = "e_date" required></div><br><br>
											<div class="col-sm-5">Amount</div><div class="col-sm-1">:</div><div class="col-sm-6"><input type = "number" class = "form-control" name = "amount" required></div><br><br>
											<div class="col-sm-5">Paid Status</div><div class="col-sm-1">:</div>
											<div class="col-sm-6">
												<input type = "radio" name = "paid_status" value = "1" required>Paid
												<input type = "radio" name = "paid_status" value = "0" required>Not Paid
											</div><br><br><br>							
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<input type = "submit" class="btn btn-primary" value = "Add"><br><br>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Month
					<span class="caret"></span></button>
					<ul class="dropdown-menu">
					  <li>HTML</li>
					  <li>CSS</li>
					  <li>JavaScript</li>
					</ul>
				</div>
				<p class = "p">Total Expense:</p>				
				<table class="table">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Expense</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>						
						<?php if($output){							
							for($i = 0;$i < count($output);$i++){
								if($output[$i]['paid_status_id'] == 0){
									$paid = "not-paid";
								}else{
									$paid = "paid";
								}?>
								<tr>
									<th><?php echo $i + 1;?></th>
									<th><?php echo $output[$i]['expense_detail'];?></th>
									<th><?php echo $output[$i]['e_date'];?></th>
									<th><div class = "<?php echo $paid; ?>"><?php echo $output[$i]['expense_amount']?></div></th>
									<th><span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#edit_<?php echo $i + 1;?>"></span></th>							
									<th>
										<form action = "delete_user_expense_detail.php" method = "post">
											<input type = "hidden" name = "e_no" value = "<?php echo $output[$i]['e_no'];?>">
											<button class = "btn"><span class = "glyphicon glyphicon-trash"></span></button>							
										</form>
									</th>
								</tr>
								<div class="modal fade" id="edit_<?php echo $i + 1;?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal">&times;</button>
											  <h1 class="modal-title">Edit Expense Details</h1>
											</div>
											<div class="modal-body">
												<form class="form-horizontal" action="edit_user_expense_details.php" method="post">
													<div class ="form-group" "row">
														<div class="col-sm-5">Expense</div><div class="col-sm-1">:</div><div class="col-sm-6"><input type = "text" class = "form-control" name = "expense_detail" value = "<?php echo $output[$i]['expense_detail'];?>" readonly></div><br><br>
														<div class="col-sm-5">Date</div><div class="col-sm-1">:</div><div class="col-sm-6"><input type = "date" class = "form-control" name = "e_date" value = "<?php echo $output[$i]['e_date'];?>" required></div><br><br>							
														<div class="col-sm-5">Amount</div><div class="col-sm-1">:</div><div class="col-sm-6"><input type = "number" class = "form-control" name = "expense_amount" value = "<?php echo $output[$i]['expense_amount'];?>" required></div><br><br>							
														<div class="col-sm-5">Paid Status</div><div class="col-sm-1">:</div>
														<div class="col-sm-6"><input type = "radio" name = "paid_status" value = "1" required>Paid
														<input type = "radio" name = "paid_status" value = "0">Not Paid</div><br><br>
														<input type = "hidden" name = "e_no" value = "<?php echo $output[$i]['e_no'];?>">
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<input type = "submit" class="btn btn-primary" value = "Edit"><br><br>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							<?php }
						} ?>
					</tbody>
				</table>				
			</div>
		</div>		
	</body>
</html>	

		