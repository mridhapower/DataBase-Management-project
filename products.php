<?php
session_start();

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: login/login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#table1{
			width:100%;
		}
		#table1,#table1 th,#table1 td{
			border: 1px solid blue;
			border-collapse: collapse;
		}
	</style>
</head>
<body>

<?php 
///connecting to database
	try{
		$conn = new PDO("mysql:host=localhost:3306;dbname=dbmsprojectlecture","root","");
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		?>
<script type="text/javascript">
	window.alert("database not connected.");
</script>

		<?php
	}
	///reading from database
	$query="SELECT * FROM products";
	$returnvalue= $conn->query($query);
	$table=$returnvalue->fetchAll();
	//print_r($table);

	?>
<div class="input-group">
<p><a href="products.php?logout='1" style="style.css">logout</a></p>
</div>

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

		}

		?>
	</tbody>
</table>
	<?php

 ?>
</body>
</html>