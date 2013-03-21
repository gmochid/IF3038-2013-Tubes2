<?php
	include_once dirname(__FILE__).'\..\include.php';

	$task = new Task($_GET['taskid']);
	
	print_r($_FILES);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
    	if(isset($_POST['deadline'])) {
    		$task->deadline = $_POST['deadline'];
		} else if(isset($_POST['tag'])) {
			$task->addTag($_POST['tag']);
		} else if(isset($_POST['assignee'])) {
			$task->addUser($_POST['assignee']);
		} else if(isset($_POST['status'])) {
			$task->status = $_POST['status'];
		} else if(isset($_FILES['attachment'])) {
			$attachment = new Attachment(DB_IDGenerator('attachment'));
			$attachment->taskid = $task->id;
			$attachment->type = 'file';
			$attachment->filename = "att_" . $task->id . "_" . $_FILES["attachment"]["name"];
			move_uploaded_file($_FILES["attachment"]["tmp_name"], $attachment->getPath());
			$attachment->addOnDB();
		} else if(isset($_FILES['attachment2'])) {
			$attachment = new Attachment(DB_IDGenerator('attachment'));
			$attachment->taskid = $task->id;
			$attachment->type = 'image';
			$attachment->filename = "att_" . $task->id . "_" . $_FILES["attachment2"]["name"];
			move_uploaded_file($_FILES["attachment2"]["tmp_name"], $attachment->getPath());
			$attachment->addOnDB();
		} else if(isset($_FILES['attachment3'])) {
			$attachment = new Attachment(DB_IDGenerator('attachment'));
			$attachment->taskid = $task->id;
			$attachment->type = 'video';
			$attachment->filename = "att_" . $task->id . "_" . $_FILES["attachment3"]["name"];
			move_uploaded_file($_FILES["attachment3"]["tmp_name"], $attachment->getPath());
			$attachment->addOnDB();
		}
		$task->editOnDB();
    } else if($_SERVER["REQUEST_METHOD"] == "GET") {
    	if($_GET['action'] == 'delete') {
    		if(isset($_GET['username'])) {
    			$task->deleteUser($_GET['username']);
    		} else if(isset($_GET['tagname'])) {
    			$task->deleteTag($_GET['tagname']);
    		} else if(isset($_GET['attachmentid'])) {
    			$attachment = new Attachment($_GET['attachmentid']);
				$attachment->deleteOnDB();
    		} 
    	}
    }
	
	//header(sprintf("Location: rinciantugas.php?taskid=%s", $task->id));
?>