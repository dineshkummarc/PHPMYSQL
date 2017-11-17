function validation_for_signup()
{

	var check_username = /^[a-zA-Z0-9_]{3,16}$/;
	var check_name = /^[a-zA-Z]{3,16}$/;
	var check_address = /^[a-zA-Z0-9_]{3,20}$/;
	var check_dob = /^[0-9_]{8}$/;
	var check_city = /^[a-zA-Z]{4,20}$/;
	var check_zip = /^[0-9]{5}$/;
	if(document.signup.username.value=="")
	{
		alert("Please Enter User name");
		document.signup.username.focus();
		return false;
	}
	else if(check_username.test(document.signup.username.value) == false)
	{
		alert('Invalid  username');
		document.signup.username.focus();
		return false;
	}
	if(document.signup.password.value=='')
	{
		alert("Please enter Password.");
		document.signup.password.focus();
		return false;
	}
	else if(document.signup.password.value.length<6)
	{
		alert("Password is too short.");
		document.signup.password.focus();
		return false;
	}
	if(document.signup.passconf.value=='')
	{
		alert("Please confirm Password.");
		document.signup.passconf.focus();
		return false;
	}
	else if(document.signup.password.value!=document.signup.passconf.value)
	{
		alert("Password does not match.");
		document.signup.password.focus();
		return false;
	}
   
	if(document.signup.name.value=="")
	{
		alert("Please Enter Name");
		document.signup.name.focus();
		return false;
	}
	else if(check_name.test(document.signup.name.value) == false)
	{
		alert('Invalid  name');
		document.signup.name.focus();
		return false;
	}
	
	if (document.signup.dob.value=="")
	{
		alert ("Please Enter Date of Birth");
		document.signup.dob.focus();
		return false;
	}
	else if(check_dob.test(document.signup.dob.value) == false)
	{
		alert('YYYYMMDD');
		document.signup.dob.focus();
		return false;
	}
	
	if (document.signup.address.value=="")
	{
		alert ("Please Enter Apt No. and Street");
		document.signup.address.focus();
		return false;
	}
	else if (check_address.test(document.signup.address.value) == false)
	{
		alert ('Invalid Address Field');
		document.signup.address.focus();
		return false;
	}
	
	if (document.signup.city.value == "")
	{
		alert ("Please Enter your City");
		document.signup.city.focus();
		return false;
	}
	else if (check_city.test(document.signup.city.value) == false)
	{
		alert ('Invalid City field');
		document.signup.city.focus();
		return false;
	}
	
	if (document.signup.about.value == "")
	{
		alert ("Please Enter something about yourself");
		document.signup.about.focus();
		return false;
	}
	
	if (document.signup.zip.value == "")
	{
		alert ("Please Enter Zip Code");
		document.signup.zip.focus();
		return false;
	}
	else if (check_zip.test(document.signup.zip.value) == false)
	{
		alert ('Invalid Zip field');
		document.signup.city.focus();
		return false;
	}
}
