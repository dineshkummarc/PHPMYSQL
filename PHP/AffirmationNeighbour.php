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
$neighbour = $_POST['neighbour'];
$userid = $_SESSION['id'];
echo "the value of neighbour and id is:".$neighbour." ".$userid; 
/*$stmt = $conn->stmt_init();
$query="INSERT INTO neighbour(userid,neighbour) VALUES(?,?)";
$stmt->prepare($query);
$stmt->bind_param('ii',$userid,$neighbour);
$stmt->execute();*/
?>
<p>Succesfully Notification has been sent!!</p>
<?php
$conn->close();
?>
</div>
</div>
</body>
</html>