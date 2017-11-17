<?php
require_once('config.php');
$conn = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
if($conn->connect_error > 0)  
{
	die("connection failed:  ". $conn->connect_error);
}
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$date = $_SESSION['date'];
$address = $_SESSION['address'];
$city = $_SESSION['city'];
$zip = $_SESSION['zip'];
$state = $_SESSION['state'];
$about = $_SESSION['about'];
$query = "INSERT INTO user(userid,Name,DOB,Address,City,Zip,State,About) VALUES (?,?,?,?,?,?,?,?)";
$stmt = $conn->stmt_init();
$stmt->prepare($query);
$stmt->bind_param('issssiss',$id,$name,$date,$address,$city,$zip,$state,$about);
$stmt->execute();
$conn->close();
?>