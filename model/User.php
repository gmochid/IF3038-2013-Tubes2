<?php
	include_once 'include.php';

    class User implements BaseModel {
    	/**
		 * CONSTRUCTOR
		 */
		function __construct($username) {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "SELECT * FROM `user` WHERE `username` = '%s';";
			$stmt = sprintf($format, $username);
			$result = mysqli_query($db, $stmt);
			
			if(mysqli_num_rows($result) > 0) {
				$row = $result->fetch_row();
				
				$this->setData($row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
			}
			$this->username = $username;
			
			$db->close();
		}
		
		/* METHOD */
		public function setData($password, $fullname, $birthplace, $birthdate, $email, $avatar_path) {
			$this->password = $password;
			$this->fullname = $fullname;
			$this->birthplace = $birthplace;
			$this->birthdate = $birthdate;
			$this->email = $email;
			$this->avatar_path = $avatar_path;
			
			// $avatar harusnya diinisialisasi di sini 
    	}
		
		public function authenticate($password) {
			return $this->password == $password;
		}
		
		/* DATABASE FUNCTION UTILITY */
		public function addOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "INSERT INTO `user`  
				(`username`, `password`, `fullname`, `birthplace`, `birthdate`, `email`, `avatar`) VALUES 
				('%s', '%s', '%s', '%s', '%s', '%s', '%s');";
			$stmt = sprintf($format, $this->username, $this->password, $this->fullname, $this->birthplace, $this->birthdate,
				$this->email, $this->avatar_path);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function editOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "UPDATE `user` SET `password` = '%s',  
				`fullname` = '%s', `birthplace` = '%s', `birthdate` = '%s', 
				`email` = '%s', `avatar` = '%s' WHERE `user`.`username` = '%s';";
			$stmt = sprintf($format, $this->password, $this->fullname, $this->birthplace, $this->birthdate,
				$this->email, $this->avatar_path, $this->username);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		public function deleteOnDB() {
			$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
			$format = "DELETE FROM `user` WHERE `user`.`username` = '%s';";
			$stmt = sprintf($format, $this->username);
			$result = mysqli_query($db, $stmt);
			
			$db->close();
		}
		
		var $username;
		var $password;
		var $fullname;
		var $birthplace;
		var $birthdate;
		var $email;
		var $avatar_path;
		var $avatar;
    }
?>