<?php
	$host="localhost";
	$user="root";
	$password="";
	$db="login";

	$con=mysqli_connect($host,$user,$password) or die(mysql_error());
	mysqli_select_db($con,$db) or die(mysql_error());

	if(isset($_POST['user'])){
		$uname=$_POST['user'];
		$password=$_POST['pass'];

		$sql="select * from loginform where user='".$uname."' AND pass='".$password."'limit 1";

		//$result=mysql_query($sql);
		$result=mysqli_query("select * from users where username='$uname' AND password='$password'")
				or die();
		$row=mysql_fetch_array($result);
		if($row['username']==$uname && $row['password']==$password){
			echo "login successful";
		}
		else{
			echo "entered wrong password";
			exit();
		}
	}
	mysqli_close($con);
?>