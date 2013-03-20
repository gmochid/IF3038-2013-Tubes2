/**
 * @author gmochid
 */
window.onload = function() {
	$id("rincianinput-form-tag").style.visibility = 'hidden';
	$id("rincianinput-form-deadline").style.visibility = 'hidden';
	$id("rincianinput-form-assignee").style.visibility = 'hidden';
	$id("rincianinput-form-status").style.visibility = 'hidden';
	$id("rincian-deadline").innerHTML = $id("rincianinput-deadline").value;
	$id("rincianbutton-save").style.visibility = 'hidden';
	
	hideClass('delete');
}

function edittask() {
	$id("rincianinput-form-tag").style.visibility = 'visible';
	$id("rincianinput-form-deadline").style.visibility = 'visible';
	$id("rincianinput-form-assignee").style.visibility = 'visible';
	$id("rincianinput-form-status").style.visibility = 'visible';
	$id("rincian-deadline").style.visibility = 'hidden';
	
	$id("rincianbutton-save").style.visibility = 'visible';
	$id("rincianbutton-edit").style.visibility = 'hidden';	
	
	showClass('delete');
}

function savetask() {
	$id("rincianinput-form-tag").style.visibility = 'hidden';
	$id("rincianinput-form-deadline").style.visibility = 'hidden';
	$id("rincianinput-form-assignee").style.visibility = 'hidden';
	$id("rincianinput-form-status").style.visibility = 'hidden';
	$id("rincian-deadline").style.visibility = 'visible';
	
	$id("rincianbutton-save").style.visibility = 'hidden';
	$id("rincianbutton-edit").style.visibility = 'visible';	
	
	hideClass('delete');
}

function hideClass(classname) {
	elements = getElementsByClassName(document, classname);
	for(i = 0; i < elements.length; i++) {
		elements[i].style.visibility = 'hidden';
	}
}

function showClass(classname) {
	elements = getElementsByClassName(document, classname);
	for(i = 0; i < elements.length; i++) {
		elements[i].style.visibility = 'visible';
	}
}
