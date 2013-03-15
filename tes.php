<?php
    include_once 'include.php';
	
	$db = mysqli_connect($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
			
	$format = "SELECT * FROM `tag` WHERE `taskID` = '%s';";
	$stmt = sprintf($format, '1');
	$result = mysqli_query($db, $stmt);
	
	while($row = $result->fetch_row()) {
		$tags[] = new Tag($row[0], $row[1]);
	}
	
	$db->close();
	
	return $tags;
?>