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
<li><a href= "#">Add Friend</a></li>
<li><a href= "">Add Neighbor</a></li>
<li><a href= "">Compose Message</a></li>
<li><a href= "">Inbox</a></li>
<li><a href= "">Outbox</a></li>
<li><a href= "">Feed</a></li>

</ul>

</div>
<div id= "MainBody">
<div id="table">
<table>
<tr>
<th colspan="2">Friend Suggestion </th>
<th>Action</th>
</tr>
<form action="AffirmationFriend.php" method="POST">
<?php
require_once('config.php');
$conn = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
if($conn->connect_error > 0)  
{
	die("connection failed:  ". $conn->connect_error);
}
$id = $_SESSION['id'];
$query = "SELECT R.userid FROM register R WHERE R.userid NOT IN (SELECT F.friend2 FROM friend F WHERE F.friend1 = ?) AND R.userid NOT IN (SELECT R1.userid FROM register R1 WHERE R1.userid = ?)";
$stmt = $conn->stmt_init();
$stmt->prepare($query);
$stmt->bind_param('ii',$id,$id);
$stmt->execute();
$stmt->bind_result($friend);
$stmt->store_result();
$rows = $stmt->num_rows;
//echo "the value of rows is:".$rows;
if($rows > 0)
{
	$conn1 = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
	if($conn1->connect_error > 0)  
	{
		die("connection failed:  ". $conn->connect_error);
	}
	while($stmt->fetch())
	{
		// the code for to find the name of the person who has send the notification
		$query1 = "SELECT Name FROM user WHERE userid=?";
		$stmt1 = $conn1->stmt_init();
		$stmt1->prepare($query1);
		$stmt1->bind_param('i',$friend);
		$stmt1->execute();
		$stmt1->bind_result($name);
		while($stmt1->fetch())
		{
		?>
        	<tr>
            <td><img src="../image/<?php echo $friend; ?>.jpg" width="50" height="50"></td>
            <td width="300px"><?php echo htmlspecialchars($name); ?></td>
            <td><input type="submit" name="request" value="Send Request"></td>
            <input type="hidden" name="friend" value="<?php echo $friend; ?>">
            </tr>
        <?php   
		}
	}
}
else
{
?>
<p> No Notification Found!! </p>
<?php	
}
$conn->close();
$conn1->close();
?>
</table>
</form>
</div>
</div>
</div>
</body>
</html>