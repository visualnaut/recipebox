<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "connect.php"; session_start();
if($_SESSION['open'] != TRUE){header("location:index.php");}
$data = mysql_fetch_array(mysql_query("select username from user where id_user = '$_SESSION[id]'"));
echo"<title>$data[username]'s Profile</title>";
 ?>
<link rel="stylesheet" type="text/css" href="css/user.css" />
<link rel="icon" type="image/png" href="icons/fav.png" />
</head>
<body>

<div class="topbar">
<ul>
<li>My Profile
</li>
<?php 
$q = mysql_fetch_array(mysql_query("select * from user where id_user = '$_SESSION[id]' "));
echo"<li><a href='#'><div class='thumb' style='background:url(img/profile/thumb/$q[imgThumb]);'></div>$q[fName] $q[lName]</a>
<div class='thoption'>"; if($_SESSION['type'] == 'admin'){echo"<a href='admin.php'>Admin Page</a>";} 
echo"<a href='index.php'>Main Page</a>
<a href='#'>Account Option</a>
<a href='action.php?act=logout'>Logout</a>
</div></li>
";
?>

</ul>
</div>

<div class="fullwrap">

<div class="sidebar">
<?php
echo"<h1>$q[fName] $q[lName]</h1>
<div class='propic' style='background:url(img/profile/$q[img]);'>
<span><a href='#'>change picture</a></span>
</div>";
?>
<!-- <ul>
<li><a href=''>opsi 1</a></li>
<li><a href=''>opsi 2</a></li>
<li><a href=''>opsi 3</a></li>
<li><a href=''>opsi 4</a></li>
</ul> -->
</div>

<!-- batas mainwrap wrap -->
<div class="mainwrap">

<div class="hwrap">
<div class="profileinfo">
<span>contact info | <a href='#'>edit</a></span>
<?php
$tgl = $q['birthDate'];
$date = new DateTime($tgl);

echo"<h1>".$date->format('jS \of F Y')."</h1>
<li>Birthday</li>
<h1>$q[jkelamin]</h1>
<li>Gender</li>
<h1>$q[adress]</h1>
<li>Address</li>
<h1>$q[email]</h1>
<li>Personal email</li>
<h1>$q[mobile]</h1>
<li>Personal mobile</li>
<h1>$q[phone]</h1>
<li>Home phone</li>";
?>
</div>
</div>

<!--<div class="hwrap">
<div class="profileinfo">
<span>work info | <a href='#'>edit</a></span>
<h1>Student</h1>
<li>Job Title</li>

<h1>SMKN 1 Cimahi</h1>
<li>Company</li>

<h1>Indonesia</h1>
<li>Work address</li>
</div>
</div> -->

</div>


<div class="mainwrap" style="width:390px">
<div class="hwrap">
<?php
if($_SESSION['type'] == "admin")
{echo"<span>Created Recipes</span>
<div class='scroll'>";
$q = mysql_query("select id_resep, judul, image, tglBuat, kategori from resep, kategori where id_user = '$_SESSION[id]' and resep.id_kategori = kategori.id_kategori");
while($rs = mysql_fetch_array($q)){
$date = new DateTime($rs['tglBuat']);
$reviewer = mysql_num_rows(mysql_query("select * from review where id_resep = $rs[id_resep]"));
$rt = mysql_fetch_array(mysql_query("select SUM(rating) as ratingtotal from review where id_resep = $rs[id_resep]")); 
echo"<div class='favrecbox'>
<div class='favrecimg' style='background:url(img/recipe/$rs[image])'></div>
<a href='recipe.php?id=$rs[id_resep]#judulRes'><h1>$rs[judul]</h1></a>
<label>Dibuat : </label><span>"; echo $date->format('j F, Y')."</span><br />
<label>Kategori : </label><span>$rs[kategori]</span><br />
<label>Rating : </label><span>"; if($reviewer == 0) {echo "N/A";} else { echo round( ($rt['ratingtotal'] / $reviewer), 1, PHP_ROUND_HALF_UP);} echo"</span>
</div>";
	
	}
	echo"</div>";
}
else
{echo"<span>Favorited Recipes</span>";}

?>
<!-- <div class="favrecbox">
<div class="favrecimg" style="background:url(img/milkshake.jpg)"></div>
<a href='#'><h1>Strawberry Milkshake</h1></a>
<span>SUBMITTED BY : <a href=''>kersa</a></span>
<a href='#' title="Delete as favorite"><div class="removebtn">X</div></a>
</div> -->
</div>

</div>

</div>

</body>
</html>