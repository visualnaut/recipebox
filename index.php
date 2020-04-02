<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recipe Box</title>
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/jPages.css" />
<link rel="icon" type="image/png" href="icons/fav.png" />
<script src="js/jquery-1.8.3.js"></script>
<script src="js/jPages.min.js"></script>
</head>
<script>
  /* when document is ready */
  $(function(){

    /* iniciate jPages without setting any css animation
     * and setting the fallback fadeIn speed to 500
     */
     $("div.holder").jPages({
      	containerID : "pagecontain",
		perPage : 4,
		fallback : 300,
		first       : "Pertama",
		previous    : "Sebelumnya",
		next        : "Selanjutnya",
		last        : "Terakhir"
    });

   });
  </script>
  
<?php $include = include('connect.php'); 
if (!$include) {
	ob_clean();
    die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');
}
session_start();
if (!isset($_SESSION['open'])) {
    $_SESSION['open'] = FALSE;
}
?>
<body>

<?php include "header.php";
if(!isset( $_GET['view'])){ $_GET['view'] = NULL;}
switch($_GET['view']){
	default :
echo"<div class='featurewrapper'>
<h1>Ideas</h1>";
$query = mysql_query("select id_resep, judul, caption, image, username from resep, user where resep.id_user = .user.id_user order by viewed DESC");
$data = mysql_fetch_array($query);
echo"<div class='feature' style='background:url(img/recipe/$data[image])'>
<a href='recipe.php?id=$data[id_resep]'><h1>$data[judul]</h1></a> 
<span>$data[caption]<p style='font-style:normal'>by $data[username]</p> </span>
</div>";
$max = mysql_num_rows(mysql_query("select id_resep from resep"));
$randid = rand(1, $max);
$tempid = 0;
for($x=0; $x < 2; $x++){
if($randid == $data['id_resep']){$randid = rand(1, $max); if($randid == $tempid){$randid = rand(1, $max);}}
$query = mysql_query("select id_resep, judul, image from resep where id_resep = '$randid' limit 1");
$row = mysql_fetch_array($query);
echo"<div class='feature_min' style='background:url(img/recipe/$row[image])'>
<a href='recipe.php?id=$row[id_resep]'><h1>$row[judul]</h1></a>
</div>";
$tempid = $randid;
$randid = rand(1, $max);
if($randid == $tempid) {$randid = rand(1, $max);}
}
echo"</div>";
break;

// feature hidangan
case "hidangan" :

break;

//feature kategori
case "kategori" :

break;

//feature search hasil
case "search" :

break;
}

?>

<div class="wrapper">
<?php
 

switch($_GET['view']){
	
	default:
echo"<h1>Recipes</h1>
<div class='mpostwrapper'>
<ul id='pagecontain'>";

$query = mysql_query("select id_resep, resep.id_kategori, judul, caption, image, tglBuat, username, kategori from resep, user, kategori where resep.id_user = .user.id_user and resep.id_kategori = kategori.id_kategori order by tglBuat DESC");
while ($row = mysql_fetch_array($query)) {
	
$tgl = $row['tglBuat'];
$date = new DateTime($tgl);

echo"<!-- 1 post -->
<li><div class='postwrapper'>
<div class='reimg' style='background:url(img/recipe/". $row['image'] . ")'>";

/* if($_SESSION['open'] == TRUE){
	if($_SESSION['type'] == 'user'){
echo"<div class='infoimg'>
<ul>
<li><a href='#'><div class='boxbutton' style='background:url(icons/favor.png) #ff6600'><span>Tambah Ke Favorit</span></div></a></li>
<li><a href='#'><div class='boxbutton' style='background:url(icons/shopping.png) #ff6600'><span>Tambah Ke Daftar Belanjaan</span></div></a></li>
</ul>
</div>";}} */

echo"</div>
<div class='recap'>
<div class='titleholder'>
<div class='dateholder'><span>";echo $date->format('j') ."</span><br><span>";echo $date->format('M'). " '"; echo $date->format('y') ."</span></div>
<a href='recipe.php?id=$row[id_resep]'><h1>". $row['judul'] ."</h1><br></a>
<span>Kategori > <a href='index.php?view=kategori&id=$row[id_kategori]'>$row[kategori]</a></span></div>
<span>".$row['caption']. " <br /> SUBMITTED BY : <a href='#'>" .$row['username']. "</a></span>

</div>
</div>
</li>
<!-- 1 post -->
";}
echo"</ul><div class='holder'></div>";
break;

// view kategori
case "kategori" :
$kategori = $_GET['id'];
$q = mysql_fetch_array(mysql_query("select * from kategori where id_kategori = $kategori"));
echo"<h1>$q[kategori]</h1>
<div class='mpostwrapper'>
<ul id='pagecontain'>";

$query = mysql_query("select id_resep, judul, caption, image, tglBuat, username, kategori from resep, user, kategori where resep.id_user = .user.id_user and resep.id_kategori = '$kategori' and kategori.id_kategori = '$kategori'") or die(mysql_error());
$numrow = mysql_num_rows($query);

if($numrow < 1){
	echo"<div class='postwrapper'>
	<h1 class='fading'>Belum Ada Resep Dalam Kategori Ini</h1>
	</div>";
	
	}

else{
while ($row = mysql_fetch_array($query)) {
	
$tgl = $row['tglBuat'];
$date = new DateTime($tgl);

echo"<li><div class='postwrapper'>
<div class='reimg' style='background:url(img/recipe/". $row['image'] . ")'>";

/* if($_SESSION['open'] == TRUE){
	if($_SESSION['type'] == 'user'){
echo"<div class='infoimg'>
<ul>
<li><a href='#'><div class='boxbutton' style='background:url(icons/favor.png) #ff6600'><span>Tambah Ke Favorit</span></div></a></li>
<li><a href='#'><div class='boxbutton' style='background:url(icons/shopping.png) #ff6600'><span>Tambah Ke Daftar Belanjaan</span></div></a></li>
</ul>
</div>";}} */

echo"</div>
<div class='recap'>
<div class='titleholder'>
<div class='dateholder'><span>";echo $date->format('j') ."</span><br><span>";echo $date->format('M'). " '"; echo $date->format('y') ."</span></div>
<a href='recipe.php?id=$row[id_resep]'><h1>". $row['judul'] ."</h1><br></a>
<span><a href=''>Category</a> > <a href=''>$row[kategori]</a></span></div>
<span>".$row['caption']. " <br /> SUBMITTED BY : <a href='#'>" .$row['username']. "</a></span>

</div>
</div></li>
<!-- 1 post -->";
}
echo"</ul><div class='holder'></div>";
}

break;

// view kategori
case "hidangan" :
$hidangan = $_GET['id'];
$q = mysql_fetch_array(mysql_query("select * from hidangan where id_hidangan = $hidangan"));
echo"<h1>$q[hidangan]</h1>
<div class='mpostwrapper'>
<ul id='pagecontain'>";

$query = mysql_query("select id_resep, id_kategori, judul, caption, image, tglBuat, username from resep, user where resep.id_hidangan = '$hidangan' AND resep.id_user = user.id_user") or die(mysql_error());
$numrow = mysql_num_rows($query);

if($numrow < 1){
	echo"<div class='postwrapper'>
	<h1 class='fading'>Belum Ada Resep Dalam Hidangan Ini</h1>
	</div>";
	
	}

else{
while ($row = mysql_fetch_array($query)) {
$rsk = mysql_fetch_array(mysql_query("select kategori from kategori where id_kategori = $row[id_kategori]"));
$tgl = $row['tglBuat'];
$date = new DateTime($tgl);

echo"<li><div class='postwrapper'>
<div class='reimg' style='background:url(img/recipe/". $row['image'] . ")'>";

/* if($_SESSION['open'] == TRUE){
	if($_SESSION['type'] == 'user'){
echo"<div class='infoimg'>
<ul>
<li><a href='#'><div class='boxbutton' style='background:url(icons/favor.png) #ff6600'><span>Tambah Ke Favorit</span></div></a></li>
<li><a href='#'><div class='boxbutton' style='background:url(icons/shopping.png) #ff6600'><span>Tambah Ke Daftar Belanjaan</span></div></a></li>
</ul>
</div>";}} */

echo"</div>
<div class='recap'>
<div class='titleholder'>
<div class='dateholder'><span>";echo $date->format('j') ."</span><br><span>";echo $date->format('M'). " '"; echo $date->format('y') ."</span></div>
<a href='recipe.php?id=$row[id_resep]'><h1>". $row['judul'] ."</h1><br></a>
<span><a href=''>Category</a> > <a href=''>$rsk[kategori]</a></span></div>
<span>".$row['caption']. " <br /> SUBMITTED BY : <a href='#'>" .$row['username']. "</a></span>

</div>
</div></li>
<!-- 1 post -->";
}
echo"</ul><div class='holder'></div>";
}

break;

case "search" :
echo"<h1>Search Result</h1>";

$q = mysql_query('select id_resep, id_kategori, judul, caption, image, tglBuat, username from resep, user where judul like "%'. mysql_real_escape_string($_POST['keyword']) .'%" and resep.id_user = user.id_user') or die(mysql_error());
echo"<div class='mpostwrapper'>
<ul id='pagecontain'>";
$numrow = mysql_num_rows($q);

if($numrow < 1){
	echo"<div class='postwrapper'>
	<h1 class='fading'>Pencarian Tidak Ditemukan</h1>
	</div>";
	
	}

else{
while ($row = mysql_fetch_array($q)) {
$rsk = mysql_fetch_array(mysql_query("select kategori from kategori where id_kategori = $row[id_kategori]"));
$tgl = $row['tglBuat'];
$date = new DateTime($tgl);

echo"<li><div class='postwrapper'>
<div class='reimg' style='background:url(img/recipe/". $row['image'] . ")'>";

/* if($_SESSION['open'] == TRUE){
	if($_SESSION['type'] == 'user'){
echo"<div class='infoimg'>
<ul>
<li><a href='#'><div class='boxbutton' style='background:url(icons/favor.png) #ff6600'><span>Tambah Ke Favorit</span></div></a></li>
<li><a href='#'><div class='boxbutton' style='background:url(icons/shopping.png) #ff6600'><span>Tambah Ke Daftar Belanjaan</span></div></a></li>
</ul>
</div>";}} */

echo"</div>
<div class='recap'>
<div class='titleholder'>
<div class='dateholder'><span>";echo $date->format('j') ."</span><br><span>";echo $date->format('M'). " '"; echo $date->format('y') ."</span></div>
<a href='recipe.php?id=$row[id_resep]'><h1>". $row['judul'] ."</h1><br></a>
<span><a href=''>Category</a> > <a href=''>$rsk[kategori]</a></span></div>
<span>".$row['caption']. " <br /> SUBMITTED BY : <a href='#'>" .$row['username']. "</a></span>

</div>
</div></li>
<!-- 1 post -->";
}
echo"</ul><div class='holder'></div>";
}

break;

}
?>
</div>
<!-- SIDE CONTENT -->
<div class="sidewrap">
<div class="sideitem"><h1>apa yang baru</h1>
<ul>
<?php
$q = mysql_query("select * from resep order by id_resep DESC limit 6");
while($rs=mysql_fetch_array($q)){
echo"<li><a href='recipe.php?id=$rs[id_resep]'>$rs[judul]</a></li>";
}
?>
</ul>
</div>

<div class="sideitem"><h1>resep terpopuler</h1>
<?php
$q=mysql_query("select  id_resep, judul, caption, image from resep order by viewed DESC limit 3");
while($rs=mysql_fetch_array($q)){
echo"<div class='popside'><div class='imgside' style='background:url(img/recipe/$rs[image])'></div>
<a href='recipe.php?id=$rs[id_resep]'>$rs[judul]</a>
<p>$rs[caption]</p>
</div>";
}

?>
</div>

<div class="sideitem"><h1>hot thread </h1>

</div>
</div>
<!-- SIDE CONTENT -->

<!-- BOTTOM CONTENT -->
<div class="botwrapper">
<div class="botcontent">
<h1>dummy data</h1>
<div class="botimg"></div>
<div class="botcaption">
<a href='#'>dummy data</a><br>
dummy data dummy data dummy data dummy data dummy data dummy data dummy data dummy data dummy data dummy data 
</div>
</div>

<div class="botcontent">
<h1>dummy data</h1>
<div class="botimg"></div>
<div class="botcaption">
<a href='#'>dummy data</a><br>
dummy data dummy data dummy data dummy data dummy data dummy data dummy data dummy data dummy data dummy data 
</div>
</div>

<div class="botcontent">
<h1>dummy data</h1>
<div class="botimg"></div>
<div class="botcaption">
<a href='#'>dummy data</a><br>
dummy data dummy data dummy data dummy data dummy data dummy data dummy data dummy data dummy data dummy data 
</div>
</div>

</div>
<!-- BOTTOM CONTENT -->

 <!-- Footer -->
<div class="footer">
<p>RecipeBox © 2013</p>
</div>

</div> <!-- wrapper utama -->
</body>
</html>
