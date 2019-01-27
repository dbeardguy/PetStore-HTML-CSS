<?php

$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "petstore";

$conn = new mysqli($servername,$username,$pwd,$dbname);
if($conn->connect_error){
	die("Connection failed. Issue : ".$conn->connect_error);
}

if (isset($_POST['submit'])) 
{
	$email = trim($_POST['email']);
	$pswd = trim($_POST['password']);

	if($email == ""){
		$error1 = "Please enter registered email address.";
		echo "<script type='text/javascript'>alert('$error1');</script>";
		header("refresh:0.5; url=login.html");
	}
	else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
	{
		$error2 = "Incorrect email address format.";
		echo "<script type='text/javascript'>alert('$error2');</script>";
		header("refresh:0.5; url=login.html");
	}
	elseif ($pswd == ""){
		$error3 = "Please enter your password.";
		echo "<script type='text/javascript'>alert('$error3');</script>";
		header("refresh:0.5; url=login.html");
	}
	

else{

	$sql = "SELECT pwd from login where email = '$email'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
		{
      		$pass = $row['pwd'];
  		}

  		if ($pswd == $pass) {
			$sql1 = "SELECT rollid from login where email = '$email'";
			$result1 = mysqli_query($conn, $sql1);

			if (mysqli_num_rows($result1) > 0) 
			{
				while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) 
				{
      				$roll = $row1['rollid'];
  				}
			}

			if ($roll == 1) 
			{
				header("refresh:1; url=businesspage.html");
			}
			else
			{
				$error4 = "Invalid Email";
				echo "<script type='text/javascript'>alert('$error4');</script>";
				header("refresh:0.5; url=login.html");
			}
		}
		else
		{
			$error4 = "Wrong password";
			echo "<script type='text/javascript'>alert('$error4);</script>";
			header("refresh:0.5; url=login.html");
		}
	}

	else
	{
		$error5 = "Sign up first.";
		echo "<script type='text/javascript'>alert('$error5);</script>";
		header("refresh:0.5; url=login.html");	
	}
}
}

?>