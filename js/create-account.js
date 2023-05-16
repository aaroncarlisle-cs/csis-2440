//Event listeners for input fields
let username = document.getElementById('username');
username.addEventListener('input', validate);
let pass = document.getElementById('password');
password.addEventListener('input', validate);
let pass2 = document.getElementById('password2');
password2.addEventListener('input', validate);

function validate(event)
{
	//Regex 
	let uexFormat = /[a-zA-Z]/;
	let pex8 = /.{8,}/;
	let pexNum = /(?=.*\d)/;
	let userNotBlank = false;
	let pexFormat = false;
	let pexMatch = false;
	
	//Get selected input
	let srcID = event.srcElement.attributes[0].nodeValue;
	
	//Verify username is not blank and contains at least one letter
	if(srcID == 'username')
	{
		document.getElementById('userBlank').innerText = ((uexFormat.test(username.value)) ? "" : "Username must contain at least 1 letter!");
		document.getElementById('userBlank').className = ((uexFormat.test(username.value)) ? "regex-valid" : "regex-invalid");
	}
	
	//Verify password format is correct
	if(srcID == 'password')
	{
		document.getElementById('pass8').innerText = ((pex8.test(password.value)) ? "" : "Password must contain a at least 8 characters.");
		document.getElementById('pass8').className = ((pex8.test(password.value)) ? "regex-valid" : "regex-invalid");
		document.getElementById('passNum').innerText = ((pexNum.test(password.value)) ? "" : "Password must contain at least 1 number.");
		document.getElementById('passNum').className = ((pexNum.test(password.value)) ? "regex-valid" : "regex-invalid");
		
		//If user has matching passwords and then decides to change pass1 field
		if (pass2.value) 
		{
			document.getElementById('passMatch').innerText = ((pass.value == pass2.value) ? "" : "Passwords do not match");
			document.getElementById('passMatch').className = ((pass.value == pass2.value) ? "regex-valid" : "regex-invalid");
		}
	}
	
	//Verify password 2 field matches
	if(srcID == 'password2')
	{
		document.getElementById('passMatch').innerText = ((pass.value == pass2.value) ? "" : "Passwords do not match");
		document.getElementById('passMatch').className = ((pass.value == pass2.value) ? "regex-valid" : "regex-invalid");
	}	
	
	//Verify above conditions without srcID 
	if (uexFormat.test(username.value)) userNotBlank = true;
	else userNotBlank = false;
	if (pex8.test(password.value) == true && pexNum.test(password.value) == true) pexFormat = true;
	else pexFormat = false;
	if (pass.value == pass2.value) pexMatch = true;
	else pexMatch = false;
	
	//If all conditions remain true, submit enabled. Else, submit disabled.
	if(userNotBlank == true && pexFormat == true && pexMatch == true) document.getElementById('submit').disabled = false;
	else document.getElementById('submit').disabled = true;
}