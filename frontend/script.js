function formValidateSignUp() {
	//declare variables
	var fname, lname, user, pass, college, major;

	//assign values to variables
	fname = document.getElementById("fname").value;
	lname = document.getElementById("lname").value;
	user = document.getElementById("user").value;
	pass = document.getElementById("pass").value;
	college = document.getElementById("college").value;
	major = document.getElementById("major").value;


	//check users input after submission
	if (fname =="" || lname =="" || user =="" || pass =="" || college =="" || major ==""){
		alert("Please do not leave any fields blank");
	}if (validateNames(fname,lname)){
		alert("Please do not input a number into the any of the name fields");
	}if (validateEmail(user) == false){
		alert("Please enter a valid email address as your username")
	}

}

function formValidateLogIn(){
	var user, pass;

	user = document.getElementById("user").value;
	pass = document.getElementById("pass").value;

	if (user =="" || pass ==""){
	alert("Please do not leave any fields blank");
	}if (validateEmail(user) == false){
		alert("Please enter a valid email address as your username")
	}


}

//checks if any numbers were enetered into any of the names fields
function validateNames(fname,lname) {
	var hasNumber
	return hasNumber = /\d/.test(fname);
	return hasNumber = /\d/.test(lname);	
}

//checks if the email address enetered was of a valid syntax
function validateEmail(email) {
	var valid 
	return valid = /\S+@\S+\.\S+/.test(email);
}

