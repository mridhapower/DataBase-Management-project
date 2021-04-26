<?php 
$shop="";
session_start();
$search="";
$pl="";
$item_array=array();
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location:login.php");
}
	//$loc="";
	//$id="";
	//$name="";
	//$price="";
	$db=mysqli_connect('localhost','root','','get_med');
 ?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#tab_med{
			width:100%;
		}
		#tab_med,#tab_med th,#tab_med td{
			border: 1px solid blue;
			border-collapse: collapse;
		}
	</style>
	<!--<link rel="stylesheet" type="text/css" href="style.css">-->
	<title>Medicines</title>
</head>
<body>
	<div>
			<input type="text" name="searchbar">
		</div>
		<div>
			<button type="submit" class="btn" name="searchs">search</button>
		</div>
	<?php

			$shop=$_GET['varnam'];
			$_SESSION['shop']=$shop;
			//$pps=$_SESSION['shop'];
			//echo "$shop";
			$query="SELECT * FROM medicine as m join shop_medicine as sm ON m.medicine_id=sm.medicinemedicine_id 
			JOIN shop as s ON s.shop_id=sm.shopshop_id WHERE s.shop_id ='$shop' or s.name='$search'";
			$result=mysqli_query($db,$query);
			$table=mysqli_fetch_all($result);
		  ?>
		  <form ><p><a href="location.php?logout='1" style="style.css">logout</a></p></form>
		
			<table id="tab_med">
					<thead>
						<tr>
						<th>Shop Name</th>
						<th>Meicine Name</th>
						<th>Price</th>
						<th>Mfg Date</th>
						<th>exp date</th>
						<th>Company</th>
						<th>catagory</th>
						<th>Quantity</th>
					</tr>
					</thead>
					<tbody>
			<?php 
				foreach ($table as $row) {
					?>
					<tr>
				<td><?php echo $row[13] ?></td>
				<td><?php echo $row[1] ?></td>
				<td><?php echo $row[4] ?></td>
				<td><?php echo $row[7] ?></td>
				<td><?php echo $row[5] ?></td>
				<td><?php echo $row[6] ?></td>
				<td><?php echo $row[2] ?></td>
				<td><?php echo $row[11] ?></td>
			</tr>
					<?php
				}
			?></tbody>
		</table>
		<select id="med" name="med" onchange="myFunction()" style="width: 250px;">
				<option value="0" selected>NONE</option>
						<?php
		foreach ($table as $row) {
			?>
			<option value="<?php echo $row[0]?>" ><?php echo $row[1]?></option>
			<?php }?>
			<!--<?php
			if (isset($_POST["add_to_cart"])) {
				$id=$row[0];
				$name=$row[1];
				$price=$row[4];
				if (isset($_SESSION["shopping_cart"])) {
					$item_array_id=array_column($_SESSION["shopping_cart"], "item_id");
						$count=count($_SESSION["shopping_cart"]);
						$item_array=array(
						'item_id'=>$id,
						'item_name'=>$name,
						'item_price'=>$price,
						'item_quantity'=>$_POST["quantity"]

					);
						$_SESSION["shopping_cart"][$count]=$item_array;
					
					
				}
				else 
				{
					$item_array=array(
						'item_id'=>$id,
						'item_name'=>$name,
						'item_price'=>$price,
						'item_quantity'=>$_POST["quantity"]

					);
					$_SESSION["shopping_cart"][0]= $item_array;
				}
				
			}

		

		?>-->
		<script >
				function myFunction(){
					var pl=document.getElementById('med').value;
					console.log(pl);
					//location.assign("location.php?varname="+pl);
					
				}
			</script>
			
			<input type="text" name="username">

			<input type="submit" name="add">

					
				<!--<div>
					<table class="table table-border">
						<tr>
						<th>Meicine Name</th>
						<th>quantity</th>
						<th>Price</th>
						<th>total</th>
						<th>action</th>
					</tr>
					<?php 
						if (!empty($_SESSION["shopping_cart"])) {
							$total=0;
							foreach ($_SESSION["shopping_cart"] as $key => $value) {
									?>
									<tr>
										<td><?php echo $value["item_name"]; ?></td>
										<td><?php echo $value["item_quantity"]; ?></td>
										<td><?php echo $value["item_price"]; ?></td>
										<td><?php echo number_format($value["item_quantity"]*$value["item_price"],2); ?></td>
									</tr>
									<?php
							}
						}
					 ?>
					</table>
				</div>-->
				<?php echo "pl";  ?>
		
</body>
</html>