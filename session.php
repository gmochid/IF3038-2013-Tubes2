<?php
	include_once dirname(__FILE__).'\include.php';

	
	if($_SERVER['REQUEST_METHOD'] == 'post') {
		if($_GET['action'] == 'login') {
			$user = new User($_POST['username']);
			if($user->fullname == "") {
				echo "User not found<br>";
				echo "<a href='index.html'>return</a>";
			} else if($user->authenticate($_POST['password'])) {
				session_start();
				$_SESSION['username'] = $_GET['username'];
				header('Location: src/dashboard.php');
			} else {
				echo "Password not match<br>";
				echo "<a href='index.html'>return</a>";
			}
		} else {
			session_start();
		}
	} else if($_GET['action'] == 'create') {
		session_start();
		$_SESSION['username'] = $_GET['username'];
		header('Location: src/dashboard.php');
    } else {
    	session_start();
    	session_destroy();
		unset($_SESSION['username']);
		header('Location: index.php');
    }
?>