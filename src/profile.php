<?php
    include_once dirname(__FILE__).'\..\include.php';
	$dbg = new DBGetter();
	
	$user = new User($_GET['username']);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>My Profile</title>
	<link rel='stylesheet' type="text/css" href="../style/Design.css"/>
    <script type="text/javascript" src="../script/validation.js"> </script>
</head>
</head>

<body class="main">

<!-- Header -->
<div>
<img src="../images/images/Header_3_ip_01.gif"/><img src="../images/images/Header_3_ip_02.gif" /><a href="Dashboard.html"><img src="../images/images/Header_3_ip_03.gif" /></a><img src="../images/images/Header_3_ip_04.gif"  />

  <ul class="navigation">
		<li> <a href="dashboard.php"> Dashboard </a> </li>
        <li> <a href="profile.php?username=<?php echo $_SESSION['username']; ?>"> Profile </a> </li>
        <li> <a href="../Index.html"> Log Out </a> </li>
    </ul>
  
</div>

<!-- Content -->
<div class="kategori2">
	<h2> Profile </h2>
    <div><img src="<?php echo $GLOBALS['AVATAR_PATH'].$user->avatar_path; ?>" class="profpic"/></div>
    <p><div align="right"> <input type="button" value="Edit Profile" class="buttonbox1"/> </div></p>
</div>
    
<div class="contentprofile">
	
    <h3 align="center"><?php echo $user->fullname; ?></h3>
	<p align="center">
      Born in <?php echo $user->birthplace; ?> at <?php echo $user->birthdate; ?><br />
      Email : <?php echo $user->email; ?></p>
      <hr noshade="noshade" />
      <p class="paragraph2">Task :</p>
      <ul class="paragraph2">
      	<?php
      		$tasks = $dbg->getTasksFromUsername($user->username);
			foreach ($tasks as $task) {
				if($task->status == 0)
					printf('<li><a href="rinciantugas.php?taskid=%s">%s</a></li>', $task->id, $task->taskname);
			}
      	?>
        </ul>
	<p class="paragraph2">Done :</p>
      <ul class="paragraph2">
      	<?php
      		$tasks = $dbg->getTasksFromUsername($user->username);
			foreach ($tasks as $task) {
				if($task->status == 1)
					printf('<li><a href="rinciantugas.php?taskid=%s">%s</a></li>', $task->id, $task->taskname);
			}
      	?>
      </ul>


</div>


        

<!-- FOoter -->
    
<div class="footer">This Website is created for Internet Programming Assignment<br />
    By <a href="http://www.facebook.com/patrick.ltobing?fref=ts" target="_blank">Patrick Lumban Tobing</a>, <a href="http://www.facebook.com/hanif.eridaputra" target="_blank">Hanif Eridaputra</a>, <a href="http://www.facebook.com/novriady.saputra.3?fref=ts" target="_blank">Novriady Saputra</a><br />
    Februari 2013
</div>

</body>
</html>
