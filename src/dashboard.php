<?php
	include_once dirname(__FILE__).'\..\include.php';
    $dbg = new DBGetter();
	$categories = $dbg->getAllCategory();
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>My Dashboard</title>
    <link rel='stylesheet' type="text/css" href="../style/Design.css"/>
    <script type="text/javascript" src="../script/validation.js"> </script>
</head>

<body class="main">

<!-- HEADER -->

<div id="header">
<img src="../images/images/Header_3_ip_01.gif"/><img src="../images/images/Header_3_ip_02.gif" /><a href="Dashboard.html"><img src="../images/images/Header_3_ip_03.gif" /></a><img src="../images/images/Header_3_ip_04.gif"  />

  	<ul class="navigation">
		<li> <a href="Dashboard.html"> Dashboard </a> </li>
        <li> <a href="profile.html"> Profile </a> </li>
        <li> <a href="../Index.html"> Log Out </a> </li>
    </ul>
  
</div>
    
<!-- Content -->
<div class="kategori">
	<h3> Kategori </h3>
    <ul class="navigation2">
    <li> <a href="kategori.php" target="categoryframe"> All </a></li>
    <?php
    	foreach ($categories as $category) {
			printf('<li> <a href="kategori.php?categoryID=%s" target="categoryframe">%s</a></li>', $category->id, $category->name);
		}
    ?>
    </ul>
    <div align="right" >
    <a href="#category_form" id="register_pop">
        <input name="Button" type="button" value="Add Category" class="categbutton"/> </a>
        
        <!-- Popup add category -->
        
        <a href="#x" class="overlay" id="category_form"> </a>
        
        <div class="popup">
            <h2>Add Category</h2>
            <p>Please enter category name and user who can access it</p>
            <div>
                <label for="category">Category Name</label>
                <input type="text" id="category" value="" />
            </div>
            <div>
                <label for="name">User (Seperated with ";")</label>
                <input type="text" id="name" value="" />
            </div>
            <form action="#">
            <div align="right">
            	<input type="submit" value="Add Category" />
     		</div>
			</form>
            <a class="close" href="#close"></a>
  		</div>
        
	</div>
</div>


<!-- Content -->
<div>
	<iframe src="kategori.php" width="605" height="340" name="categoryframe">  </iframe>
</div>


    
<!-- Footer -->
<div class="footer">This Website is created for Internet Programming Assignment<br />
    By <a href="http://www.facebook.com/patrick.ltobing?fref=ts" target="_blank">Patrick Lumban Tobing</a>, <a href="http://www.facebook.com/hanif.eridaputra" target="_blank">Hanif Eridaputra</a>, <a href="http://www.facebook.com/novriady.saputra.3?fref=ts" target="_blank">Novriady Saputra</a><br />
    Februari 2013
</div>

</body>
</html>
