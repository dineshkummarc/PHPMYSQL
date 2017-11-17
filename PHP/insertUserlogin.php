<?php
require_once('config.php');
$conn = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
if($conn->connect_error > 0)  
{
	die("connection failed:  ". $conn->connect_error);
}
$id = $_SESSION['id'];
$username = $_SESSION['user'];
$password = $_SESSION['pass'];
$query = "INSERT INTO userlogin(userid,username,password) VALUES(?,?,?)";
$stmt = $conn->stmt_init();
$stmt->prepare($query);
$stmt->bind_param('iss',$id,$username,$password);
$stmt->execute();
$conn->close();
?>