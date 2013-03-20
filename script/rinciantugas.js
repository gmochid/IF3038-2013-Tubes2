/**
 * @author gmochid
 */
window.onload = function() {
	$id("rincianinput-tag").style.visibility = 'hidden';
	$id("rincianinput-deadline").style.visibility = 'hidden';
	$id("rincianinput-assignee").style.visibility = 'hidden';
	$id("rincian-tag").innerHTML = $id("rincianinput-tag").value;
	$id("rincian-deadline").innerHTML = $id("rincianinput-deadline").value;
	$id("rincian-assignee").innerHTML = $id("rincianinput-assignee").value;
	$id("rincianbutton-save").style.visibility = 'hidden';
}

function edittask() {
	$id("rincianinput-tag").style.visibility = 'visible';
	$id("rincianinput-deadline").style.visibility = 'visible';
	$id("rincianinput-assignee").style.visibility = 'visible';
	$id("rincian-tag").style.visibility = 'hidden';
	$id("rincian-deadline").style.visibility = 'hidden';
	$id("rincian-assignee").style.visibility = 'hidden';
	
	$id("rincianbutton-save").style.visibility = 'visible';
	$id("rincianbutton-edit").style.visibility = 'hidden';	
}
