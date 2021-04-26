<?php 
$shop="";
session_start();
//$search="";
$val="";
$med="";
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
			<form method="post" action="shop.php">
		<div>
			<label>medicine</label>
				<input type="text" name="searchbar">
		</div>
		<div>
				<label>quantity</label>
				<input type="text" name="val">
		</div>
		<div>
			<button type="submit" class="btn" name="search">add to cart</button>
		</div>
			</form>
			
	<?php

			$shop=$_GET['varnam'];
			$shop=$_SESSION['shop'];
			$name=$_SESSION['name'];
			//$pps=$_SESSION['shop'];
			echo "$name";
			$query="SELECT * FROM medicine as m join shop_medicine as sm ON m.medicine_id=sm.medicinemedicine_id 
			JOIN shop as s ON s.shop_id=sm.shopshop_id WHERE s.shop_id ='$shop'";
			$result=mysqli_query($db,$query);
			$table=mysqli_fetch_all($result);
		  ?>
		  <form ><p><a href="location.php?logout='1" style="style.css">logout</a></p></form>
		<form method="post" action="shop.php"> 
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
			echo $row['m.medicine_id'];
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
				<td><input type="text" name="quantity" value="0"></td>
				<td><input type="submit" name="add_to_cart" class="btn" value="Add to cart"></td>
			</tr>

			<?php }?>
			
			<?php 
				if (isset($_POST["search"])) {
					$med=mysqli_real_escape_string($db,$_POST['searchbar']);
					$val=mysqli_real_escape_string($db,$_POST['val']);
					if (empty($med)) { echo "medicine name is required";
						}
					if (empty($val)) { echo "quantity is required";
						}
					else if(!empty($med) and !empty($val))
					{
						//echo "$shop";
						$cart="SELECT * FROM medicine as m join shop_medicine as sm ON m.medicine_id=sm.medicinemedicine_id 
							JOIN shop as s ON s.shop_id=sm.shopshop_id WHERE s.shop_id ='$shop' and m.Medicine_name LIKE '$med'";
						$rest=mysqli_query($db,$cart);
						$tab=mysqli_fetch_all($rest);
						if (mysqli_num_rows($rest)<=0) {
						 	echo "not found";
						 } 
						foreach ($tab as $ro) {
							echo $ro[1];
							echo $ro[2];
							echo $ro[3];
							echo $ro[4];
							echo $ro[5];
						}
					}

				}
			?>

					</tbody>
					
				</table>
				<div>
					<table class="table table-border">
						<tr>
						<th>Meicine Name</th>
						<th>quantity</th>
						<th>Price</th>
						<th>total</th>
						<th>action</th>
					</tr>
					
					 <?php
			if (isset($_POST["search"])) {
				if (!empty($med) and !empty($val) and mysqli_num_rows($rest)>0) {
				$id=$ro[0];
				$name=$ro[1];
				$price=$ro[4];
				if (isset($_SESSION["shopping_cart"])) {
					$item_array_id=array_column($_SESSION["shopping_cart"], "item_id");
						$count=count($_SESSION["shopping_cart"]);
						$item_array=array(
						'item_id'=>$id,
						'item_name'=>$name,
						'item_price'=>$price,
						'item_quantity'=>$_POST["val"]

					);
						$_SESSION["shopping_cart"][$count]=$item_array;
					
					
				}
				else 
				{
					$item_array=array(
						'item_id'=>$id,
						'item_name'=>$name,
						'item_price'=>$price,
						'item_quantity'=>$_POST["val"]

					);
					$_SESSION["shopping_cart"][0]= $item_array;
				}
				}
				
			}
		

		?>
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
									$total= $total+number_format($value["item_quantity"]*$value["item_price"],2);
							}
							echo "$total $";
						}
					 ?>
					 <div>
					 	<button type="submit" class="btn" name="confirm">confirm</button>
					 </div>
					</table>
					<?php
						if (isset($_POST['confirm'])) {
							echo "$name";
							$customer="SELECT `id` FROM `customer` WHERE `name` LIKE '$name' LIMIT 1";
							$custo=mysqli_query($db,$customer);
							$tab=mysqli_fetch_all($custo);
							foreach ($tab as $key) {
								
								$tab=$key[0];
								
							}
							//echo "$tab";
							echo $shop;
							$insert="INSERT INTO order(order_id,'order date','order time',customercustomer_id,shopshop_id) VALUES(NULL,CURRDATE(),CURTIME(),$tab,$shop)";
							echo $insert;
							mysqli_query($db,$insert);
							$order="SELECT MAX('order_id') FROM 'order' GROUP BY 'customercustomer_id' HAVING 'customercustomer_id' ='$tab'";
							$ord=mysqli_query($db,$order);
							$tabl=mysqli_fetch_all($ord);
							foreach ($tabl as $key) {
								
								$ord=$key[0];
								
							}
							echo "$ord";
							foreach($_SESSION["shopping_cart"] as $key => $value) {
									
									
										$id=$value["item_id"]; 
										$quantity=$value["item_quantity"]; 
										$get="INSERT INTO 'order_medicine'('orderorder_id','medicinemedicine_id','quantity') VALUES ('$ord','$id','$quantity');";
										mysqli_query($db,$order);

										//$inst=									
									
									//$total= $total+number_format($value["item_quantity"]*$value["item_price"],2);
							}
						}
					 ?>
				</div>
		</form>
</body>
</html>