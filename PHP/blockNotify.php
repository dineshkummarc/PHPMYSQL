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
<div id="table">
<table>
<tr>
<th> Applying User </th>
<th> Action </th>
</tr>
<form action="Affirmation.php" method="POST">
<?php
require_once('config.php');
$conn = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
if($conn->connect_error > 0)  
{
	die("connection failed:  ". $conn->connect_error);
}
$id = $_SESSION['id'];
$query = "SELECT senderid FROM approval WHERE status='pending' AND recipientid=?";
$stmt = $conn->stmt_init();
$stmt->prepare($query);
$stmt->bind_param('i',$id);
$stmt->execute();
$stmt->bind_result($senderid);
$stmt->store_result();
$rows = $stmt->num_rows;
$conn1 = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
if($rows > 0)
{
	while($stmt->fetch())
	{
		// the code for to find the name of the person who has send the notification
		$query1 = "SELECT Name FROM user WHERE userid=?";
		$stmt1 = $conn1->stmt_init();
		$stmt1->prepare($query1);
		$stmt1->bind_param('i',$senderid);
		$stmt1->execute();
		$stmt1->bind_result($name);
		while($stmt1->fetch())
		{
		?>
        	<tr>
            <td><?php echo htmlspecialchars($name); ?></td>
            <td><input type="submit" name="accept" value="Accept"></td>
            <input type="hidden" name="sender" value="<?php echo $senderid; ?>">
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
