<?php
	include_once 'include.php';
	
    class DBGetter {
    	public function getAllComment() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `comment` WHERE 1;";
			$result = mysqli_query($db, $format);
			
			while($row = $result->fetch_row()) {
				$comments[] = new Comment($row[0]);
			}
			
			$db->close();
			
			return $comments;
		}
		
    	public function getAllCategory() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `category` WHERE 1;";
			$result = mysqli_query($db, $format);
			
			while($row = $result->fetch_row()) {
				$categories[] = new Category($row[0]);
			}
			
			$db->close();
			
			return $categories;
		}
		
		public function getAllTask() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `task` WHERE 1;";
			$result = mysqli_query($db, $format);
			
			while($row = $result->fetch_row()) {
				$tasks[] = new Task($row[0]);
			}
			
			$db->close();
			
			return $tasks;
		}
		
		public function getAttachmentFromTaskID($taskid) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `attachment` WHERE `taskID` = '%s';";
			$stmt = sprintf($format, $taskid);
			$result = mysqli_query($db, $format);
			
			while($row = $result->fetch_row()) {
				$attachments[] = new Attachment($row[0]);
			}
			
			$db->close();
			
			return $attachments;
		}
    	
		public function getCategoriesFromUser($username) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `category_user` WHERE `username` = '%s';";
			$stmt = sprintf($format, $username);
			$result = mysqli_query($db, $stmt);
			
			while($row = $result->fetch_row()) {
				$categories[] = new Category($row[0]);
			}
			
			$db->close();
			
			return $categories;
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
		
		public function getTagsFromTaskID($taskid) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `tag` WHERE `taskID` = '%s';";
			$stmt = sprintf($format, $taskid);
			$result = mysqli_query($db, $stmt);
			
			while($row = $result->fetch_row()) {
				$tags[] = new Tag($row[0], $row[1]);
			}
			
			$db->close();
			
			return $tags;
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
		
		public function getUsersFromCategory($categoryid) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `category_user` WHERE `categoryID` = '%s';";
			$stmt = sprintf($format, $categoryid);
			$result = mysqli_query($db, $stmt);
			
			while($row = $result->fetch_row()) {
				$categories[] = new User($row[0]);
			}
			
			$db->close();
			
			return $categories;
		}
    }
?>