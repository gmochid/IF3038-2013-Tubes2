<?php
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
		
		/* DATABASE FUNCTION UTILITY */
		function addOnDB() {
			
		}
		function editOnDB() {
			
		}
		function deleteOnDB() {
			
		}
		
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