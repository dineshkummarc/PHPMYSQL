<?php
session_start();
require_once('config.php');
$conn = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
if($conn->connect_error > 0)  
{
	die("connection failed:  ". $conn->connect_error);
}
$id = $_SESSION['id'];
$block = 1;
//echo "the value of id is:".$id;
$query = "CALL apply_member(?,?)";
$stmt = $conn->stmt_init();
$stmt->prepare($query);
$stmt->bind_param('ss',$id,$block);
$stmt->execute();
$conn->close();
?>