<?php
    include_once 'include.php';
    
    class Tag implements BaseModel {
    	/**
		 * CONSTRUCTOR
		 */
		function __construct($taskid, $tagname) {
			$this->taskid = $taskid;
			$this->tagname = $tagname;
		}
		
		/* METHOD */
		public function setData($taskid, $tagname) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "UPDATE `tag` SET `taskID` = '%s', `tagname` = '%s' WHERE `tag`.`taskID` = '%s' AND `tag`.`tagname` = '%s';";
			$stmt = sprintf($format, $taskid, $tagname, $this->taskid, $this->tagname);
			$result = mysqli_query($db, $stmt);
			
			$this->taskid = $taskid;
			$this->tagname = $tagname;
			
			$db->close();
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
		
		/* DATABASE FUNCTION UTILITY */
		public function addOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "INSERT INTO `tag`  
				(`taskID`, `tagname`) VALUES 
				('%s', '%s');";
			$stmt = sprintf($format, $this->taskid, $this->tagname);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function editOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "UPDATE `tag` SET `taskID` = '%s', `tagname` = '%s' WHERE `tag`.`taskID` = '%s' AND `tag`.`tagname` = '%s';";
			$stmt = sprintf($format, $this->taskid, $this->tagname, $this->taskid, $this->tagname);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function deleteOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `tag` WHERE `tag`.`taskID` = '%s' AND `tag`.`tagname` = '%s';";
			$stmt = sprintf($format, $this->taskid, $this->tagname);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		
		var $taskid;
		var $tagname; 
	}
?>
