<?php
    include_once 'include.php';
	
	$user = new User('a');
	$user->setData('a', 'b', 'c', 'Jakarta', '2012-04-05', 'a@a.a', '');
	$user->addOnDB();
?>