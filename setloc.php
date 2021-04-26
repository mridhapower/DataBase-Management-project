<?php 
	
	$db=mysqli_connect('localhost','root','','get_med');
	
	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="input-group">
			<label></label>
		<body style="text-align:center;">
		<?php
			$query="SELECT * FROM location";
			$result=mysqli_query($db,$query);
			$table=mysqli_fetch_all($result);
		  ?>
		  <form><p><a href="location.php?logout='1" style="style.css">logout</a></p></form>
			
		
		<div class="input-group" style="width: 70%;height: 300px; text-align:center;background-color: gray;">
			
			<label style="text-align:center ;color: white">Select location</label>
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
			<script >
				function myFunction(){
					var pl=document.getElementById('demo').value;
					console.log(pl);

					//$place=$_POST['$place'];
					location.assign("server.php?varname="+pl);
				}
			</script>
</body>
</html>