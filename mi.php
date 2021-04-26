<?php
session_start();
$pps=$_SESSION['shop'];
echo $pps;

	$mysqli=new mysqli('localhost','root','','get_med') or die(mysqli_error($mysqli));
	$result=$mysqli->query("SELECT m.Medicine_name as name, m.price as price FROM medicine as m join shop_medicine as sm ON m.medicine_id=sm.medicinemedicine_id 
			JOIN shop as s ON s.shop_id=sm.shopshop_id WHERE s.shop_id ='$pps'") or die($mysqli->error);
	?>



<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>


	<?php while($row=$result->fetch_assoc()):?>
  <section id="Saturday">
  <div class="container">
   <div class="row">
    <div class="col-md-8">
        <h4><?php echo $row['name'];?></h4>
		<h6><?php echo $row['price'];?></h6>


		  <?php endwhile;?>