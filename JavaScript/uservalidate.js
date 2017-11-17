function validate_user()
{
	var check_username = /^[a-zA-Z0-9_]{3,16}$/;
	if(document.getElementById("uname").value == "")
	{
		alert("Please Enter Username");
		document.getElementById("uname").focus();
		return false;
	}
	else if(check_username.test(document.getElementById("uname").value) == false)
	{
		alert('Invalid  username');
		document.getElementById("uname").focus();
		return false;
	}
}
function validate_pass()
{
	var check_pass = /^[a-zA-Z0-9_]{8,10}$/;
	if(document.getElementById("pass").value == "")
	{
		alert("Please Enter Password");
		document.getElementById("pass").focus();
		return false;
	}
	else if(check_pass.test(document.getElementById("pass").value) == false)
	{
		alert("Invalid Password");
		document.getElementById("pass").focus();
		return false;
	}
}