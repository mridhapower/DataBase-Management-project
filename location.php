<?php 
session_start();
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location:login.php");
}
	
	$loc="";
	$db=mysqli_connect('localhost','root','','get_med');
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>locations</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
	#table1{

		width:100%;
	}

	#table1,#loc_tab th,#loc_tab td{

		text-align: center;
		border: 1px solid blue;
		border-collapse: collapse;
	}

</style>
</head>
<body style="text-align:center;">
		<?php
			$name=$_SESSION['name'];
			$_SESSION['name']=$name;
			$query="SELECT * FROM location";
			$result=mysqli_query($db,$query);
			$table=mysqli_fetch_all($result);
		  ?>
		  <form><p><a href="location.php?logout='1" action="location.php" style="style.css">logout</a></p></form>
			
		
		<div class="input-group" style="width: 70%;height: 300px; text-align:center;background-color: gray;">
			
			<label style="text-align:center ;color: white">Select location and shop</label>
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

						</script>
					<?php
				}
			?>

			<!-- second dordown box -->
			<select id="shopd" onchange="myshop()" style="width: 250px;">
				<option value="0" selected>NONE</option>
				<?php
					if(isset($_GET['varname'])){
						$loc_no=$_GET['varname'];
						$query="SELECT * FROM shop where locationLocation_id=$loc_no";
						$result=mysqli_query($db,$query);
						$table=mysqli_fetch_all($result);

			  			foreach ($table as $row) {
			  				?>
								<option value="<?php echo $row[0]?>" ><?php echo $row[1]?></option>
			  				<?php 
			  				//mysqli_free_result($result);
			  			}
		  		  
					} 
					
					
				?>
			</select>

				<?php
				if(isset($_GET['varnam'])){
					?>
						<script>
							var comp=document.getElementById('shopd');
							comp.value=<?php echo $_GET['varnam']?>;

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
					location.assign("location.php?varname="+pl);
				}
			</script>
			<script >
				function myshop(){
					var pll=document.getElementById('shopd').value;
					console.log(pll);
					location.assign("shop.php?varnam="+pll);
				}
			</script>
</body>
</html>