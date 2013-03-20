<?php
    include_once dirname(__FILE__).'\..\include.php';
    
    class Attachment implements BaseModel {
    	/**
		 * CONSTRUCTOR
		 */
		function __construct($id) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `attachment` WHERE `attachmentID` = '%s';";
			$stmt = sprintf($format, $id);
			$result = mysqli_query($db, $stmt);
			
			if(mysqli_num_rows($result) > 0) {
				$row = $result->fetch_row();
				
				$this->setData($row[1], $row[2], $row[3]);
			}
			$this->id = $id;
			
			$db->close();
		}
		
		/* METHOD */
		public function setData($taskid, $filename, $type) {
			$this->taskid = $taskid;
			$this->filename = $filename; 
			$this->type = $type;
    	}
		
		public function getPath() {
			return $GLOBALS['ATTACHMENT_PATH'] . $this->filename;
		}
		
		/* DATABASE FUNCTION UTILITY */
		public function addOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "INSERT INTO `attachment`  
				(`attachmentID`, `taskID`, `filename`, `type`) VALUES 
				('%s', '%s', '%s', '%s');";
			$stmt = sprintf($format, $this->id, $this->taskid, $this->filename, $this->type);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function editOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "UPDATE `attachment` SET `taskID` = '%s', `filename` = `%s`, type = `%s` WHERE `attachment`.`attachmentID` = '%s';";
			$stmt = sprintf($format, $this->taskid, $this->filename, $this->type, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function deleteOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `attachment` WHERE `attachment`.`attachmentID` = '%s';";
			$stmt = sprintf($format, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		
		var $id;
		var $taskid;
		var $filename; 
		var $type;
	}
?>
