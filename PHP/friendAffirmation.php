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
$recipientid = $_POST['recipient'];
$senderid = $_SESSION['id'];
$_SESSION['recipient'] = $recipientid;
//echo "The value of recipient is:".$recipientid;
//echo "The value of senderid is:".$senderid;
$stmt = $conn->stmt_init();
$query_update="UPDATE notification SET status='Approved' WHERE senderid=? AND recipientid=?";
$stmt->prepare($query_update);
$stmt->bind_param('ii',$senderid,$recipientid);
$stmt->execute();
include("call_add_friend.php");
?>
<p>Succesfully Friend has been accepted!!</p>
<?php
$conn->close();
?>
</div>
</div>
</body>
</html>