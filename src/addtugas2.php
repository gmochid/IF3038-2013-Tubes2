<?php
	include_once dirname(__FILE__).'\..\include.php';
	
	session_start();
	
	$task = new Task(DB_IDGenerator('task'));
	
	$task->username = $_SESSION['username'];
	$task->categoryID = $_POST['categoryID'];
	$task->deadline = $_POST['deadline'];
	$task->taskname = $_POST['name'];
	$task->status = 0;
	$task->addOnDB();
	
	// TAG
	$task->setTags($_POST['tag']);
	
	// ASSIGNEE
	$users = $_POST['assignee'] . ','. $_SESSION['username'];
	$task->setUsers($users);
	
	// ATTACHMENT
	if ($_FILES["attachment"]["error"] == 0) {
		$attachment = new Attachment(DB_IDGenerator('attachment'));
		$attachment->taskid = $task->id;
		$attachment->filename = "att_" . $task->id . "_" . $_FILES["attachment"]["name"];
		move_uploaded_file($_FILES["attachment"]["tmp_name"], $attachment->getPath());
		$attachment->addOnDB();
	}
	
    header(sprintf("Location: dashboard.php?taskid=%s", $task->id));
?>