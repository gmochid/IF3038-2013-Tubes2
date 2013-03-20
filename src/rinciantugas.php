<?php
    include_once dirname(__FILE__).'\..\include.php';
	
	$dbg = new DBGetter();
	if(!isset($_GET['taskid'])) {
		die('RATA DENGAN TANAH!');
	}
	
	$task = new Task($_GET['taskid']);
	
	$attachments = $dbg->getAttachmentFromTaskID($task->id);
	print_r($attachments);
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Task Detail</title>
<link rel='stylesheet' type="text/css" href="../style/Design.css"/>
<script type="text/javascript" src="../script/calendar.js"></script>
<script type="text/javascript" src="../script/validation.js"></script>
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
  
</div>

<!-- Content -->
<div class="TaskBoard">

<h2 align="center"><?php echo $task->taskname; ?></h2>

<div align="center">

   	<p>
   		Deadline : <span id="deadline">
   			<?php echo date("j F Y", strtotime($task->deadline)); ?>
   			</span><br />
   	    Asignee : <span id="asignee">
   	    	<?php
				$users = $task->getUsers();
				$arr = Array();
				
				foreach ($users as $user) {
					$arr[] = $user->fullname;
				}
				echo implode(", ", $arr);
   	    	?>
   	    	</span><br />
   	  Tag : <span id="tag">
			<?php
				$tags = $task->getTags();
				$arr = Array();
				
				foreach ($tags as $tag) {
					$arr[] = "#" . $tag->tagname;
				}
				echo implode(", ", $arr);
   	    	?>
   	  	</span>
    </p>    
</div>

<div align="center">
    <p> Attachment: </p>
    <?php
    	foreach ($attachments as $attachment) {
    		if($attachment->type == 'file') {
				printf('<a href="%s"> %s </a> <br><br>' , $attachment->getPath(), $attachment->filename);
			} else if($attachment->type == 'image') {
				printf('%s <br> <img src="%s"></img> <br><br>' , $attachment->filename, $attachment->getPath());
			} else if($attachment->type == 'video') {
				
				printf('%s<br><video width="320" height="240" controls>', $attachment->filename);
				printf('<source src="%s">', $attachment->getPath());
				printf('</video><br><br>');
			}
		}
    ?>
</div>

<div>
	<input type="button" value="Edit Task" class="buttonbox2" onclick="edittask()"/>
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


</body>
</html>