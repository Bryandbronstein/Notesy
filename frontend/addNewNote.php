<?php
    require_once("db_connection.php");

    $db = new DBHandler();
    $conn = $db->getConnection();

    $title = $_POST['title']; $date = $_POST['date']; $desc = $_POST['desc']; 
    $currentDate = date("d/m/y");

    $sql = "INSERT INTO bb389.todos (owneremail, createddate, duedate, notetitle, message, isdone)
    VALUES (:user, :currentDate, :dueDate, :title, :descr, 0)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':user', $_COOKIE["USER"], PDO::PARAM_STR);
    $stmt->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
    $stmt->bindParam(':dueDate', $date, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':descr', $desc, PDO::PARAM_STR);
    $stmt->execute(); 

    header("Location: home.php");
?>