<?php
    include_once 'include.php';
    
    class Comment implements BaseModel {
    	/**
		 * CONSTRUCTOR
		 */
		function __construct($id) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `comment` WHERE `commentID` = '%s';";
			$stmt = sprintf($format, $id);
			$result = mysqli_query($db, $stmt);
			
			if(mysqli_num_rows($result) > 0) {
				$row = $result->fetch_row();
				
				$this->setDataTS($row[1], $row[2], $row[3], $row[4]);
			}
			$this->id = $id;
			
			$db->close();
		}
		
		/* METHOD */
		public function setDataTS($taskid, $username, $content, $timestamp) {
			$this->taskid = $taskid;
			$this->username = $username;
			$this->content = $content;
			$this->timestamp = $timestamp; 
    	}
		
		public function setData($taskid, $username, $content) {
			$this->taskid = $taskid;
			$this->username = $username;
			$this->content = $content;
    	}
		
		public function getAllComments() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `comment` WHERE 1;";
			$result = mysqli_query($db, $format);
			
			while($row = $result->fetch_row()) {
				$comments[] = new Comment($row[0]);
			}
			
			$db->close();
			
			return $comments;
		}
		
		public function getCommentsFromUsername($username) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `comment` WHERE `username` = '%s';";
			$stmt = sprintf($format, $username);
			$result = mysqli_query($db, $format);
			
			while($row = $result->fetch_row()) {
				$comments[] = new Comment($row[0]);
			}
			
			$db->close();
			
			return $comments;
		}
		
		public function getCommentsFromTaskID($taskid) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `comment` WHERE `taskID` = '%s';";
			$stmt = sprintf($format, $taskid);
			$result = mysqli_query($db, $format);
			
			while($row = $result->fetch_row()) {
				$comments[] = new Comment($row[0]);
			}
			
			$db->close();
			
			return $comments;
		}
		
		/* DATABASE FUNCTION UTILITY */
		public function addOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "INSERT INTO `comment`  
				(`commentID`, `taskID`, `username`, `content`) VALUES 
				('%s', '%s', '%s', '%s');";
			$stmt = sprintf($format, $this->id, $this->taskid, $this->username, $this->content);
			$result = mysqli_query($db, $stmt);
			
			$format = "SELECT * FROM `comment` WHERE `commentID` = '%s';";
			$stmt = sprintf($format, $id);
			$result = mysqli_query($db, $stmt);
			$row = $result->fetch_row();
			$this->timestamp = $row[4];
			
			$db->close();
		}
		public function editOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "UPDATE `comment` SET `taskID` = '%s', `username` = `%s`, `content` = `%s` WHERE `comment`.`commentID` = '%s';";
			$stmt = sprintf($format, $this->taskid, $this->username, $this->content, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function deleteOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `comment` WHERE `comment`.`commentID` = '%s';";
			$stmt = sprintf($format, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		
		var $id;
		var $taskid;
		var $username;
		var $content;
		var $timestamp; 
	}
?>
