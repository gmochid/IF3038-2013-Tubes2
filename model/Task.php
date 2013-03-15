<?php
    include_once 'include.php';
    
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
				
				$this->setData($row[1]);
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
		
		public function getAllTasks() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `task` WHERE 1;";
			$result = mysqli_query($db, $format);
			
			while($row = $result->fetch_row()) {
				$tasks[] = new Task($row[0]);
			}
			
			$db->close();
			
			return $tasks;
		}
		
		public function getTasksFromCategory($categoryid) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `task` WHERE `categoryID` = '%s';";
			$stmt = sprintf($format, $categoryid);
			$result = mysqli_query($db, $stmt);
			
			while($row = $result->fetch_row()) {
				$tasks[] = new Task($row[0]);
			}
			
			$db->close();
			
			return $tasks;
		}

		public function getTasksFromTagname($tagname) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `tag` WHERE `tagname` = '%s';";
			$stmt = sprintf($format, $tagname);
			$result = mysqli_query($db, $stmt);
			
			while($row = $result->fetch_row()) {
				$tasks[] = new Task($row[0]);
			}
			
			$db->close();
			
			return $tasks;
		}
		
		public function getTasksFromUsername($username) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `task` WHERE `username` = '%s';";
			$stmt = sprintf($format, $username);
			$result = mysqli_query($db, $stmt);
			
			while($row = $result->fetch_row()) {
				$tasks[] = new Task($row[0]);
			}
			
			$db->close();
			
			return $tasks;
		}
		
		public function getTasksFromUsernameAndStatus($username, $status) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `task` WHERE `username` = '%s' AND `status` = '%s';";
			$stmt = sprintf($format, $status);
			$result = mysqli_query($db, $stmt);
			
			while($row = $result->fetch_row()) {
				$tasks[] = new Task($row[0]);
			}
			
			$db->close();
			
			return $tasks;
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
