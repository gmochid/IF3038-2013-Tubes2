<?php
    include_once 'include.php';
	
	$user = new User("a", "a", "a", "a", "2012-03-03", "a", "a");
	$user->addOnDB();
	echo "DONE"; 
?>