<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Notesy User Page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" />
    <script src="script.js"></script>
</head>
<body>
<?php
require_once("../database/db_connection.php");

$db = new DBHandler();
$conn = $db->getConnection();
    $user = $_POST['user']; $pass = $_POST['pass'];

    $sql = 'SELECT * FROM bb389.userdata WHERE username = :user AND password = :pass';
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':user', $user, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row["username"] == $user && $row["password"] == $pass){
            $fname = $row["fname"];
            $lname = $row["lname"];
            $college = $row["college"];
            $major = $row["major"]; 
            
    	        if(isset($_COOKIE['USER'])){
    			}else{
    				setcookie("USER", $user, time() + (86400), "/");
    				$_COOKIE['USER'] = $user;
    			}
    	        
    	        if(isset($_COOKIE['FNAME'])){
    			}else{
    				setcookie("FNAME", $fname, time() + (86400), "/");
    				$_COOKIE['FNAME'] = $fname;
    			}

    	        if(isset($_COOKIE['LNAME'])){
    			}else{
    				setcookie("LNAME", $lname, time() + (86400), "/");
    				$_COOKIE['LNAME'] = $lname;
    			}

    	        if(isset($_COOKIE['COLLEGE'])){
    	    		
    			}else{
    				setcookie("COLLEGE", $college, time() + (86400), "/");
    				$_COOKIE['COLLEGE'] = $college;
    			}        

    	        if(isset($_COOKIE['MAJOR'])){
    	    		
    			}else{
    				setcookie("MAJOR", $major, time() + (86400), "/");
    				$_COOKIE['MAJOR'] = $major;
    			}
            ?>
                <h2><?php echo $_COOKIE["FNAME"];?>'s Profile</h2>

                <div class="form">

                    <p><strong>First Name:</strong> <?php echo $_COOKIE["FNAME"];?><br><br>
                    <strong>Last Name:</strong> <?php echo $_COOKIE["LNAME"]; ?><br><br>
                    <strong>College:</strong> <?php echo $_COOKIE["COLLEGE"]; ?><br><br>
                    <strong>Major:</strong> <?php echo $_COOKIE["MAJOR"]; ?>
                    </p>

                    <button type="button" class="signupBtn" onclick="window.location.href='signedOut.php'">Sign Out</button>

                    <?php   
                    $sql = 'SELECT * FROM bb389.todos WHERE owneremail = :user AND isdone = 0';
                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':user', $_COOKIE["USER"], PDO::PARAM_STR);
                    $stmt->execute();
                    $todoList = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $sql = 'SELECT * FROM bb389.todos WHERE owneremail = :user AND isdone = 1';
                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':user', $_COOKIE["USER"], PDO::PARAM_STR);
                    $stmt->execute();
                    $doneList = $stmt->fetchAll();
                    ?>

                    <table class="notes">
                        <caption>Incomplete Notes</caption>
                        <tr>
                            <th class="addNote" id="edit" onclick="displayIdModal();">&#9874;</th>
                            <th>Title</th>
                            <th>Due Date</th>
                            <th>Message</th>
                            <th class="addNote" id="add" onclick="displayModal();">+</th>
                        </tr>
                        <?php foreach($todoList as $row) : ?>
                        <tr >
                        	<td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['notetitle']; ?></td>
                            <td><?php echo $row['duedate']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                        </tr>
                        <?php endforeach;?>
                    </table>

                    <!--Create Note Modal-->
                    <div class="modal" id="modal">
                        <div class="modalContent">
                          <h2 class="modalh2">Create a New Note</h2>
                            <form action="addNewNote.php" method="POST">
                                <div class="formNoBorder">
                                    <label for="title">Note Title:</label>
                                    <input type="text" placeholder="Go to Grocery Store" name="title" id="title" required autofocus>

                                    <label for="date">Due Date:</label>
                                    <input type="date" placeholder="05/10/19" name="date" id="date" required>

                                    <label for="desc">Description:</label>
                                    <input type="text" placeholder="Eggs, milk, butter, cheese, meat, and lettuce" name="desc" id="desc" >

                                    <input style="margin: 0 auto;" type="submit" name="submit" value="Create Note" class="signupBtn">

                                </div>
                            </form>
                        </div>
                    </div>

                    <!--Edit Note Modal-->
					<div class="modal" id="idmodal">
					    <div class="modalContent" id="incompModalContent">
					      <h2 class="modalh2">Get Note Id</h2>
                          <p class="bio">Enter the ID for the note you want to edit below</p>
					        <form action="editNote.php" method="POST">
					            <div class="formNoBorder">
					                <label for="id">ID:</label><br>
					                <input class="idModalInput" type="number" name="id" id="id" required autofocus >
					               
					                <input type="submit" name="submit" value="Submit" class="signupBtn">

					            </div>
					        </form>
					    </div>
					</div>

                    <!--Edit Completed Note Modal-->
                    <div class="modal" id="compidmodal">
                        <div class="modalContent" id="compModalContent">
                          <h2 class="modalh2">Get Completed Note Id</h2>
                          <p class="bio">Enter the ID for the completed note you want to edit below</p>
                            <form action="editCompletedNote.php" method="POST">
                                <div class="formNoBorder">
                                    <label for="id">ID:</label><br>
                                    <input class="idModalInput" type="number" name="id" id="id" required autofocus >
                                    <input type="submit" name="submit" value="Submit" class="signupBtn">
                                </div>
                            </form>
                        </div>
                    </div>


                    <table class="notes" id="doneList">
                        <caption>Completed Notes</caption>
                        <tr>
                            <th class="addNote" id="edit" onclick="displayCompIdModal();" style="color: #F4A527;">&#9874;</th>
                            <th>Title</th>
                            <th>Due Date</th>
                            <th>Message</th>       
                        </tr>
                        <?php foreach($doneList as $row) : ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['notetitle']; ?></td>
                            <td><?php echo $row['duedate']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                        </tr>
                        <?php endforeach;?>
                    </table>

                </div>

        <?php
        }else{
        ?>
            <div style="text-align: center;">
                <p>Username or password is incorrect.  Please try again</p>
                <a style='color: #3087ff;' href='index.html'>Back to login page</a>
            </div>
        <?php    
        }
        ?>

<script type="text/javascript">
var modal = document.getElementById("modal");
var idmodal = document.getElementById("idmodal");
var compidmodal = document.getElementById("compidmodal");

function displayModal() {
  modal.style.display = "block";
}

function displayIdModal() {
  idmodal.style.display = "block";
}

function displayCompIdModal() {
  compidmodal.style.display = "block";
}

window.onclick = function(event) {
  if (event.target == idmodal) {
    idmodal.style.display = "none";
  }else if (event.target == compidmodal) {
    compidmodal.style.display = "none";
  }else if (event.target == modal) {
    modal.style.display = "none";
  }
}


</script>

</body>
</html>