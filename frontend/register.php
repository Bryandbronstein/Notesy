<!DOCTYPE HTML>
<html lang="en">
<head>
	 
<title>Sign Up Success</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico" />

</head>
<body>
<?php
require_once('db_connection.php');

$db = new DBHandler();
$conn = $db->getConnection();

$user = $_POST['user']; $pass = $_POST['pass']; $fname = $_POST['fname']; 
    $lname = $_POST['lname']; $college = $_POST['college']; $major = $_POST['major'];

$sql = 'INSERT INTO bb389.userdata VALUES (:user, :pass, :fname, :lname, :college, :major)';
$stmt = $conn->prepare($sql);

$stmt->bindParam(':user', $user, PDO::PARAM_STR);
$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
$stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
$stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
$stmt->bindParam(':college', $college, PDO::PARAM_STR);
$stmt->bindParam(':major', $major, PDO::PARAM_STR);

$stmt->execute();


?>
	<h2>Welcome, <?php echo "$fname"?>!</h2>
	<p class="bio">Account registered successfully!<br>Login with your new account below</p>

	<div class="form">

		<form action="home.php" method="POST">

			<label for="user">Username:</label>
			<input type="text" placeholder="example@gmail.com" name="user" id="user" required>

			<label for="pass">Password:</label>
			<input type="password" placeholder="Enter your password here" name="pass" id="pass" required>

			<div class="btnArea">
				<button style="margin: 0 auto;" type="submit"class="loginBtn" onclick="formValidateLogIn();">Log In</button>
			</div>
		</form>
	</div>



</body>
</html>