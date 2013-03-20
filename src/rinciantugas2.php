<?php
	include_once dirname(__FILE__).'\..\include.php';

	$task = new Task($_GET['taskid']);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
    	if(isset($_POST['deadline'])) {
    		$task->deadline = $_POST['deadline'];
		} else if(isset($_POST['tag'])) {
			$task->addTag($_POST['tag']);
		} else if(isset($_POST['assignee'])) {
			$task->addUser($_POST['assignee']);
		} else if(isset($_POST['status'])) {
			$task->status = $_POST['status'];
		} 
    } else if($_SERVER["REQUEST_METHOD"] == "GET") {
    	if($_GET['action'] == 'delete') {
    		if(isset($_GET['username'])) {
    			$task->deleteUser($_GET['username']);
    		} else if(isset($_GET['tagname'])) {
    			$task->deleteTag($_GET['tagname']);
    		} 
    	}
    }
	
	header(sprintf("Location: rinciantugas.php?taskid=%s", $task->id));
?>