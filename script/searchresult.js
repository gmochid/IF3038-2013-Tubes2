/**
 * @author gmochid
 */

function sendStatus(taskid) {
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		}
	}
	
	xmlhttp.open("GET","rinciantugasAJAX.php?action=status&taskid=" + taskid,true);
	xmlhttp.send();
}
