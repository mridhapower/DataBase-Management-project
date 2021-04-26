<!DOCTYPE html>
<html>
<head>
	<title>select</title>
</head>
<body>
	<form method="post"action="select.php">
		
		<p><input type="checkbox" name="checkreg" value="customer">customer</p>
		<p><input type="checkbox" name="checkreg" value="shop">shop</p>
		<p><input type="checkbox" name="checkreg" value="delivery man">delivery man</p>
		<div class="input-group">
			<button type="submit" class="btn" name="sel">select</button>
		</div>
	</form>
	<?php
		if (isset($_POST['sel'])) {
			$sel=$_POST["checkreg"];
		echo "$sel";
		if ($sel=="shop") {
			header("location:register2.php");
		}
		else {
			header("location:register.php");
		}
		}
	 ?>
</body>
</html>