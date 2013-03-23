<?php
	include_once dirname(__FILE__).'\include.php';

    if($_GET['action'] == 'create') {
    	echo session_start()."<br>";
		$a = $_GET['username'];
		$_SESSION['username'] = $a; 
		echo session_id();
		//header('Location: tes.php');
    } else {
    	session_destroy();
		unset($_SESSION['username']);
    }
?>