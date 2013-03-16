<?php
    include_once dirname(__FILE__).'\..\include.php';
    
    class Task implements BaseModel {
    	/**
		 * CONSTRUCTOR
		 */
		function __construct($id) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `task` WHERE `taskID` = '%s';";
			$stmt = sprintf($format, $id);
			$result = mysqli_query($db, $stmt);
			
			if(mysqli_num_rows($result) > 0) {
				$row = $result->fetch_row();
				
				$this->setData($row[0], $row[1], $row[2], $row[3], $row[4]);
			}
			$this->id = $id;
			
			$db->close();
		}
		
		/* METHOD */
		public function setData($categoryID, $username, $taskname, $status, $deadline) {
			$this->categoryID = $categoryID;
			$this->username = $username;
			$this->taskname = $taskname;
			$this->status = $status;
			$this->deadline = $deadline; 
    	}
		
		/* DATABASE FUNCTION UTILITY */
		public function addOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "INSERT INTO `task`  
				(`taskID`, `categoryID`, `username`, `taskname`, `status`, `deadline`) VALUES 
				('%s', '%s', '%s', '%s', '%s', '%s');";
			$stmt = sprintf($format, $this->id, $this->categoryID, $this->username, $this->taskname, $this->status, $this->deadline);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function editOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "UPDATE `task` SET `categoryID` = '%s', `username` = '%s', `taskname` = '%s', `status` = '%s', `deadline` = '%s' WHERE `task`.`taskID` = '%s';";
			$stmt = sprintf($format, $this->categoryID, $this->username, $this->taskname, $this->status, $this->deadline, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function deleteOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `task` WHERE `task`.`taskID` = '%s';";
			$stmt = sprintf($format, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		
		var $id;
		var $categoryID;
		var $username;
		var $taskname;
		var $status;
		var $deadline; 
	}
?>
