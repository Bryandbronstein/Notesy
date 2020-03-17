<?php
require_once("db_connection.php");

$db = new DBHandler();
$conn = $db->getConnection();

	if(isset($_POST['edit'])) {

	    $editedTitle = $_POST['title']; $editedDate = $_POST['date']; $editedDesc = $_POST['desc']; 

	    $sql = "UPDATE bb389.todos 
	    SET duedate = :duedate, notetitle = :title, message = :descr
	    WHERE notetitle = :title";
	    $stmt = $conn->prepare($sql);

	    $stmt->bindParam(':duedate', $editedDate, PDO::PARAM_STR);
	    $stmt->bindParam(':title', $editedTitle, PDO::PARAM_STR);
	    $stmt->bindParam(':descr', $editedDesc, PDO::PARAM_STR);
	    $stmt->execute(); 

	}else if(isset($_POST['delete'])) {
	  
	    $deletedTitle = $_POST['title'];

	    $sql = 'DELETE FROM bb389.todos WHERE notetitle = :title';
	    $stmt = $conn->prepare($sql);

	    $stmt->bindParam(':title', $deletedTitle, PDO::PARAM_STR);
	    $stmt->execute(); 

	}else if(isset($_POST['complete'])) {
	  
	    $completeTitle = $_POST['title']; 

	    $sql = "UPDATE bb389.todos 
	    SET isdone = 1
	    WHERE notetitle = :title";
	    $stmt = $conn->prepare($sql);

	    $stmt->bindParam(':title', $completeTitle, PDO::PARAM_STR);
	    $stmt->execute(); 
	}else if(isset($_POST['incomplete'])) {
	  
	    $completeTitle = $_POST['title']; 

	    $sql = "UPDATE bb389.todos 
	    SET isdone = 0
	    WHERE notetitle = :title";
	    $stmt = $conn->prepare($sql);

	    $stmt->bindParam(':title', $completeTitle, PDO::PARAM_STR);
	    $stmt->execute(); 
	}

header("Location: home.php");
?>