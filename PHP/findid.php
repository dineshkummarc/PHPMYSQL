<?php
require_once('config.php');
$conn = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
if($conn->connect_error > 0)  
{
	die("connection failed:  ". $conn->connect_error);
}
$query = "SELECT COUNT(*) FROM user";
$stmt = $conn->stmt_init();
$stmt->prepare($query);
$stmt->execute();
$stmt->bind_result($value);
while($stmt->fetch())
{
	$_SESSION['id'] = $value + 1;
}
$conn->close();
?>

