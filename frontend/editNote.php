<!DOCTYPE HTML>
<html lang="en">
<head>
     
<title>Edit Notes</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico" />
<script src="script.js"></script>

</head>
<body>
<?php
require_once("db_connection.php");

$db = new DBHandler();
$conn = $db->getConnection();

$id = $_POST['id'];

$sql = 'SELECT * FROM bb389.todos WHERE id = :id';
$stmt = $conn->prepare($sql);

$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();
$noteToEdit = $stmt->fetch();

$notetitle = $noteToEdit['notetitle'];
$duedate = $noteToEdit['duedate'];
$desc = $noteToEdit['message'];

?>
    <form action="uploadEditedNote.php" method="POST">
        <h2 style="color: white;  font-size: 2.8rem;">Edit an Incomplete Note</h2>
        <div class="form">
            <label for="title">Note Title:</label>
            <input type="text" value="<?php echo $notetitle ?>" name="title" id="title">

            <label for="date">Due Date:</label>
            <input type="text" value="<?php echo $duedate ?>" name="date" id="date">

            <label for="desc">Description:</label>
            <input type="text" value="<?php echo $desc ?>" name="desc" id="desc">
            
            <div class="btnArea">
                <button type="submit" name="edit" class="signupBtn">&#9874; Update Note</button>
                <button type="submit" name="delete"  class="loginBtn">&#9851; Delete Note</button>
                <button style="width: 220px" type="submit" name="complete" class="completeBtn">&#10004; Mark as Complete</button>
            </div>

        </div>
    </form>

</body>
</html>





