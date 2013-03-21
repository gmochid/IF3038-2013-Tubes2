<?php
	include_once dirname(__FILE__).'\..\include.php';

	$dbg = new DBGetter();
    if($_GET['action'] == 'assignee') {
    	$task = new Task($_GET['taskid']);
    	$assignees = $dbg->getUsersFromCategory($task->categoryID);
		
		// generate all username asociated with task
		$users = $task->getUsers();
		$usernames = array();
		foreach ($users as $user) {
			$usernames[] = $user->username;
		}
		
		// remove user that already assignee
		$res = array();
		foreach ($assignees as $assignee) {
			if(!in_array($assignee->username, $usernames)) {
				$res[] = $assignee->username;
			}
		}
		
		// query the associated username
		/*
		$q = $_GET['q'];
		$hints = array();
		foreach ($res as $r) {
			if(strlen($q) <= strlen($r)) {
				if(strtolower($q) == strtolower(substr($r, 0, strlen($q)))) {
					$hints[] = $r;
				}
			}
		}
		 */
		
		print_r(json_encode($res));
    } else if($_GET['action'] == 'tag') {
    	$task = new Task($_GET['taskid']);
		
    	$res = $task->getTags();
		$task_tags = array();
		foreach ($res as $value) {
			$task_tags[] = $value->tagname;
		}
		
		// generate all tag
		$tags = $dbg->getAllTag();
		$tagnames = array();
		foreach ($tags as $tag) {
			$tagnames[] = $tag->tagname;
		}
		$tagnames = array_unique($tagnames);
		
		// remove tag that already exist
		$res = array();
		foreach ($tagnames as $tagname) {
			if(!in_array($tagname, $task_tags)) {
				$res[] = $tagname;
			}
		}
		
		// query the associated tag
		/*
		$q = $_GET['q'];
		$hints = array();
		foreach ($res as $r) {
			if(strlen($q) <= strlen($r)) {
				if(strtolower($q) == strtolower(substr($r, 0, strlen($q)))) {
					$hints[] = $r;
				}
			}
		}
		*/
		
		print_r(json_encode($res));
    } 
?>