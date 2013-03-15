<?php
    include_once 'include.php';
    
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
				
				$this->setData($row[1], $row[2]);
			}
			$this->id = $id;
			
			$db->close();
		}
		
		/* METHOD */
		public function setData($taskid, $filepath) {
			$this->taskid = $taskid;
			$this->filepath = $filepath; 
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
		
		/* DATABASE FUNCTION UTILITY */
		public function addOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "INSERT INTO `attachment`  
				(`attachmentID`, `taskID`, `filepath`) VALUES 
				('%s', '%s', '%s');";
			$stmt = sprintf($format, $this->id, $this->taskid, $this->filepath);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function editOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "UPDATE `attachment` SET `taskID` = '%s', `filepath` = `%s` WHERE `attachment`.`attachmentID` = '%s';";
			$stmt = sprintf($format, $this->taskid, $this->filepath, $this->id);
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
		var $filepath; 
	}
?>
