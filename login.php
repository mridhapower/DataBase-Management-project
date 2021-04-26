<?php include('server.php')?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="icon" type="text/css" href="logo.png">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<style >
		body{
			background-image: url(backg.jpg); 
			background-repeat: no-repeat;
			background-position: center center;
			background-size: 100%;
		}
	</style>
	<div class="header">
		<h2>Login</h2>
	</div>

	<form method="post" action="login.php">
		<?php include('errors.php');?>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="Password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<p><input type="checkbox" name="checklog" value="customer">customer</p>
		<p><input type="checkbox" name="checklog" value="shop">shop</p>
		<p><input type="checkbox" name="checklog" value="delivery man">delivery man</p>
		<p>
			Not yet amember? <a href="select.php">Sign up</a>
		</p>
	</form>

</body>
</html>