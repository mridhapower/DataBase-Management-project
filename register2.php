<?php include('server2.php')
	
?>
<?php 
	$loc="";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>

	<form method="post" action="register2.php">
		<?php include('errors.php');?>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="name" value="<?php echo($username)?>">
		</div>
		<div class="input-group">
			<label>address</label>
			<input type="text" name="address" value="<?php echo($address)?>">
		</div>	
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo($email)?>">
		</div>
		<div class="input-group">
			<label>phone no.</label>
			<input type="text" name="phones" value="<?php echo($phone)?>">
		</div>
		<div class="input-group">
			<label>location</label>
			<input type="text" name="location" value="<?php echo($loc)?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="Password" name="password_1" >
		</div>
		<div class="input-group">
			<label>Confirm Password</label>
			<input type="Password" name="password_2">
		</div>	
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		<?php
			$query="SELECT * FROM location";
			$result=mysqli_query($db,$query);
			$table=mysqli_fetch_all($result);
		  ?>
		  <form><p><a href="location.php?logout='1" style="style.css">logout</a></p></form>
			
		
		<div class="input-group">
			
			<label >Select location and shop</label>
			<select id="demo" name="demo" onchange="myFunction()" style="width: 250px;">
				<option value="0" selected>NONE</option>
				<?php
		  			foreach ($table as $row) {
		  				?>
							<option value="<?php echo $row[0]?>" ><?php echo $row[1]?></option>
		  				<?php 
		  				//mysqli_free_result($result);
		  			}
		  		  ?>
			</select>

			<?php
				if(isset($_GET['varname'])){
					?>
						<script>
							var comp=document.getElementById('demo');
							comp.value=<?php echo $_GET['varname']?>;
							
							<?php
								$loc=$_GET['varname'];
							 echo $loc ?>

						</script>
					<?php
				}
			?>

			</div>
				
				
			
			
			<script >
				function myFunction(){
					var pl=document.getElementById('demo').value;
					console.log(pl);

					//$place=$_POST['$place'];
					assign("varname="+pl);
				}
			</script>

		
		<p>
			Aready a member? <a href="login.php">Sign in</a>
		</p>
	</form>

</body>
</html>