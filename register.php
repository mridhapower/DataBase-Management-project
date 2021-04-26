<?php include('server.php')?>
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

	<form method="post" action="Register.php">
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
		<p>
			Aready a member? <a href="login.php">Sign in</a>
		</p>
	</form>

</body>
</html>