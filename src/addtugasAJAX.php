<?php
	include_once dirname(__FILE__).'\..\include.php';

	$dbg = new DBGetter();
    if($_GET['action'] == 'assigneeHint') {
    	$assignees = $dbg->getUsersFromCategory($_GET['categoryid']);
		
		$res = array();
		foreach ($assignees as $assignee) {
			$res[] = $assignee->username;
		}
		
		print_r(json_encode($res));
    }
?>