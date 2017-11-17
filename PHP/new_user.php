<?php
session_start();
?>
<!doctype html>
<html>
<head>
<script type="text/javascript" src="../JavaScript/jquery-1.11.3.min.js"></script>
<link href = "../CSS/userStyle.css" rel="stylesheet" type="text/css"/>
<link href = "../CSS/800px.css" rel="stylesheet" type="text/css" media= "screen and (max-width: 800px)"/>
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
<script>
$(document).ready(function(){
	


});
</script>
<div id= "Container">
<div id= "Header"> </div>
<div id= "Menu">
<ul>
<li><a href= "../PHP/logout.php">Logout</a></li>
<li><a href= "../PHP/blockApply.php">Apply to Block</a></li>
<li><a href= "#">Home</a></li>
</ul>
</div>
<div id= "MainBody">
<img id="img" src="../image/<?php echo $_SESSION['user'];?>.jpg">
<div id="content">
<h3>Welcome New User</h3>

</div>
</div>
</div>
</body>
</html>