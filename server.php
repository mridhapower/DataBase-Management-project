<?php
session_start();
$username="";
$email="";
$address="";
$phone="";
$loc="";
$errors=array();

$db=mysqli_connect('localhost','root','','get_med');

if (isset($_POST['reg_user'])) {
	$type=$_POST["checkreg"];
	$username=mysqli_real_escape_string($db,$_POST['name']);
	$address=mysqli_real_escape_string($db,$_POST['address']);
	$email=mysqli_real_escape_string($db,$_POST['email']);
	$phone=mysqli_real_escape_string($db,$_POST['phones']);
	$password_1=mysqli_real_escape_string($db,$_POST['password_1']);
	$password_2=mysqli_real_escape_string($db,$_POST['password_2']);

	if (empty($username)) { array_push($errors,"username is required");
	}
	if (empty($address)) { array_push($errors,"address is required");
	}
	if (empty($email)) { array_push($errors,"email is required");
	}
	if (empty($phone)) { array_push($errors,"phone no. is required");
	}
	if (empty($password_1)) { array_push($errors,"password is required");
	}
	if (empty($password_2)) { array_push($errors,"password is required");
	}
	if ($password_1!=$password_2) {
		array_push($errors, "The two password do not match");
	}

	$user_check_query="SELECT * FROM $type WHERE name='".$username."' OR email='".$email."' OR 'phone no'='".$phone."' LIMIT 1";
	$result=mysqli_query($db,$user_check_query);
	$user=mysqli_fetch_assoc($result);
	if ($type=='shop') {
		header('location:loc.php');
		$loc=['varname'];
	}

	if ($user) {
		if ($user['name'] == $username) {
			array_push($errors, "username already exist");
		}
		if ($user['phone no'] == $phone) {
			array_push($errors, "phone no. already exist");
		}
		if ($user['email'] == $email) {
			array_push($errors, "email already exist");
		}
	}

	if (count($errors)==0) {
		$password= md5($password_1);
		$query="INSERT INTO $type(`id`, `name`, `address`, `email`, `phone no`, `pass`) VALUES (NULL, '$username', '$address', '$email', '$phone', '$password');";
  		mysqli_query($db,$query);
  		//$_SESSION['name']=$username;
  		//$_SESSION['success']="You are now logged in";
  		header('location:login.php');
	}
}

if (isset($_POST['login_user'])) {
	$type=$_POST["checklog"];
	$username=mysqli_real_escape_string($db,$_POST['username']);
	$password=mysqli_real_escape_string($db,$_POST['password']);
	if (empty($username)) {
		array_push($errors, "Username is required");
	}

	if (empty($password)) {
		array_push($errors, "Password is required");
	}
	if (empty($type)) {
		array_push($errors, "type is required");
	}

	if (count($errors)==0) {
		$password=md5($password);
		$query="SELECT * FROM $type WHERE name='".$username."' AND pass='$password'";
		$results=mysqli_query($db,$query);
		if (mysqli_num_rows($results)==1) {

			//echo "$password";
			//$_SESSION['username']=$username;
			//$_SESSION['success'] = "You are now logged in";
			if ($type=="customer") {
				$_SESSION['name']=$username;
				header('location:location.php?');
			}
			else if ($type=="shop") {
				header('location:shopd.php?name='.$username);
			}
			else if ($type=="delivery man") {
				header('location:delivery.php?name='.$username);
			}
		}else{
			array_push($errors, "Wrong username/password ");
		}
	}
}
?>