<?php

$server = "localhost";
$user = "root";
$pass = "";
$dbname = "petstore";

$conn = new mysqli($server,$user,$pass,$dbname);
if($conn->connect_error){
	die("Connection failed. Issue : ".$conn->connect_error);
}
if (isset($_POST['submit']))
{
	$comments = trim($_POST['comment']);
	$firstname = trim($_POST['fname']);
	$lastname = trim($_POST['lname']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);

	if($firstname == "")
	{
		$error1 = "Please enter firstname.";
		echo "<script type='text/javascript'>alert('$error1');</script>";
		header("refresh:0.5; url=contactus.html");
	}

	elseif ($lastname == "") 
	{
		$error2 = "Please enter lastname.";
		echo "<script type='text/javascript'>alert('$error2');</script>";
		header("refresh:0.5; url=contactus.html");
	}
	elseif ($email == "")
	{
		$error3 = "Please enter your email address.";
		echo "<script type='text/javascript'>alert('$error3');</script>";
		header("refresh:0.5; url=contactus.html");
	}
	elseif (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) 
	{
		$error4 = "Incorrect email address format.";
		echo "<script type='text/javascript'>alert('$error4');</script>";
		header("refresh:0.5; url=contactus.html");
	}

	elseif ($comments == "")
	{
		$error6 = "Please enter your feedback or query.";
		echo "<script type='text/javascript'>alert('$error6');</script>";
		header("refresh:0.5; url=contactus.html");
	}

	else
	{
		$sql = "INSERT INTO contactus (email,fname,lname,phone,comments) VALUES('$email','$firstname','$lastname','$phone','$comments')";

		if($conn->multi_query($sql)===TRUE)
		{
			$message = "Message received.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			header("refresh:0.5; url=index.html");
		}

		else{
			$message1 = "Error.";
			echo "<script type='text/javascript'>alert('$message1');</script>";
			header("refresh:0.5; url=contactus.html");
		}
	}
}	

?>