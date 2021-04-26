<?php 
session_start();
$search="";
$query="";
$db=mysqli_connect('localhost','root','','get_med');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="input-group">
		<form method="post" action="search.php">
			
		<div>
			<input type="text" name="searchbar">
		</div>
		<div>
			<button type="submit" class="btn" name="searchs">search</button>
		</div>
	</form>
		<?php
			if(isset($_POST['searchs']))
			{
				$search=mysqli_real_escape_string($db,$_POST['searchbar']);
				//echo($search);
				$query="SELECT * FROM medicine WHERE Medicine_name LIKE '$search'";
				$results=mysqli_query($db,$query);
				$table=mysqli_fetch_all($results);
			

				?>
				<style type="text/css">
		#table1{
			width:100%;
		}
		#table1,#table1 th,#table1 td{
			border: 1px solid blue;
			border-collapse: collapse;
		}
	</style>
							<table id="table1">

									<thead>
										<tr>
											<th>ID</th>
											<th>CATAGORY</th>
											<th>NAME</th>
											<th>IMAGE</th>
											<th>PRICE/UNIT</th>
											<th>QUANTITY</th>
											<th>UPLOAD DATE</th>
										</tr>
									</thead>
									<tbody>
										<?php

										foreach ($table as $row) {
											?>

											<tr>
												<td><?php echo $row[0] ?></td>
												<td><?php echo $row[1] ?></td>
												<td><?php echo $row[2] ?></td>
												<td><?php echo $row[3] ?></td>
												<td><?php echo $row[4] ?></td>
												<td><?php echo $row[5] ?></td>
												<td><?php echo $row[6] ?></td>
											</tr>

											<?php
												mysqli_free_result($results);
										}

										?>
									</tbody>
								</table>
								<?php

							
								
							}
							?>



</body>
</html>