<!DOCTYPE HTML>
<html lang="en">
<head>
	 
<title>Tech_Watch User Page</title>
<meta charset="utf-8">
</head>
<body>

<?php
$servername = "sql1.njit.edu";
$username = "bb389";
$password = "3eZSnGDm8";
$dbname = "bb389"; 

try {
    $conn = new PDO("mysql:host=$servername;$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 

    //query
    $query = "select * from bb389.accounts
		where id < 6";
	$statement = $conn->prepare($query);
	$statement->execute();

	$results = $statement->fetchAll();
	$length = count($results);

	foreach($results as $record){
		echo 
		"<table style='border: 1px solid black; width: 100%; table-layout: fixed;'>
			<tr>
				<td> $record[0] </td> 
				<td> $record[1] </td> 
				<td> $record[2] </td> 
				<td> $record[3] </td> 
				<td> $record[4] </td> 
				<td> $record[5] </td> 
				<td> $record[6] </td> 
				<td> $record[7] </td> 
			</tr>
		</table>";
	}
	echo "<p>Number of Records Returned: $length</p>";


}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}


?>

</body>
</html>


