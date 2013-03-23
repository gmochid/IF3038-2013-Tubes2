<?php
    include_once dirname(__FILE__).'\..\include.php';
	
	$dbg = new DBGetter();
	if(!isset($_GET['taskid'])) {
		die('RATA DENGAN TANAH!');
	}
	
	$task = new Task($_GET['taskid']);
	
	$attachments = $dbg->getAttachmentFromTaskID($task->id);
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Task Detail</title>
<link rel='stylesheet' type="text/css" href="../style/Design.css"/>
<script type="text/javascript" src="../script/global.js"></script>
<script type="text/javascript" src="../script/calendar.js"></script>
<script type="text/javascript" src="../script/validation.js"></script>
<script type="text/javascript" src="../script/rinciantugas.js"></script>
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

<h2 align="center"><?php echo $task->taskname; ?></h2>
<div align="left">
   	<p>
   		<a>Deadline :</a> <br>
   		<a id="rincian-deadline"></a><br>
   		<form action="rinciantugas2.php?taskid=<?php echo $task->id; ?>" method="post" id="rincianinput-form-deadline">
	   		<input type="date" name="deadline" id="rincianinput-deadline" value="<?php echo $task->deadline; ?>"><br>
	   		<input type="submit" id="rincianinput-deadline-submit" value="Submit"><br>
   		</form>
   	    <br><a>Asignee :</a><br> 
   	    <ul>
   	    	<?php
				$users = $task->getUsers();
				
				foreach ($users as $user) {
					printf("<li id='rincian-assignee-%s'>%s ", $user->username, $user->fullname);
					printf('<a class="delete" href="rinciantugas2.php?taskid=%s&action=delete&username=%s">(delete)</a>', $task->id, $user->username);
					printf("</li>");
				}
   	    	?>
   	    	
   	    </ul>
   	    <form action="rinciantugas2.php?taskid=<?php echo $task->id; ?>" method="post" id="rincianinput-form-assignee">
   	    	<input type="text" id="rincianinput-assignee" name="assignee" list="hintlist-assignee"><br>
   	    	<datalist id="hintlist-assignee"></datalist>
   	    	<input type="submit" id="rincianinput-assignee-submit" value="submit"><br>
   	    </form>
   	    <br><a>Tag :</a><br>
   	    <ul>
   	    	<?php
				$tags = $task->getTags();
				
				foreach ($tags as $tag) {
					printf("<li id='rincian-tag-%s'>%s ", $tag->tagname, $tag->tagname);
					printf('<a class="delete" href="rinciantugas2.php?taskid=%s&action=delete&tagname=%s">(delete)</a>', $task->id, $tag->tagname);
					printf('</li>');
				}
   	    	?>
   	    </ul>
   	    <form action="rinciantugas2.php?taskid=<?php echo $task->id; ?>" method="post" id="rincianinput-form-tag">
   	  		<input type="text" id="rincianinput-tag" name="tag" list="hintlist-tag"><br>
   	  		<datalist id="hintlist-tag"></datalist>
   	  		<input type="submit" id="rincianinput-tag-submit" value="submit"><br>
   	  	</form>
   	  	<br><a>Status :<br>
	   	<input type="checkbox" name="status" onclick="sendStatus()" value="1" <?php echo $task->status == 1 ? "checked":""; ?> > DONE<br>
    </p>
    <p> Attachment: </p>
    <?php
    	foreach ($attachments as $attachment) {
    		if($attachment->type == 'file') {
				printf('<a href="%s"> %s </a>', $attachment->getPath(), $attachment->filename);
				printf('<br>');
			} else if($attachment->type == 'image') {
				printf('%s<br><img src="%s"></img>' , $attachment->filename, $attachment->getPath());
				printf('<br>');
			} else if($attachment->type == 'video') {
				
				printf('%s<br><video width="320" height="240" controls>', $attachment->filename);
				printf('<source src="%s">', $attachment->getPath());
				printf('</video>');
				printf('<br>');
			}
			printf('<a class="delete" href="rinciantugas2.php?action=delete&attachmentid=%s">(delete)</a>', $attachment->id);
			printf('<br><br>');
		}
    ?>
    <form action="rinciantugas2.php?taskid=<?php echo $task->id; ?>" method="post" id="rincianinput-form-attachment"  enctype="multipart/form-data">
    	<div class="field1">File</div>
    	<div class="iinfo" id="taskfile_info"></div>
   	  	<div class="fieldfile">
			<input type="file" id="taskfile" name="attachment"/>
		</div>
		<div class="fieldhelp">
			*.txt;*.doc;*.docx;*.pdf
		</div>
		<div class="field1">
			Pic
		</div>
        <div class="iinfo" id="taskpic_info"></div>
		<div class="fieldfile">
			<input type="file" id="taskpic" name="attachment2"/>
		</div>
		<div class="fieldhelp">
			*.png;*.bmp;*.jpg;*.jpeg
		</div>
		<div class="field1">
			Video
		</div>
        <div class="iinfo" id="taskvideo_info"></div>
		<div class="fieldfile">
			<input type="file" id="taskvideo" name="attachment3"/>
		</div>
		<div class="fieldhelp">
			*.mp4;*.avi;*.wmv;*.mkv
		</div>
   	  	<input type="submit" id="rincianinput-status-submit" value="submit"><br>
   	</form>
	<input type="button" value="Edit Task" class="buttonbox2" id="rincianbutton-edit" onclick="edittask()"/>
	<input type="button" value="Save Task" class="buttonbox2" id="rincianbutton-save" onclick="savetask()"/>
</div>

<hr noshade="noshade" />

<div class="taskdate">
	22/2/2013
</div>
<div class="uploader">
	Uploaded By Hyosung
</div>

<form id="comment_form" action="#">
	<h3>Add a Comment</h3>
	<div>
   		<textarea rows="5" cols="61"></textarea>
 	</div>
	<div>
   		<input type="submit" value="Submit Comment!" class="submitbutton" />
    </div>
</form>

<div>
	<div class="commentbox">
    	<img src="../images/user2.jpg" class="commentuser"/>
        <div class="nameuser">@Jieun 1 minute ago Said :</div>
        <div class="comment">Lah kok ada gue di atas?</div>
    </div>
    <div class="commentbox">
    	<img src="../images/ibuOADTSPD3HEK.gif" class="commentuser"/>
        <div class="nameuser">@Hyosung 3 minute ago Said :</div>
        <div class="comment">Yaudah gak usah bikin, gue juga udah pasrah :(</div>
    </div>
    <div class="commentbox">
    	<img src="../images/User3.gif" class="commentuser"/>
        <div class="nameuser">@Hyorin 5 minute ago Said :</div>
        <div class="comment">Hemm, tadi gue cari di internet pusing lah liatnya -_-</div>
    </div>
    <div class="commentbox">
    	<img src="../images/2507626_460s.jpg" class="commentuser"/>
        <div class="nameuser">@Dedel 13 minute ago Said :</div>
        <div class="comment">Nanya dong, cara bikin media queries gimana sih?</div>
    </div>
</div>

</div>

<!-- Footer -->
<div class="footer">This Website is created for Internet Programming Assignment<br />
    By <a href="http://www.facebook.com/patrick.ltobing?fref=ts" target="_blank">Patrick Lumban Tobing</a>, <a href="http://www.facebook.com/hanif.eridaputra" target="_blank">Hanif Eridaputra</a>, <a href="http://www.facebook.com/novriady.saputra.3?fref=ts" target="_blank">Novriady Saputra</a><br />
    Februari 2013
</div>
<a id="rinciantugas-taskid"><?php echo $task->id; ?></a>

</body>
</html>