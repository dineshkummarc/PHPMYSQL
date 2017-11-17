<?php
session_start();
?>
<!doctype html>
<html>
<head>
<link href = "../CSS/pageStyle.css" rel="stylesheet" type="text/css"/>
<link href = "../CSS/Menu.css" rel="stylesheet" type="text/css"/>
<link href = "../CSS/SideBar.css" rel="stylesheet" type="text/css"/>
<meta charset="utf-8">
<title>Nexus In The Hood</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
</head>

<body>
<div id= "Container">
<div id= "Header"> </div>
<div id= "Menu">
<ul>
<li><a href= "logout.php">Logout</a></li>
<li><a href= "#">Home</a></li>


</ul>

</div>
<div id= "SideBar">

<ul>
<li><a href= "">Add Friend</a></li>
<li><a href= "">Add Neighbor</a></li>
<li><a href= "">Compose Message</a></li>
<li><a href= "">Inbox</a></li>
<li><a href= "">Outbox</a></li>
<li><a href= "">Feed</a></li>

</ul>

</div>
<div id= "MainBody">
<?php
require_once('config.php');
$conn = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
if($conn->connect_error > 0)  
{
	die("connection failed:  ". $conn->connect_error);
}
$recipientid = $_POST['friend'];
$senderid = $_SESSION['id'];
$stmt = $conn->stmt_init();
$query="SELECT C.hoodid FROM register R NATURAL JOIN contained C WHERE R.userid = ? AND R.blockid = C.blockid";
$stmt->prepare($query);
$stmt->bind_param('i',$senderid);
$stmt->execute();
$stmt->bind_result($hoodid);
$stmt->store_result();
$rows = $stmt->num_rows;
if($rows > 0)
{
	$conn1 = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
	if($conn1->connect_error > 0)  
	{
		die("connection failed:  ". $conn1->connect_error);
	}
	while($stmt->fetch())
	{
		$stmt1=$conn1->stmt_init();
		$query1="INSERT INTO notification(senderid,recipientid,hoodid,status) VALUES(?,?,?,'Pending')";
		$stmt1->prepare($query1);
		$stmt1->bind_param('iii',$senderid,$recipientid,$hoodid);
		$stmt1->execute();	
	}
}
?>
<p>Succesfully Notification has been sent!!</p>
<?php
$conn->close();
?>
</div>
</div>
</body>
</html>