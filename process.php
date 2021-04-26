<?php
	$host="localhost";
	$user="root";
	$password="";
	$db="get_med";

	$con=mysqli_connect($host,$user,$password) or die(mysql_error());
	mysqli_select_db($con,$db) or die(mysql_error());

	if(isset($_POST['user'])){
		$uname=$_POST['user'];
		$password=$_POST['pass'];

		$sql="select * from loginform where user='".$uname."' AND pass='".$password."'limit 1";

		//$result=mysql_query($sql);
		$result=mysqli_query("select * from customer where name='$uname' AND customer_pass='$password'")
				or die();
		$row=mysql_fetch_array($result);
		if($row['name']==$uname && $row['customer_pass']==$password){
			echo "login successful";
		}
		else{
			echo "entered wrong password";
			exit();
		}
	}
	mysqli_close($con);
?>