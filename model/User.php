<?php
	include_once 'include.php';

    class User implements BaseModel {
    	/**
		 * Construtor
		 */
    	function __construct($username, $password, $fullname, $birthplace, $birthdate, $email, $avatar_path) {
    		$this->username = $username;
			$this->password = $password;
			$this->fullname = $fullname;
			$this->birthplace = $birthplace;
			$this->birthdate = $birthdate;
			$this->email = $email;
			$this->avatar_path = $avatar_path;
			
			// $avatar harusnya diinisialisasi di sini 
    	}
		
		/* METHOD */
		//semua method ditaruh disini
		
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
			
			$format = "UPDATE `user` SET `password` = '%s', " + 
				"`fullname` = '%s', `birthplace` = '%s', `birthdate` = '%s'," + 
				" `email` = '%s', `avatar` = '%s' WHERE `user`.`username` = '%s';";
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
		
		/* GETTER AND SETTER */
		//tulis di sini
		
		private $username;
		private $password;
		private $fullname;
		private $birthplace;
		private $birthdate;
		private $email;
		private $avatar_path;
		private $avatar;
    }
?>