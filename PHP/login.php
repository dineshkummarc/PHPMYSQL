<?php
require_once('config.php');
session_start();
$conn = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
if($conn->connect_error > 0)  
{
	die("connection failed:  ". $conn->connect_error);
}
if(isset($_POST['submit']))
{
	$user= $_POST['uname'];
	$pass = $_POST['pass'];
	//echo "the value of user is:".$user;
	//echo "the value of password is:".$pass;
	$query = "SELECT U.userid FROM userlogin U WHERE U.username=? AND U.password=?";
	$stmt = $conn->stmt_init();
	$stmt->prepare($query);
	$stmt->bind_param('ss',$user,$pass);
	$stmt->execute();
	$stmt->bind_result($userid);
	while($stmt->fetch())
	{
		$_SESSION['id'] = $userid;
		//include('friendNotify.php'); // checks whether logging user has any pending friend notification
		header('Location: registered_user.php'); // goes to the registered user PHP 
	}
}
else if(isset($_POST['newuser']))
{
	header('Location: signup.php');
}
?>