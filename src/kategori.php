<?php
	include_once dirname(__FILE__).'\..\include.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link rel='stylesheet' type="text/css" href="../style/Design.css"/>
</head>

<body class="categoryfont">

<?php
	if(isset($_GET['categoryID'])) {
		printCategory(new Category($_GET['categoryID']));
		printf('<div align="right" ><form action="#"> <input type="submit" value="Save" class="buttonbox2"/></form> </div>');
	} else {
		printAllCategories();
	}
?>

</body>
</html>

<?php
	function printCategory($category) {
		$dbg = new DBGetter();
		$tasks = $dbg->getTasksFromCategory($category->id);
		
		printf('<h4 align="center">%s</h4>', $category->name);
    	printf('Click on task name to see task detail.');

		printf('<table width="580" border="1" cellspacing="0" cellpadding="0">');

		$i = 0;
		$lim = (sizeof($tasks) % 2 == 0) ? sizeof($tasks) : sizeof($tasks) - 1 ;
		for(; $i < ($lim / 2); $i++) {
			printf("<tr>\n");
			
			for($j = 0; $j < 2; $j++) {
				printf('<td width="26" class="black"><input type="checkbox" /></td>');
				$task = $tasks[$i * 2 + $j];
				printf('<td width="264" class="%s"><a href="Rincian-tugas.html" target="_parent" class="ordintext">%s</a><br />',
						(($i + $j) % 2 == 0) ? 'blue' : 'green', $task->taskname);
				printf('Deadline : <b class="redtext">%s</b><br />', $task->deadline);
				printf('Kategori : %s<br />', $task->getCategory()->name);
				$tags = $task->getTags();
				foreach ($tags as $key => $value) {
					printf('#%s ', $value->tagname);
				}
				printf('</td>');
			}
	
			printf("</tr>\n");
		}
		if(sizeof($tasks) % 2 != 0) {
			printf("<tr>\n");
			printf('<td width="26" class="black"><input type="checkbox" /></td>');
			$task = $tasks[$i * 2];
			printf('<td width="264" class="%s"><a href="Rincian-tugas.html" target="_parent" class="ordintext">%s</a><br />',
					(($i) % 2 == 0) ? 'blue' : 'green', $task->taskname);
			printf('Deadline : <b class="redtext">%s</b><br />', $task->deadline);
			printf('Kategori : %s<br />', $task->getCategory()->name);
			$tags = $task->getTags();
			foreach ($tags as $key => $value) {
				printf('#%s ', $value->tagname);
			}
			printf('</td>');
			printf("</tr>\n");
		}
		printf('</table>');
	}

	function printAllCategories() {
		$dbg = new DBGetter();
		$categories = $dbg->getAllCategory();
		foreach ($categories as $category) {
			if(sizeof($dbg->getTasksFromCategory($category->id)) == 0) {
				continue;
			}
			printCategory($category);
		}
		printf('<div align="right" ><form action="#"> <input type="submit" value="Save" class="buttonbox2"/></form> </div>');
	}
?>
