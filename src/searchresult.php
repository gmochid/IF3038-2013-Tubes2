<?php
    include_once dirname(__FILE__).'\..\include.php';
    $dbg = new DBGetter();
	
	$result_category = array();
	$result_task = array();
	$result_user = array();
	
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    	print_r($_POST);
    	$q = $_POST['query'];
		
		$categories = $dbg->getAllCategory();
		foreach ($categories as $category) {
			if(strlen($q) <= strlen($category->name)) {
				if(strtolower($q) == strtolower(substr($category->name, 0, strlen($q)))) {
					$result_category[] = $category;
				}
			}
		}
		
		$tasks = $dbg->getAllTask();
		foreach ($tasks as $task) {
			if(strlen($q) <= strlen($task->taskname)) {
				if(strtolower($q) == strtolower(substr($task->taskname, 0, strlen($q)))) {
					$result_task[] = $task;
				}
			}
		}
		
		$users = $dbg->getAllUser();
		print_r($users);
		foreach ($users as $user) {
			echo '<br>'.$user->username;
			if(strlen($q) <= strlen($user->username)) {
				if(strtolower($q) == strtolower(substr($user->username, 0, strlen($q)))) {
					$result_user[] = $user;
				}
			}
		} 
    }
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Search Result</title>
<link rel='stylesheet' type="text/css" href="../style/Design.css"/>
<script type="text/javascript" src="../script/global.js"></script>
<script type="text/javascript" src="../script/calendar.js"></script>
<script type="text/javascript" src="../script/validation.js"></script>
<script type="text/javascript" src="../script/searchresult.js"></script>
</head>

<body class="main">
<!-- Header -->
<div id="header">
<img src="../images/images/Header_3_ip_01.gif"/><img src="../images/images/Header_3_ip_02.gif" /><a href="Dashboard.html"><img src="../images/images/Header_3_ip_03.gif" /></a><img src="../images/images/Header_3_ip_04.gif"  />

  	<ul class="navigation">
		<li> <a href="dashboard.php"> Dashboard </a> </li>
        <li> <a href="profile.html"> Profile </a> </li>
        <li> <a href="../Index.html"> Log Out </a> </li>
    </ul>
  <form method="post" action="searchresult.php">
    	<input type="text" name="query" />
    	<input type="submit" value="Search" />
    </form>
</div>

<!-- Content -->
<div class="TaskBoard">

	<div align="left">
		<h4>Category</h4>
		<?php
			foreach ($result_category as $category) {
				printf('<p>');
				printf('Nama    : %s<br>', $category->name);
				printf('Creator : %s<br>', $category->getCreator()->username);
				printf('</p>');
			}
		?>
		
		<h4>Task</h4>
		<?php
			foreach ($result_task as $task) {
				printf('<p>');
				printf('Nama     : %s<br>', $task->taskname);
				printf('Deadline : %s<br>', $task->deadline);
				$tags = $task->getTags();
				printf('Tag      : ');
				foreach ($tags as $tag) {
					printf('%s,', $tag->tagname);
				}
				printf('<br>');
				printf('Status   : ');
				?>
				<input type="checkbox" name="status" onclick="sendStatus(<?php printf("'%s'", $task->id); ?>)" value="1" <?php echo $task->status == 1 ? "checked":""; ?> > DONE<br>
				<?php
				printf('<br>');
				printf('</p>');
			}
		?>
		
		<h4>User</h4>
		<?php
			foreach ($result_user as $user) {
				printf('<p>');
				printf('Username : %s<br>', $user->username);
				printf('Fullname : %s<br>', $user->fullname);
				printf('Avatar   : <br>');
				printf('<img src="%s"></img>', $GLOBALS['AVATAR_PATH'].$user->avatar_path);
				printf('</p>');
			}
		?>
	</div>
   	
</div>

<!-- Footer -->
<div class="footer">This Website is created for Internet Programming Assignment<br />
    By <a href="http://www.facebook.com/patrick.ltobing?fref=ts" target="_blank">Patrick Lumban Tobing</a>, <a href="http://www.facebook.com/hanif.eridaputra" target="_blank">Hanif Eridaputra</a>, <a href="http://www.facebook.com/novriady.saputra.3?fref=ts" target="_blank">Novriady Saputra</a><br />
    Februari 2013
</div>

</body>
</html>
