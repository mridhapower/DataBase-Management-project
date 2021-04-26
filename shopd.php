<?php 
session_start();
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location:login.php");
}
	
	$loc="";
	$med="";
	$qt="";
	$db=mysqli_connect('localhost','root','','get_med');
 ?>
<?php  
	$name=$_GET['name'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		  <form><p><a href="location.php?logout='1" style="style.css">logout</a></p></form>
		  
		  
		  <form method="post">
		  	<input type="text" name="med">
		  				
					
		  	<button type="submit" class="btn" name="search">search</button>

		  </form>
		  <?php
	if (isset($_POST['search'])) {
		  		$search=mysqli_real_escape_string($db,$_POST['med']);
				///echo($search);
				$query="SELECT * FROM medicine WHERE Medicine_name LIKE '$search'";
				$results=mysqli_query($db,$query);
				$table=mysqli_fetch_all($results);
				//echo "$name";
				?>
				<table>
					<tbody>
					<?php

					foreach ($table as $row) {
						?>

						

						<?php
							
					}
					$med=$row[0];
					echo "$med";
					$loc=mysqli_num_rows($results);

					?>
					<form method="post">
						<label>Quantity</label>
						<input type="text" name="qt">
						<button type="submit" class="btn" name="insert">insert</button>

					</form>
				</tbody>
				</table>
				<?php
	}				
				if (isset($_POST['insert'])) {					
		  				$qt=mysqli_real_escape_string($db,$_POST['qt']);
					?>
					
					

					<?php
					$quer="SELECT * FROM shop WHERE `name` LIKE '$name'";
					$result=mysqli_query($db,$quer);
					$table=mysqli_fetch_all($result);
					foreach ($table as $row) {
						?>

						<?php
							
					}
					$id=$row[0];
					echo "shop ";
					echo "$id";
					if (empty($qt)) {
						echo "enter quantity";	
					}
					else
					{
						$query="INSERT INTO 'shop_medicine'('shopshop_id', 'medicinemedicine_id','quantity') VALUES ($id, $med, '$qt');";
  						mysqli_query($db,$query);
  						echo "$query";
					}
				}
 ?>

		
</body>
</html>
