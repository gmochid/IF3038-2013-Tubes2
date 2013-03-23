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
				
				$this->setData($row[1], $row[2], $row[3], $row[4], $row[5]);
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
		
		public function getCategory() {
			return new Category($this->categoryID);
		}
		
		public function getTags() {
			$dbg = new DBGetter();
			return $dbg->getTagsFromTaskID($this->id);
		}
		
		public function getAttachments() {
			$dbg = new DBGetter();
			return $dbg->getAttachmentFromTaskID($this->id);
		}
		
		public function getUsers() {
			$dbg = new DBGetter();
			return $dbg->getUsersFromTaskID($this->id);
			
		}
		
		public function getComments() {
			$dbg = new DBGetter();
			return $dbg->getCommentsFromTaskID($this->id);
		}
		
		public function setTags($tags) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `tag` WHERE `tag`.`taskID` = '%s';";
			$stmt = sprintf($format, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$arr_tags = explode(',', $tags);
			foreach ($arr_tags as $tag) {
				$format = "INSERT INTO `tag` (`taskID`, `tagname`) VALUES ('%s','%s');";
				$stmt = sprintf($format, $this->id, $tag);
				$result = mysqli_query($db, $stmt);
			}
			
			$db->close();
		}
		
		public function setUsers($users) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `task_user` WHERE `task_user`.`taskID` = '%s';";
			$stmt = sprintf($format, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$arr_user = explode(',', $users);
			foreach ($arr_user as $user) {
				$u = new User($user);
				if($u->fullname == null)
					continue;
				if($u->isCategoried($this->categoryID)) {
					echo "a";
					$format = "INSERT INTO `task_user` (`taskID`, `userID`) VALUES ('%s','%s');";
					$stmt = sprintf($format, $this->id, $user);
					$result = mysqli_query($db, $stmt);
				}
			}
			
			$db->close();
		}
		
		public function addUser($username) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "INSERT INTO `task_user` (`taskID`, `userID`) VALUES ('%s','%s');";
			$stmt = sprintf($format, $this->id, $username);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		
		public function addTag($tagname) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "INSERT INTO `tag` (`taskID`, `tagname`) VALUES ('%s','%s');";
			$stmt = sprintf($format, $this->id, $tagname);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		
		public function deleteUser($username) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `task_user` WHERE `taskID` = '%s' AND `userID` = '%s';";
			$stmt = sprintf($format, $this->id, $username);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		
		public function deleteTag($tagname) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `tag` WHERE `taskID` = '%s' AND `tagname` = '%s';";
			echo sprintf($format, $this->id, $tagname);
			$stmt = sprintf($format, $this->id, $tagname);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
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
