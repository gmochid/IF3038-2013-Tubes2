<?php
	include_once dirname(__FILE__).'\..\include.php';

    if($_SERVER["REQUEST_METHOD"] != "POST") {
    	die("RATA");
    }
	
	$task = new Task($_GET['taskid']);
	$task->deadline = $_POST['deadline'];
	$task->setTags($_POST['tag']);
	$task->setUsers($_POST['assignee']);
	$task->status = $_POST['status'];
	$task->editOnDB();
	
	header(sprintf("Location: rinciantugas.php?taskid=%s", $task->id));
?>