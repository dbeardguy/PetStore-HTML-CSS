<?php
$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "petstore";

$conn = new mysqli($servername,$username,$pwd,$dbname);
if($conn->connect_error){
	die("Connection failed. Issue : ".$conn->connect_error);
}

if (isset($_POST['submit'])) {

$firstname = trim($_POST['fname']);
$lastname = trim($_POST['lname']);
$email = trim($_POST['email']);
$phone = $_POST['phone'];
$business = trim($_POST['bname']);
$passw = "1234567";

if($firstname == ""){
	$error1 = "Please enter firstname.";
	echo "<script type='text/javascript'>alert('$error1');</script>";
		header("refresh:0.5; url=client.html");
}

elseif ($lastname == "") {
	$error2 = "Please enter lastname.";
	echo "<script type='text/javascript'>alert('$error2');</script>";
		header("refresh:0.5; url=client.html");
}
elseif ($email == ""){
	$error3 = "Please enter your email address.";
	echo "<script type='text/javascript'>alert('$error3');</script>";
		header("refresh:0.5; url=client.html");
}
elseif (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
	$error4 = "Incorrect email address format.";
	echo "<script type='text/javascript'>alert('$error4');</script>";
		header("refresh:0.5; url=client.html");
}
if(!preg_match($pattern, $number, $matches))
	{
		$error5 = "Incorrect contact number format.";
		echo "<script type='text/javascript'>alert('$error5');</script>";
		header("refresh:0.5; url=login.html");
	}

else
{

$sql1 = "SELECT * from login where email = '$email'";
$result = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result) > 0) {
	$message = "Email already exists, please use another email address.";
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("refresh:0.5; url=client.html");
}
else
{
	$sql = "INSERT INTO service (email,fname,lname,phone,business_name) VALUES('$email','$firstname','$lastname','$phone','$business'); INSERT INTO login (fname,lname,email,pwd,rollid) VALUES('$firstname','$lastname','$email','1234567','0');";


	if($conn->multi_query($sql)===TRUE)
	{
		$message = "Use password as 1234567 to login.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("refresh:0.5; url=login.html");
	}

	else{
		$message1 = "Couldn't create your account. Click OK and try again.";
		echo "<script type='text/javascript'>alert('$message1');</script>";
		header("refresh:0.5; url=client.html");
	}
}

}
}



?>