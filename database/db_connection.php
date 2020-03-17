<?php
class DBHandler{
	private $conn;

	function __construct() {
        $this->connect_db();
    }

    public function getConnection() {
        return $this->conn;
    }

	private function connect_db(){
		$servername = "sql1.njit.edu";
		$username = "bb389";
		$password = "z6nBrDujK";
		$dbname = "bb389";

		try {
		    $temp = new PDO("mysql:host=$servername;$dbname", $username, $password);
		    // set the PDO error mode to exception
		    $temp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $this->conn = $temp;

		}catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
		}
	}
}

?>