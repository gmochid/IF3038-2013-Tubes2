<?php
    include_once dirname(__FILE__).'\..\include.php';
    
    class Category implements BaseModel {
    	/**
		 * CONSTRUCTOR
		 */
		function __construct($id) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `category` WHERE `categoryID` = '%s';";
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
		public function setData($name, $creatorID) {
			$this->name = $name; 
			$this->creatorID = $creatorID;
		}
		
		public function getCreator() {
			return new User($this->creatorID);
		}
		
		public function setUsers($usernames) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `category_user` WHERE `category_user`.`categoryID` = '%s';";
			$stmt = sprintf($format, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$arr_username = split(';', $usernames);
			foreach ($arr_username as $username) {
				$format = "INSERT INTO `category_user` (`categoryID`, `username`) VALUES ('%s','%s');";
				$stmt = sprintf($format, $this->id, $username);
				$result = mysqli_query($db, $stmt);
			}
			
			$db->close();
		}
		
		/* DATABASE FUNCTION UTILITY */
		public function addOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "INSERT INTO `category`  
				(`categoryID`, `categoryname`, `creatorID`) VALUES 
				('%s', '%s', '%s');";
			$stmt = sprintf($format, $this->id, $this->name, $this->creatorID);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function editOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "UPDATE `category` SET `name` = '%s', `creatorID` = '%s' WHERE `category`.`categoryID` = '%s';";
			$stmt = sprintf($format, $this->name, $this->creatorID, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function deleteOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `category` WHERE `category`.`categoryID` = '%s';";
			$stmt = sprintf($format, $this->id);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		
		var $id;
		var $name; 
		var $creatorID;
	}
?>