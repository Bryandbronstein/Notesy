<?php
require_once("../database/db_connection.php");
session_start();

$db = new DBHandler();
$conn = $db->getConnection();

$type = $_GET["type"];

switch ($type) {
    case "Login":
        $username = $_GET["username"];
        $password = $_GET["password"];

        $sql = 'SELECT * FROM bb389.userdata WHERE username = :user AND password = :pass';
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':user', $username, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $password, PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        if($results["username"] == $username && $results["password"] == $password) {
            $_SESSION['username'] = $results['username'];
            $_SESSION['fname'] = $results['fname'];
            $response = true;
        }else{
            $response = array();
            $error = "Username or password is incorrect, please try again";
            array_push($response, $error);
        }

        echo $response;
        break;

    case "Logout":
        session_destroy();
        $response = true;
        echo $response;
        break;

    case "Register":
        $firstname = $_GET["firstname"];
        $lastname = $_GET["lastname"];
        $username = $_GET["username"];
        $email = $_GET["email"];
        $password = $_GET["password"];
        $response = register($firstname, $lastname, $username, $email, $password);
        echo $response;
        break;

}
//  This function will send a login request message to Db through RabbitMQ
function login($username, $password)
{

    return $returnedValue;
}

//  This function will send register request to RabbitMQ
function register($firstname, $lastname, $username, $email, $password)
{
    $request = array();

    $request['type'] = "Register";
    $request['firstname'] = $firstname;
    $request['lastname'] = $lastname;
    $request['username'] = $username;
    $request['password'] = $password;
    $request['email'] = $email;

    $returnedValue = createClientRequest($request);

    return $returnedValue;
}



