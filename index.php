
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ajax</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>

    	.row{
    		margin-bottom: 50px;
    	}
		.control{
			display: none;
		}
		h1{
			letter-spacing: 20px;
			margin-bottom: 20px;
		}
    </style>
</head>
<body>
	<div class='container'>
		<h1 class='text-center'>AJAX</h1>
		<div class='row'>
			<input type="text" name="search" class='form-control search' placeholder='Search about Car'>
			<div class='result'></div>
		</div>

		<div class='row'>
			<form action="function.php" method="post" class='col-xs-12 form_add_car'>
				<div class='form-group'>
					<input type='text' name='add_car_name' class='form-control add_car_name' autocomplete="off" placeholder='Add Car'>
				</div>
				<input name='submit_car' type='submit' class='btn btn-primary submit_car' value='Add Car'>
				

			</form>
		</div>
		<div class='row'>
			<div class='cars_results col-xs-6'>
				<table class="table table-dark">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">name</th>
							<th scope="col">option</th>

						</tr>
					</thead>
					<tbody class='cars_data'>
					</tbody>
				</table>
			</div>
			<div class='updating col-xs-6'>
				
			</div>
		</div>
		<div class='row'>
			
		</div>
	</div>



   <script src="js/jquery-3.2.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/ajax.js"></script>
</body>
</html>