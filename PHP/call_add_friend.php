<?php
require_once('config.php');
$conn = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
if($conn->connect_error > 0)  
{
	die("connection failed:  ". $conn->connect_error);
}
$id = $_SESSION['id'];
$recipent = $_SESSION['recipient'];
//echo "the value of id is:".$id;
$query = "CALL add_friend(?,?)";
$stmt = $conn->stmt_init();
$stmt->prepare($query);
$stmt->bind_param('ii',$id,$recipent);
$stmt->execute();
?>