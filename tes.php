<?php
    include_once 'include.php';
	
	$dbg = new DBGetter();
	$x = $dbg->getAllComment();
	print_r($x[1]);
?>