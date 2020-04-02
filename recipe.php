<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="icons/fav.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 

$include = include('connect.php'); 
if (!$include) {
	ob_clean();
    die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');
}
session_start();
if (!isset($_SESSION['open'])) {
    $_SESSION['open'] = FALSE;
}

$id = $_GET['id'];
$q = mysql_query("select judul, viewed from resep where resep.id_resep = $id")or die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');
$cek = mysql_num_rows($q);
if($cek > 0){}
else{
	ob_clean();
	die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');}
$res = mysql_fetch_array($q);
echo"<title>$res[judul]</title>";
$view = $res['viewed'];
$view = $view + 1;
mysql_query("update resep set viewed='$view' where id_resep = $id");

?>
<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/rating.css" />
</head>
<body>
<?php include"header.php"; ?>

<div class='featurewrapper'>
<?php
$id = $_GET['id'];
$query = mysql_query("select judul, kategori, caption, image, tglBuat, username, prep, cook, ready, lemak, kalori, kolesterol from resep, user, kategori where resep.id_user = user.id_user and resep.id_resep = $id and resep.id_kategori = kategori.id_kategori");
//if(!$query){ 
//	ob_clean();
//    die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');}

while ($row = mysql_fetch_array($query)) {
	
$tgl = $row['tglBuat'];
$date = new DateTime($tgl);

echo"
<h1 id='judulRes'>$row[judul]</h1>

<div class='imgdetail' style='background:url(img/recipe/$row[image])'>
</div>

<div class='resdetail'>
<div class='timeimg'></div>
<div class='minidet'>Prep<span>$row[prep]m</span></div>
<div class='minidet'>Cook<span>$row[cook]m</span></div>
<div class='minidet'>Ready in<span>$row[ready]m</span></div>

<div class='nutimg'></div>
<div class='minidet'>Fat<span>$row[lemak]mg</span></div>
<div class='minidet'>Calories<span>$row[kalori]mg</span></div>
<div class='minidet'>Choresterol<span>$row[kolesterol]mg</span></div>
</div>

<div class='resdetail'>
<p><span>''$row[caption].''</span>
<br>SUBMITTED BY : <a href='#'>$row[username]</a></p>
<h3><span>Category > <a href=''>$row[kategori]</a></span>"; echo $date->format('j F, Y'). "</h3>
</div>"; 

?>

<div class="imgwrap">
<div class="imgcontainer">
<?php if ($row['image'] != 'default.jpg') 
{echo"<a id='example2' href='img/recipe/$row[image]'><div class='imgList' style='background:url(img/recipe/$row[image])'></div></a>";
}
else 
{} }?>
<!--
<a href='#'><div class="imgList"></div></a>
<a href='#'><div class="imgList"></div></a>
<a href='#'><div class="imgList"></div></a>
-->
</div>
</div>

<div class='resdetail' style="height:115px; padding-top:5px">
<?php 
if($_SESSION['open'] == TRUE){
if($_SESSION['type'] != "admin"){
echo"<div class='boxbutton' style='background:url(icons/favor.png) #ff6600'><div class='linkb'><a href='action.php?act=favorit&id=$id'>Tambah ke Favorit</a></div></div>
<div class='boxbutton' style='background:url(icons/shopping.png) #ff6600'><div class='linkb'><a href='#'>Tambah ke Daftar Belanja</a></div></div>"; }else { echo"<div style='width:140px; height:110px; padding-left:10px; font-size:19pt; color:#999'>Opsi tidak tersedia untuk admin.</div>"; }}
else {echo"<div style='width:140px; height:110px; padding-left:10px; font-size:19pt; color:#999'>Silahkan Daftar atau Login.</div>";}?>
<div class='sharebox'><span>Bagikan</span>
<li class='fb'>Facebook</li>
<li class='twit'>Twitter</li>
</div>
</div>

<h1> Ingredients </h1>
<div class="detail">
<?php 
$id = $_GET['id'];
$query = mysql_query("select nama_bahan, keterangan from viewbahan where id_resep = $id");
//if(!$query){ 
//	ob_clean();
//   die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');}
echo"<ul>";
while ($row = mysql_fetch_array($query)) {
echo"<li><span>$row[nama_bahan] $row[keterangan]</span></li>";}
echo"<ul>"; ?>

</div>
<h1> Directions </h1>
<div class="detail">
<table border="0">
<?php 
$id = $_GET['id'];
$query = mysql_query("select cara from caramasak where id_resep = $id");
//if(!$query){ 
//	ob_clean();
//   die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');}
$step = 0;
while ($row = mysql_fetch_array($query)) {
$step++;
echo"<tr><td valign=top><span>$step.</span></td><td valign=top>$row[cara]</td></tr>";}
?>
</table>
</div>

<h1 id='myrev'> My Review </h1>
<div class="revwrap" style="background:#eee">
<?php
if ($_SESSION['open'] == TRUE){
	
	if($_SESSION['type'] == 'user'){
		
		$id_user = $_SESSION['id'];
		$id_resep = $_GET['id'];
		$q=mysql_query("select * from review where id_user = $id_user and id_resep = $id_resep");
		$rs=mysql_fetch_array($q);
		$row=mysql_num_rows($q);
		
		if($row > 0){
			// update review
			$pr = mysql_fetch_array(mysql_query("select fname, lname, imgThumb from user where id_user = $id_user"));
			$rv = mysql_fetch_array(mysql_query("select judulReview, review, rating from review where id_user = $id_user and id_resep = $id_resep"));	
			$rate = $rv['rating'] * 20;		
			echo"<form method='post' action='action.php?act=uprev&idr=$_GET[id]'>
			<table border='0'>
			<tr><td colspan='3'><h3>Edit My Review</h3></td></tr>
			<tr><td rowspan='4'><div class='revimg' style='background:url(img/profile/thumb/$pr[imgThumb])'></div></td></tr>
			<tr><td>Rating : </td>
			<td> 
			<ul class='star-rating'>
			<li class='current-rating' style='width:$rate%;' id=mainrater>Currently 3/5 Stars.</li>
			<li><a href='javascript:void(0)' title='1 star out of 5' class='one-star' onclick=add(20)>1</a></li>
			<li><a href='javascript:void(0)' title='2 stars out of 5' class='two-stars' onclick=add(40)>2</a></li>
			<li><a href='javascript:void(0)' title='3 stars out of 5' class='three-stars' onclick=add(60)>3</a></li>
			<li><a href='javascript:void(0)' title='4 stars out of 5' class='four-stars' onclick=add(80)>4</a></li>
			<li><a href='javascript:void(0)' title='5 stars out of 5' class='five-stars' onclick=add(100)>5</a></li>
			</ul><input type=hidden name='rating' id=ratetext value=$rate>
			</td></tr>
			<tr><td rowspan='2' valign='top'>Title :</td><td> <input required name='title' autocomplete='off' value='$rv[judulReview]' type='text' onKeyDown='limitText(this.form.title,this.form.Tcountdown,60);' 
			onKeyUp='limitText(this.form.title,this.form.Tcountdown,60);'><br>
			<font class='tlimit' >Maximum characters: <input readonly type='text' name='Tcountdown' size='1' value='60'></font></td></tr>
			<tr><td height='20px'></td></td>
			<tr><td colspan='3'>Comment : </td></tr>
			<tr><td colspan='3'><textarea name='review' onKeyDown='limitText(this.form.review,this.form.countdown,360);' 
			onKeyUp='limitText(this.form.review,this.form.countdown,360);'>$rv[review]</textarea><br>
			<font class='tlimit'> Maximum characters: <input readonly type='text' name='countdown' size='1' value='360'></font></td></tr>
			<tr><td colspan='3'><input type='submit' value='Submit' /></td></tr>
			</table>
			</form>";
			} else {
				$pr = mysql_fetch_array(mysql_query("select fname, lname, imgThumb from user where id_user = $id_user"));
				// review baru
				echo"<form method='post' action='action.php?act=addrev&idr=$_GET[id]'>
				<table border='0'>
				<tr><td rowspan='4'><div class='revimg' style='background:url(img/profile/thumb/$pr[imgThumb])'></div></td></tr>
				<tr><td>Rating : </td>
				<td> 
				<ul class='star-rating'>
				<li class='current-rating' style='width:0%;' id=mainrater>Currently 3/5 Stars.</li>
				<li><a href='javascript:void(0)' title='1 star out of 5' class='one-star' onclick=add(20)>1</a></li>
				<li><a href='javascript:void(0)' title='2 stars out of 5' class='two-stars' onclick=add(40)>2</a></li>
				<li><a href='javascript:void(0)' title='3 stars out of 5' class='three-stars' onclick=add(60)>3</a></li>
				<li><a href='javascript:void(0)' title='4 stars out of 5' class='four-stars' onclick=add(80)>4</a></li>
				<li><a href='javascript:void(0)' title='5 stars out of 5' class='five-stars' onclick=add(100)>5</a></li>
				</ul><input type=hidden name='rating' id=ratetext value=0>
				</td></tr>
				<tr><td rowspan='2' valign='top'>Title :</td><td> <input required name='title' autocomplete='off'  type='text' onKeyDown='limitText(this.form.title,this.form.Tcountdown,60);' 
				onKeyUp='limitText(this.form.title,this.form.Tcountdown,60);'><br>
				<font class='tlimit' >Maximum characters: <input readonly type='text' name='Tcountdown' size='1' value='60'></font></td></tr>
				<tr><td height='20px'></td></td>
				<tr><td colspan='3'>Comment : </td></tr>
				<tr><td colspan='3'><textarea name='review' onKeyDown='limitText(this.form.review,this.form.countdown,360);' 
				onKeyUp='limitText(this.form.review,this.form.countdown,360);'></textarea><br>
				<font class='tlimit'> Maximum characters: <input readonly type='text' name='countdown' size='1' value='360'></font></td></tr>
				<tr><td colspan='3'><input type='submit' value='Submit' /></td></tr>
				</table>
				</form>";
				
				
				
				}
		
		}
		else 
			{ echo"<div class='reviewlogin'><h1>Admin tidak bisa memberi review.</h1></div>";}

} else {
	echo"<div class='reviewlogin'>Silahkan login untuk memberikan review pada resep ini.
	<form method='post' action='action.php?act=log&refid=$_GET[id]'>
	<ul>
	<li>username</li>
	<li><input type='text' autocomplete='off' placeholder='username' name='uname' /></li>
	<li>password</li>
	<li><input type='password' placeholder='password'  name='password' /></li>
	<li><a href=''>Forget Password ?</a> | <span>Remember Me <input type='checkbox' /></span></li>
	<li><input type='submit' value='login' /> </li>
	</ul>
	</form>
	</div>";
	}
?>
<div class="revoverall">
<h2>Overall Rating</h2>
<?php 
$id = $_GET['id'];
$q = mysql_query("select * from review where id_resep = $id");
$rs = mysql_fetch_array(mysql_query("select SUM(rating) as ratingtotal from review where id_resep = $id"));
$voter = mysql_num_rows($q);
$rt = $rs['ratingtotal'];
if($rt != 0){
$ravg =  $rt / $voter;}
else { $ravg = 0;}
$ravg2 = ($ravg * 100) / 5;
echo"<div class='ratingbox'>";
echo round( $ravg, 1, PHP_ROUND_HALF_UP);
echo"</div>
<span>berdasarkan $voter voter.</span>
<ul class='star-rating' style=' margin: 0 auto'>
<li class='current-rating' style='width:$ravg2%;'>Currently 3/5 Stars.</li>
</ul>";
?>
</div>

</div>

<h1> Reviews </h1>
<div class="revwrap">

<?php
$idresep = $_GET['id'];
$query = mysql_query("select judulReview, tglReview, review, rating, username, imgThumb from user, review where user.id_user = review.id_user and $idresep = review.id_resep order by id_review DESC");
$num_results = mysql_num_rows($query); 
if ($num_results > 0){ 

while($row=mysql_fetch_array($query)){
$tgl = $row['tglReview'];
$date = new DateTime($tgl);
$rating = $row['rating'] / 5;
$rating = $rating  * 100;
echo"<div class='review'>
<table border='0'>
<tr><td rowspan='5' valign='top'><div class='revimg' style='background:url(img/profile/thumb/$row[imgThumb])'></div></td><td><h3>$row[judulReview]</h3></td></tr>
<tr><td><span><a href='profile.php'>$row[username]</a></span> <span>- "; echo $date->format('j F, Y'). "</span></td></tr>
<tr><td>
<ul class='star-rating'>
		<li class='current-rating' style='width:$rating%;'>Currently 3/5 Stars.</li>
</ul></td></tr>
<tr><td>$row[review]</td></tr>
</table>
</div>";}

}else{ 
echo "<div class='noreview'>Tidak ada review untuk resep ini.</div>";
} 

?>

</div>






</div>
</body>
<script type="text/javascript">
		$(document).ready(function() {
			$("a#example2").fancybox({
			});
		});
</script>
<script type=text/javascript>
		function doc(id){
			return(document.getElementById(id));	
		}
		function add(w){
			doc('mainrater').style.width=w+'%';
			doc('ratetext').value=w;
		}
	</script>
<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>

</html>
