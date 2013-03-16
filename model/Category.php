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
				
				$this->setData($row[1]);
			}
			$this->id = $id;
			
			$db->close();
		}
		
		/* METHOD */
		public function setData($name) {
			$this->name = $name; 
    	}
		
		/* DATABASE FUNCTION UTILITY */
		public function addOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "INSERT INTO `category`  
				(`categoryID`, `categoryname`) VALUES 
				('%s', '%s');";
			$stmt = sprintf($format, $this->id, $this->name);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function editOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "UPDATE `category` SET `name` = '%s' WHERE `category`.`categoryID` = '%s';";
			$stmt = sprintf($format, $this->name, $this->id);
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
	}
?>