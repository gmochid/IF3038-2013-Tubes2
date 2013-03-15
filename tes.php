<?php
    include_once 'include.php';
	
	$user = new User('gmochid2');
	$user->setData('a', 'b', 'c', 'Jakarta', '2012-04-05', 'a@a.a', '');
	$user->addOnDB();
?>