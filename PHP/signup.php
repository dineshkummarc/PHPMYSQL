<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Nexus In The Hood</title>
<link href="../CSS/loginStyle.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../JavaScript/jquery-1.11.3.min.js"></script>
</head>
<body>
<script>
var autocomplete,placeSearch;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};
function initAutocomplete(){
  autocomplete = new google.maps.places.Autocomplete(
      (document.getElementById('autocomplete')),{types: ['geocode']});
  autocomplete.addListener('place_changed', addressFill);
}
function addressFill()
{
  var place = autocomplete.getPlace();
  document.getElementById("lat").disabled=false;
  document.getElementById("lon").disabled=false;
  for (var component in componentForm) 
  {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }
  for (var i = 0; i < place.address_components.length; i++) 
  {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) 
	{
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
	  document.getElementById("lat").value=position.coords.latitude;
	  document.getElementById("lon").value=position.coords.longitude;
    });
  }
}
$(document).ready(function(e) {
	  $('#formid').on('keyup keypress', function(e) {
	  var code = e.keyCode || e.which;
	  if (code == 13) { 
		e.preventDefault();
		return false;
	  }
	});
});
</script>
<div id= "Container">
	<div id= "Header"> </div>
		<div id= "MainBody">
			<div id="form2">
				<form id="formid" action="#" method="post">
                <table id="formtable">
                	<tr>
					<td>UserName:</td>
                    <td><input type="text" id="username" name="username"></td>
                    </tr>
                    <tr>
                    <td>Name:</td>
                    <td><input type="text" id="name" name="name"></td>
                    </tr>
                    <tr>
                    <td>Password:</td>
                    <td><input type="password" id="pass" name="pass"></td>
                    </tr>
                    <tr>
                    <td>Renter-Password:</td>
                    <td><input type="password" id="repass" name="repass"></td>
                    </tr>
                    <tr>
                    <td>DOB:</td>
                    <td><input type="date" id="date" name="dob"></td>
                    </tr>
                    <tr>
                    <div id="address">
                    <td>Address:</td>
                    	<td><input id="autocomplete" placeholder="Enter Address" onFocus="geolocate()" type="text">
                    	</input></td>
                    </tr>
                    <tr>
        				<td>Street:</td>
                    	<td><input id="street_number" name="street_number" disabled="true"></td>
                        <td>Street Address:</td>
        				<td><input id="route" name="route" disabled="true"></td>
      				</tr>
                    <tr>
                    	<td>Apt.No:</td> 
                    	<td><input id="apt" name="apt"></td>
                    </tr>
                    <tr>
                    <td>City:</td> 
                    <td><input id="locality" name="city" disabled="true"></td>
                    </tr>
                    <tr>
                    <td>State:</td> 
                    <td><input id="administrative_area_level_1" name="state" disabled="true"></td>
                    </tr>
                    <tr>
                    <td>Zip:</td>
                    <td><input id="postal_code" name="zip" disabled="true"></td>
                    </tr>
                    <tr>
                    <td>Country:</td>
                    <td><input id="country" name="country" disabled="true"></td>
                    </tr>
                    </div>
                    </tr>
                    <tr>
                    <td>Latitude:</td>
                    <td><input type="text" id="lat" name="lat" disabled="true"></td>
                    </tr>
                    <tr>
                    <td>Longitude:</td>
                    <td><input type="text" id="lon" name="lon" disabled="true"></td>
                    </tr>
                    <tr>
                    <td>About You:</td>
                    <td><textarea id="area" name="about"></textarea></td>
                    </tr>
                    <tr>
                    <td><input type="submit" name="submit" value="submit"> </td>
                    </tr>
                    </table>
                  </form>
			</div>
			<div id="map"></div>
   	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYv6xAN1ZFMLwhCSVNYySN4jF1Um13sNc&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
</body>
</html>
<?php
	require_once('config.php');
	$conn = new mysqli(host,DatabaseUser,DatabasePassword,DatabaseName);
	if($conn->connect_error > 0)  
	{
		die("connection failed:  ". $conn->connect_error);
	}
	if(isset($_POST['submit']))
	{
		include('findid.php');
		$_SESSION['user'] = $_POST['username'];
		$_SESSION['pass'] = $_POST['pass'];
		$id = $_SESSION['id'];
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['date'] = $_POST['dob'];
		//echo "the value name is:".$name."\n";
		//echo "the value of dob is:".$date."\n";
		//echo "the value of streetNumber is:".$_POST['street_number'];
		$_SESSION['address'] = $_POST['apt']." ".$_POST['street_number']." ".$_POST['route'];
		$_SESSION['city']= $_POST['city'];
		$_SESSION['zip'] = $_POST['zip'];
		$_SESSION['about'] = $_POST['about'];
		$_SESSION['state'] = $_POST['state'];
		//echo "the value of address is:".$address."\n";
		//echo "the value of zip is:".$zip."\n";
		//echo "the value of about is:".$about."\n";
		//echo "the value of state is:".$state."\n";
		include('insertUserlogin.php');
		include('insertUser.php');	
	}
?>