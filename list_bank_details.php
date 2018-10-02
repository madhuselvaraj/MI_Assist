<?php
	//initialize session
	session_start();
	
	//checks whether session is null
	if($_SESSION == NULL){
		
		header('Location: index.html');
	}	
	//includes parent file
	include "BankAccountDetail/BankAccountDetail.php";
	
	//initializing database
	$user_bank_detail = new BankAccountDetail();
	
	//calling function to retrieve bank details
	$output = $user_bank_detail->get_user_bank_details();
	
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
				margin-left: 790;
			}
		</style>
	</head>
	<body>
		<div class = "well well-lg">
			<div class="container">
				<button class = "btn btn-primary" data-toggle="modal" data-target="#add_bank">Add Bank</button>
				<a class = "btn btn-primary back" href = "dashboard.php" role = "button">Back</a><br><br>
					<div class="modal fade" id="add_bank" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								  <button type="button" class="close" data-dismiss="modal">&times;</button>
								  <h1 class="modal-title">Add Bank</h1>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" action="add_bank_details.php" method="post">
										<div class ="form-group" "row">
											<div class="col-sm-5">Bankname</div><div class="col-sm-1">:</div><div class="col-sm-6"><input type = "text" class = "form-control" name = "bank_name" required></div><br><br>
											<div class="col-sm-5">Amount</div><div class="col-sm-1">:</div><div class="col-sm-6"><input type = "number" class = "form-control" name = "amount" required></div><br><br><br>							
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
				<table class="table">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Bank Name</th>
							<th>Amount</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if($output){
								for($i = 0;$i < count($output);$i++){ ?>
									<tr>
										<td><?php echo $i + 1;?></td>
										<td><?php echo $output[$i]['bank_name'];?></td>							
										<td><?php echo $output[$i]['current_amount'];?></td>			
										<td><span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#edit_bank_<?php echo $i + 1;?>"></span></td>
									</tr>
								<div class="modal fade" id="edit_bank_<?php echo $i + 1;?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal">&times;</button>
											  <h1 class="modal-title">Edit Bank Details</h1>
											</div>
											<div class="modal-body">
												<form class="form-horizontal" action="edit_user_bank_details.php" method="post">
													<div class ="form-group" "row">
														<input type = "hidden" class = "form-control" name = "bank_id" value = "<?php echo $output[$i]['bank_id'];?>">
														<div class="col-sm-5">Bankname</div><div class="col-sm-1">:</div><div class="col-sm-6"><input type = "text" class = "form-control" name = "bank_name" value = "<?php echo $output[$i]['bank_name'];?>" disabled></div><br><br>
														<div class="col-sm-5">Amount</div><div class="col-sm-1">:</div><div class="col-sm-6"><input type = "number" class = "form-control" name = "amount" value = "<?php echo $output[$i]['current_amount'];?>" required></div><br><br><br>							
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