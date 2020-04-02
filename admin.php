<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kitchen</title>
<link rel="stylesheet" type="text/css" href="css/admin.css" />
<link rel="stylesheet" type="text/css" href="css/rating.css" />
<link rel="stylesheet" type="text/css" href="css/jPages.css" />
<link rel="stylesheet" href="css/animate.css">
<link rel="icon" type="image/png" href="icons/fav.png" />
<script src="js/jquery-1.8.3.js"></script>
<script src="js/jquery-ui-1.8.23.custom.min.js"></script>
<script src="js/jPages.min.js"></script>
<script src="js/shortcut.js"></script>

</head>
<?php 
include "connect.php";

session_start();
if ($_SESSION['open'] == FALSE OR $_SESSION['type'] != 'admin') {
	header('location:index.php');
} ?>
<body id='mainbody'>

<div id="confirmDel">
<p>Apa anda yakin ingin menghapus?</p>
<a id="conTrue" href="javascript:void(0);">Ok</a> 
<a href="javascript:void(0);" id="conFalse">Cancel</a>
</div>

<div id="addKbox"><form method="post" action="action.php?act=addkat">
<label>Nama Kategori </label><input required name='kategori' type="text" />
<input type="submit" value='Buat' />
<a href="javascript:void(0);" id="kFalse">Cancel</a>
</form>
</div>

<div id="addHbox"><form method="post" required action="action.php?act=addhid">
<label>Nama Hidangan </label><input name='hidang' type="text" />
<input type="submit" value='Buat' />
<a href="javascript:void(0);" id="hFalse">Cancel</a>
</form>
</div>

<div class="topbar">
<ul>
<?php 
if(!isset($_GET['view'])){$_GET['view'] = NULL;}

switch($_GET['view']){
	
	//bar opsi statistik
	default :
	echo"<li>Statistik</li>";
	break;
	
	//bar opsi untuk tambah resep
	case "add" :
	echo"<li>Tambah Resep</li>";
	break;
	
	//bar opsi untuk tambah resep
	case "user" :
	echo"<li>User</li>";
	break;
	
	//bar opsi untuk review
	case "review" :
	echo"<li>Review</li>";
	break;
	
	//bar opsi untuk bahan
	case "bahan" :
	echo"<li>Bahan</li>";
	break;
	
	//bar opsi untuk tambah resep
	case "detailres" :
	echo"<li>Detail Resep</li>";
	break;
	
	//bar opsi untuk tambah resep
	case "detailuser" :
	echo"<li>Detail User</li>";
	break;
	
	//bar opsi untuk edit resep
	case "editresep" :
	echo"<li>Edit Resep</li>";
	break;
	
	//bar opsi untuk kategori
	case "kategori" :
	echo"<li>Kategori</li>
	<li class='hierarc'><a>Organizer</a>
	<div class='createpane'>
	<table>
	<tr><td><a class='adkat' href='action.php?act=addkat'>Buat Kategori Baru</a></td></tr>
	</table>
	</div>
	</li>";
	break;
	
		//bar opsi untuk hidangan
	case "hidangan" :
	echo"<li>Hidangan</li>
	<li class='hierarc'><a>Organizer</a>
	<div class='createpane'>
	<table>
	<tr><td><a class='adhid' href='action.php?act=addhid'>Buat Hidangan Baru</a></td></tr>
	</table>
	</div>
	</li>";
	break;
	
	//bar opsi untuk resep
	case "resep" :
echo"<li>Resep</li>
<li class='hierarc'><a>Organizer</a>
<div class='createpane'>
<table>
<tr><td><a href='admin.php?view=add'>Buat Resep Baru</a></td></tr>
</table>
</div>
</li>";
break;


}
?>

<?php
$q=mysql_fetch_array(mysql_query("select * from user where id_user = '$_SESSION[id]'"));
echo"<li><a href='#'><div class='thumb' style='background:url(img/profile/thumb/$q[imgThumb]);'></div>$q[fName] $q[lName]</a>
<div class='thoption'>
<a href='index.php'>Main Page</a>
<a href='profile.php'>Profile</a>
<a href='#'>Account Option</a>
<a href='action.php?act=logout'>Logout</a>
</div>
</li>";
?>
</ul>
</div>

<!-- list navigasi samping -->
<div class="left_col">
<table>
<tr><td><input type="text" placeholder="Search" /></td></tr>
<tr><td><a href="admin.php">Statistik</a></td></tr>
<tr><td><a href="admin.php?view=hidangan">Hidangan</a></td></tr>
<tr><td><a href="admin.php?view=kategori">Kategori</a></td></tr>
<tr><td><a href="admin.php?view=resep">Resep</a></td></tr>
<tr><td><a href="admin.php?view=bahan">Bahan</a></td></tr>
<tr><td><a href="admin.php?view=user">User</a></td></tr>
<tr><td><a href="admin.php?view=review">Review</a></td></tr>
</table>
</div>

<div class="main_col">
<?php

switch($_GET['view']){

	default:
	echo"<div class='bar'>
	<ul>
	<li>Statistik Recipe Box</li>
	</ul></div>
	<div class='wrapfulstat'>";
	
	echo"
	<div class='wrapstat'>
	<h1>Resep Terbaru</h1>";
	$q = mysql_query("select id_resep, image, judul, tglbuat, caption from resep order by id_resep DESC limit 3") or die(mysql_error());
	while($rs=mysql_fetch_array($q)){
	echo"
	<div class='constat'>
	<div class='img' style='background:url(img/recipe/$rs[image])'></div>
	<a href='admin.php?view=detailres&id=$rs[id_resep]'><h3>$rs[judul]</h3></a>
	<p>$rs[caption]</p>
	<span>$rs[tglbuat]</span>
	</div>";
	}
	echo"<a href='admin.php?view=resep' class='link'>Lihat Seluruh Resep >> </a>
	</div>
	";
	//statistik
	echo"
	<div class='wrapstat'>
	<h1>Statistik</h1>
	<table border='0' width='100%' class='tablestat'>
	<th colspan='2'>Statistik Keseluruhan</th>";
	$thid = mysql_num_rows(mysql_query("select * from hidangan"));
	$tkat = mysql_num_rows(mysql_query("select * from kategori"));
	$trec=mysql_num_rows(mysql_query("select * from resep"));
	$tbah=mysql_num_rows(mysql_query("select * from bahan"));
	$tuser=mysql_num_rows(mysql_query("select * from user"));
	echo"
	<tr><td width='130px'>Total Hidangan </td><td><span style='width:".($thid * 2)."px;'>".$thid."</span></td></tr>
	<tr><td>Total Kategori </td><td><span style='width:".($tkat * 2)."px;'>".$tkat."</span></td></tr>
	<tr><td>Total Resep </td><td><span style='width:".($trec * 2)."px;'>".$trec."</span></td></tr>
	<tr><td>Total Bahan </td><td><span style='width:".($tbah * 2)."px;'>".$tbah."</span></td></tr>
	<tr><td>Total User </td><td><span style='width:".($tuser * 2)."px;'>".$tuser."</span></td></tr>
	<th colspan='2'>Statistik Hari ini</th>";
	$now = date("Y-m-d");
	$nowrec = mysql_num_rows(mysql_query("select * from resep where tglBuat = '$now'"));
	$nowuser = mysql_num_rows(mysql_query("select * from user where tgl_register = '$now'"));
	$nowrev = mysql_num_rows(mysql_query("select * from review where tglReview = '$now'"));
	echo"<tr><td>Resep Baru </td><td><span style='width:".($nowrec * 2)."px;'>".$nowrec."</span></td></tr>
	<tr><td>User Baru </td><td><span style='width:".($nowuser * 2)."px;'>".$nowuser."</span></td></tr>
	<tr><td>Review Baru </td><td><span style='width:".($nowrev * 2)."px;'>".$nowrev."</span></td></tr>
	</table>
	</div>
	</div>
	";
	
	//review terbaru
	echo"<div class='wrapfulstat'>
	<h1>Review Terbaru</h1>
	<table class='tablerev'>
	<tr><th width='150px'>Username</th>
	<th width='80px'>Rating</th>
	<th width='180px'>Judul Review</th><th align='left'>Review</th><th>Resep</th><th align='left'>Tanggal</th></tr>";
	
	$q = mysql_query("select user.id_user, username, judul, tglReview, judulReview, review, rating from review, user, resep where resep.id_resep = review.id_resep and user.id_user = review.id_user order by id_review DESC limit 5");
	while($rs=mysql_fetch_array($q)){
		$rate = $rs['rating'] * 20 ;
	echo"<tr><td align='center' valign='top'><a href='admin.php?view=detailuser&id=$rs[id_user]'>$rs[username]</a></td><td valign='top'>
	<ul class='star-rating'>
	<li class='current-rating' style='width:$rate%;'></li></td>
	</ul></td>
	<td align='center' valign='top'>$rs[judulReview]</td>
	<td valign='top'>$rs[review]</td>
	<td align='center' valign='top'>$rs[judul]</td>
	<td valign='top'>$rs[tglReview]</td></tr>";}
	
	
	echo"
	</table>
	<a href='admin.php?view=review' class='link'>Lihat Seluruh Review >> </a>
	</div>
	<div class='wrapfulstat'>
	<h1>User Terbaru</h1>
	<table border='0' class='tabuser'>
	<tr><th width='80px'>Picture</th><th>Username</th><th>Nama Depan</th><th>Nama Belakang</th><th>Email</th><th width='150px'>Tanggal Register</th></tr>";
	$q = mysql_query("select id_user, imgthumb, username, fname, lname, email, tgl_register from user order by tgl_register DESC limit 5") or die(mysql_error());
	while($rs=mysql_fetch_array($q)){
		echo"<tr><td align='center'><div class='imgth' style='background:url(img/profile/thumb/$rs[imgthumb])'></div></td>
		<td align='center'><a href='admin.php?view=detailuser&id=$rs[id_user]'>$rs[username]</a></td><td>$rs[fname]</td><td>$rs[lname]</td><td>$rs[email]</td><td align='center'>$rs[tgl_register]</td>";
		}
	
	echo"</table><a href='admin.php?view=user' class='link'>Lihat Seluruh User >> </a>
	</div>";
	
	break;

//tampil semua resep
	case "resep":
	
	if(!isset($_GET['mode'])){$_GET['mode']=NULL;}
echo"<div class='bar'>
<ul>
<li>Resep</li>
<a href='admin.php?view=resep' title='List View'><li class='listbtn'></li></a>
<a href='admin.php?view=resep&mode=thumb' title='Thumb View'><li class='thumbbtn'></li></a>"; ?>

<li class='ordering'>
<select>
<option>A - Z</option>
<option>Z - A</option>
<option>Tanggal Buat ꜛ</option>
<option>Tanggal Buat ꜜ</option>
<option>Pembuat ꜛ</option>
<option>Pembuat ꜜ</option>
</select>
</li>

<?php echo"</ul>
</div>";
if($_GET['mode']==NULL){
	//list view
echo"<table class='tablerec'><thead>
<tr><td><input type='checkbox' /></td><th>Judul</th><th>Dibuat oleh</th><th>Tanggal dibuat</th><th>Kategori</th><th>Rating</th></tr></thead>
<tbody id='tablepag'>";

$query = mysql_query("select id_resep, user.id_user, judul, tglBuat, username, kategori from resep, user, kategori where resep.id_user = user.id_user and kategori.id_kategori = resep.id_kategori order by id_resep DESC");
while ($row = mysql_fetch_array($query)) {
$reviewer = mysql_num_rows(mysql_query("select * from review where id_resep = $row[id_resep]"));
$rt = mysql_fetch_array(mysql_query("select SUM(rating) as ratingtotal from review where id_resep = $row[id_resep]")); 
echo"<tr>
<td><input type='checkbox' /></td>
<td><a href='admin.php?view=detailres&id=$row[id_resep]'>$row[judul]</a></td>
<td><a href='admin.php?view=detailuser&id=$row[id_user]'>$row[username]</a></td>
<td>$row[tglBuat]</td><td>$row[kategori]</td>
<td>"; if($reviewer == 0) {echo "N/A";} else { echo round( ($rt['ratingtotal'] / $reviewer), 1, PHP_ROUND_HALF_UP);} echo"</td>
</tr>";
}
echo"</tbody>
</table>
<div class='holder'></div>";} 
else {
	//thumbnail view
	echo"<div class='containthumb' id=thumbview>";
	$query = mysql_query("select id_resep, image, user.id_user, judul, tglBuat, username, kategori from resep, user, kategori where resep.id_user = user.id_user and kategori.id_kategori = resep.id_kategori order by id_resep DESC");
while ($row = mysql_fetch_array($query)) {
	$reviewer = mysql_num_rows(mysql_query("select * from review where id_resep = $row[id_resep]"));
	$rt = mysql_fetch_array(mysql_query("select SUM(rating) as ratingtotal from review where id_resep = $row[id_resep]"));
	echo"
	
	<div class='recthumb' style='background:url(img/recipe/$row[image])'>
	<div class='info'>
	<h3><a href='admin.php?view=detailres&id=$row[id_resep]'>$row[judul]</a></h3>
	<li>Submitted by : <a href='admin.php?view=detailuser&id=$row[id_user]'>$row[username]</a></li>
	<li>Kategori : $row[kategori]</li>
	<li>Tanggal buat : $row[tglBuat]</li>
	<li>Rating : "; if($reviewer == 0) {echo "N/A";} else { echo round( ($rt['ratingtotal'] / $reviewer), 1, PHP_ROUND_HALF_UP);} echo"</li>
	</div>
	</div>
	";}
	echo"</div><div class='holder'></div>";
	
	}
break;

//tampil semua hidangan
	case "hidangan":
echo"<div class='bar'>
<ul>
<li>Hidangan</li>
<li>Susun</li>
</ul>
</div>
<table class='tablerec'><thead>
<tr><td><input type='checkbox' /></td><th width='90%'>Nama Hidangan</th><th width='5%' style='text-align:center !important'>Opsi</th></tr></thead>
<tbody id='tablepag'>";
$q=mysql_query("select * from hidangan");
while($rs=mysql_fetch_array($q)){
echo"<tr><td><input type='checkbox' /></td><td>$rs[hidangan]</td>
<td align='center'><a class='delcon' href='action.php?act=delhi&id=$rs[id_hidangan]' title='Hapus Hidangan'><div class='remove_sm'></div></a></td>";
}
echo"
</tbody>
</table>
<div class='holder'></div>";
break;

//tampil semua kategori
	case "kategori":
echo"<div class='bar'>
<ul>
<li>Kategori</li>
<li>Susun</li>
</ul>
</div>
<table class='tablerec'><thead>
<tr><td><input type='checkbox' /></td><th width='90%'>Nama Kategori</th><th width='5%' style='text-align:center !important'>Opsi</th></tr></thead>
<tbody id='tablepag'>";
$q=mysql_query("select * from kategori");
while($rs=mysql_fetch_array($q)){
echo"<tr><td><input type='checkbox' /></td><td>$rs[kategori]</td>
<td align='center'><a class='delcon' href='action.php?act=delka&id=$rs[id_kategori]' title='Hapus Kategori'><div class='remove_sm'></div></a></td>";
}
echo"
</tbody>
</table>
<div class='holder'></div>";
break;

//tampil semua user
	case "user":
echo"<div class='bar'>
<ul>
<li>User</li>
<li class='ordering'>
<select>
<option>A - Z</option>
<option>Z - A</option>
<option>Tanggal Daftar ꜛ</option>
<option>Tanggal Daftar ꜜ</option>
</select>
</li>
</ul>
</div>
<table border='0' class='tabuser'><thead>
	<tr><th>Username</th><th>Level</th><th align='left'>Nama Depan</th><th align='left'>Nama Belakang</th><th align='left' width='140px'>Email</th><th width='150px'>Tanggal Register</th><th colspan='2'>Opsi</th></tr></thea><tbody id='tablepag'>";
	$q = mysql_query("select id_user, imgthumb, tipe, username, fname, lname, email, tgl_register from user order by tgl_register DESC") or die(mysql_error());
	while($rs=mysql_fetch_array($q)){
		echo"<tr><td align='center'><a href='admin.php?view=detailuser&id=$rs[id_user]'>$rs[username]</a></td><td align='center'>$rs[tipe]</td><td>$rs[fname]</td>
		<td>$rs[lname]</td><td>$rs[email]</td><td align='center'>$rs[tgl_register]</td>
		<td align='center' width='30px'><a class='procon' href='' title='Promote User'><div class='promote'></div></a></td>
		<td align='center' width='30px'><a class='delcon' href='' title='Hapus User'><div class='remove_sm'></div></a></td>
		</tr>";
		}
echo"
</tbody>
</table>
<div class='holder'></div>";
break;


//tampil semua review
case "review" :
echo"<div class='bar'>
<ul>
<li>Review</li>
<li class='ordering'>
<select style='width:140px'>
<option>Tanggal Review ꜛ</option>
<option>Tanggal Review ꜜ</option>
</select>
</li>
</ul>
</div>
<table class='tablerev'><thead>
	<tr><th width='150px'>Username</th>
	<th width='80px'>Rating</th>
	<th width='180px'>Judul Review</th><th align='left'>Review</th><th>Resep</th>
	<th align='left'>Tanggal</th></tr></thead><tbody id='tablepag'>";
	$q = mysql_query("select user.id_user, username, review.id_resep, judul, tglReview, judulReview, review, rating from review, user, resep where resep.id_resep = review.id_resep and user.id_user = review.id_user order by id_review DESC");
	while($rs=mysql_fetch_array($q)){
		$rate = $rs['rating'] * 20 ;
	echo"<tr><td align='center' valign='top'><a href='admin.php?view=detailuser&id=$rs[id_user]'>$rs[username]</a></td><td valign='top'>
	<ul class='star-rating'>
	<li class='current-rating' style='width:$rate%;'></li></td>
	</ul></td>
	<td align='center' valign='top'>$rs[judulReview]</td>
	<td valign='top'>$rs[review]</td>
	<td align='center' valign='top'><a href='admin.php?view=detailres&id=$rs[id_resep]'>$rs[judul]</a></td>
	<td valign='top'>$rs[tglReview]</td></tr>";}
echo"
</tbody>
</table>
<div class='holder'></div>";
break;

//tampil semua bahan
	case "bahan":
echo"<div class='bar'>
<ul>
<li>Bahan</li>
<li class='ordering'>
<select>
<option>A - Z</option>
<option>Z - A</option>
</select>
</li>
</ul>
</div>
<table class='tablerec'><thead>
<tr><td><input type='checkbox' /></td><th width='90%'>Nama Bahan</th><th width='5%' style='text-align:center !important'>Opsi</th></tr></thead>
<tbody id='tablepag'>";
$q=mysql_query("select * from bahan order by nama_bahan ASC");
while($rs=mysql_fetch_array($q)){
echo"<tr><td><input type='checkbox' /></td><td>$rs[nama_bahan]</td>
<td align='center'><a class='delcon' href='action.php?act=delba&id=$rs[id_bahan]' title='Hapus Bahan'><div class='remove_sm'></div></a></td>";
}
echo"
</tbody>
</table>
<div class='holder'></div>";
break;

//case tambah resep
case "add" :
echo"<div class='bar' id=bar>
<ul>
<li>Tambah Resep</li>
</ul>
</div>
<form action='action.php?act=addresep' method='POST' enctype='multipart/form-data'>
<table class='tableadd' border='0'>
<h1>Utama</h1>
<tr>
<td valign='top'>Judul Resep :</td>
<td><div class='wraptooltip'><input required type='text' autocomplete='off' name='judul' onKeyDown='limitText(this.form.judul,this.form.Tcountdown,120);' onKeyUp='limitText(this.form.judul,this.form.Tcountdown,120);' /><div class='tooltip'>Maximum <input readonly type='text' name='Tcountdown' size='1' value='120'></div></div>

</td></tr>

<tr><td>Hidangan :</td><td>
<select name='hidangan'>";
$q=mysql_query('select * from hidangan');
while($rs = mysql_fetch_array($q)){
echo"<option value='$rs[id_hidangan]'>$rs[hidangan]</option>";
}
echo"</select>
</td></tr>

<tr><td>Kategori :</td><td>
<select name='kategori'>";
$q=mysql_query('select * from kategori');
while($rs = mysql_fetch_array($q)){
echo"<option value='$rs[id_kategori]'>$rs[kategori]</option>";
}
echo"</select>
</td></tr>

<tr><td valign='top'>Caption :</td>
<td><div class='wraptooltip'><textarea required name='caption'  onKeyDown='limitText(this.form.caption,this.form.Capcountdown,240);' onKeyUp='limitText(this.form.caption,this.form.Capcountdown,240);' ></textarea>
<div class='tooltip'>Maximum <input readonly type='text' name='Capcountdown' size='1' value='240'></div></div>

</td></tr>

<tr><td>Gambar Utama :</td>
<td><input type='file' accept='image/jpeg' name='mimg' /></td></tr>
</table>";
?>


<?php echo"
<h1>Bahan</h1>
<div id='addBahan'>
<div class='wrapform'>
<div class='sideform'>
<li>Bahan 1 : </li>
<li>Keterangan :</li>
</div>
<div class='sideform ui-widget'>
<li><input required type='text' name=b1 class='autobahan'/></li>
<li><input type='text' name=k1 placeholder='Contoh : 3 buah, 200gr, 100ml, etc' /></li>
</div>
</div>
</div>
<div class='abutton'><a href='javascript:void(0);' title='Tekan SHIFT + Q untuk shortcut' id='addButonB'>Tambah (+)</a></div>

<h1>Langkah</h1>
<div id='addLangkah'>
<div class='wrapform'>
<div class='sideform'>
<li>Langkah 1 : </li>
</div>
<div class='sideform'>
<li><textarea required name='l1'></textarea></li>
</div>
</div>
</div>
<div class='abutton'><a href='javascript:void(0);' title='Tekan SHIFT + E untuk shortcut' id='addButonL'>Tambah (+)</a></div>

<h1>Gambar Galeri (Opsional)</h1>
<div class='wrapform'>
<div class='sideform'>
<li>Galeri : </li>
</div>
<div class='sideform'>
<li><input type='file' name='img[]' accept='image/jpeg' multiple></li>
</div>
</div>

<h1>Keterangan Waktu (Opsional)</h1>
<div class='wrapform'>
<div class='sideform'>
<li>Persiapan : </li>
<li>Pembuatan : </li>
<li>Penyajian : </li>
</div>
<div class='sideform' style='width:300px'>
<li><input type='number' min='0' name='prep'/> <span>menit</span></li>
<li><input type='number' min='0' name='cook'/> <span>menit</span></li>
<li><input type='number' min='0' name='ready'/> <span>menit</span></li>
</div>
</div>

<h1>Keterangan Nutrisi (Opsional)</h1>
<div class='wrapform'>
<div class='sideform'>
<li>Kolesterol : </li>
<li>Kalori : </li>
<li>Lemak : </li>
</div>
<div class='sideform' style='width:300px'>
<li><input type='number' min='0' name='kol'/> <span>mg</span></li>
<li><input type='number' min='0' name='kal'/> <span>mg</span></li>
<li><input type='number' min='0' name='fat'/> <span>mg</span></li>
</div>
</div>
<textarea style='display:none' id='jumlahB' name='jmlB' /></textarea>
<textarea style='display:none' id='jumlahL' name='jmlL' /></textarea>
<div class='wrapform'>
<div class='sideform' style='width:200px'>
<input type='submit' value='Submit Resep' />
</div>
</form>
";
break;

//edit resep
case "editresep" :

$id = $_GET['id'];
$datares = mysql_fetch_array(mysql_query("select * from resep where id_resep = '$id'"));
echo"<div class='bar' id=bar>
<ul>
<li>Edit Resep</li>
</ul>
</div>
<form action='action.php?act=editres&id=$_GET[id]' method='POST' enctype='multipart/form-data'>
<table class='tableadd' border='0'>
<h1>Utama</h1>
<tr>
<td valign='top'>Judul Resep :</td>
<td><div class='wraptooltip'><input required type='text' autocomplete='off' name='judul'  value='$datares[judul]'onKeyDown='limitText(this.form.judul,this.form.Tcountdown,120);' onKeyUp='limitText(this.form.judul,this.form.Tcountdown,120);' /><div class='tooltip'>Maximum <input readonly type='text' name='Tcountdown' size='1' value='120'></div></div>

</td></tr>

<tr><td>Hidangan :</td><td>
<select name='hidangan'>";
$q=mysql_query('select * from hidangan');
while($rs = mysql_fetch_array($q)){
echo"<option"; if($datares['id_hidangan'] == $rs['id_hidangan']){echo" selected";} echo" value='$rs[id_hidangan]'>$rs[hidangan]</option>";
}
echo"</select>
</td></tr>

<tr><td>Kategori :</td><td>
<select name='kategori'>";
$q=mysql_query('select * from kategori');
while($rs = mysql_fetch_array($q)){
echo"<option"; if($datares['id_kategori'] == $rs['id_kategori']){echo" selected";} echo" value='$rs[id_kategori]'>$rs[kategori]</option>";
}
echo"</select>
</td></tr>

<tr><td valign='top'>Caption :</td>
<td><div class='wraptooltip'><textarea required name='caption'  onKeyDown='limitText(this.form.caption,this.form.Capcountdown,240);' onKeyUp='limitText(this.form.caption,this.form.Capcountdown,240);' >$datares[caption]</textarea>
<div class='tooltip'>Maximum <input readonly type='text' name='Capcountdown' size='1' value='240'></div></div>

</td></tr>

<tr><td>Gambar Utama :</td>
<td><input type='file' accept='image/jpeg' name='mimg' /></td></tr>
</table>";
?>


<?php echo"
<h1>Bahan</h1>
<textarea style='display:none' id='jumlahB' name='jmlB' /></textarea>
<div id='addBahan'>";

$q = mysql_query("SELECT id_resep, bahanresep.id_bahan, keterangan, nama_bahan FROM bahanresep, bahan where id_resep = '$id' and bahanresep.id_bahan = bahan.id_bahan");
$noB = 1;
while($idb = mysql_fetch_array($q)){
echo"<div class='wrapform'>
<div class='sideform'>
<li>Bahan $noB : </li>
<li>Keterangan :</li>
</div>
<div class='sideform'>
<li><input required type='text' value='$idb[nama_bahan]' name=b$noB class='autobahan'/></li>
<li><input type='text' value='$idb[keterangan]' name=k1 placeholder='Contoh : 3 buah, 200gr, 100ml, etc' /></li>
</div></div>";
$noB ++;
}
echo"
<input style='display:none' type='text' id='jml_editB' value='$noB' />
</div>
<div class='abutton'><a href='javascript:void(0);' title='Tekan SHIFT + Q untuk shortcut' id='addButonB'>Tambah (+)</a></div>

<h1>Langkah</h1>
<textarea style='display:none' id='jumlahL' name='jmlL' /></textarea>
<div id='addLangkah'>";
$q = mysql_query("select * from caramasak where id_resep = '$id'");
$noC = 1;
while($datacara = mysql_fetch_array($q)){
echo"<div class='wrapform'>
<div class='sideform'>
<li>Langkah $noC : </li>
</div>
<div class='sideform'>
<li><textarea required name='l$datacara[id_cara]'>$datacara[cara]</textarea></li>
</div>
</div>";
$noC ++;
}
echo"
<input style='display:none' type='text' id='jml_editC' value='$noC' />
</div>
<div class='abutton'><a href='javascript:void(0);' title='Tekan SHIFT + E untuk shortcut' id='addButonL'>Tambah (+)</a></div>

<h1>Gambar Galeri (Opsional)</h1>
<div class='wrapform'>
<div class='sideform'>
<li>Galeri : </li>
</div>
<div class='sideform'>
<li><input type='file' name='img[]' accept='image/jpeg' multiple></li>
</div>
</div>

<h1>Keterangan Waktu (Opsional)</h1>
<div class='wrapform'>
<div class='sideform'>
<li>Persiapan : </li>
<li>Pembuatan : </li>
<li>Penyajian : </li>
</div>
<div class='sideform' style='width:300px'>
<li><input type='number' value='$datares[prep]' min='0' name='prep'/> <span>menit</span></li>
<li><input type='number' value='$datares[cook]' min='0' name='cook'/> <span>menit</span></li>
<li><input type='number' value='$datares[ready]' min='0' name='ready'/> <span>menit</span></li>
</div>
</div>

<h1>Keterangan Nutrisi (Opsional)</h1>
<div class='wrapform'>
<div class='sideform'>
<li>Kolesterol : </li>
<li>Kalori : </li>
<li>Lemak : </li>
</div>
<div class='sideform' style='width:300px'>
<li><input type='number' value='$datares[kolesterol]' min='0' name='kol'/> <span>mg</span></li>
<li><input type='number' value='$datares[kalori]' min='0' name='kal'/> <span>mg</span></li>
<li><input type='number' value='$datares[lemak]' min='0' name='fat'/> <span>mg</span></li>
</div>
</div>

<div class='wrapform'>
<div class='sideform' style='width:200px'>
<input type='submit' value='Submit Resep' />
</div>
</form>
";
break;


//detail resep admin view
case "detailres" :

$id = $_GET['id'];
$rs = mysql_fetch_array(mysql_query("select judul, kategori, caption, image, tglBuat, username, prep, cook, ready, lemak, kalori, kolesterol from resep, user, kategori where resep.id_user = user.id_user and resep.id_resep = $id and resep.id_kategori = kategori.id_kategori"));
$tgl = $rs['tglBuat'];
$date = new DateTime($tgl);
echo"
<div class='detailres'>
<div class='title'><h1>$rs[judul]</h1>
<a href='action.php?act=delre&id=$id' title='Delete Recipe' class='delcon'><div class='remove'></div></a>
<a href='admin.php?view=editresep&id=$id' title='Edit Recipe'><div class='edit'></div></a>
</div>
<div class='img' style='background:url(img/recipe/$rs[image])'></div>
<h3>Caption</h3>
<p>$rs[caption]. ($rs[username])</p>

<div class='ket'>
<h3>Waktu Memasak</h3>
<ul>
<li>Prep : <span>$rs[prep]</span></li>
<li>Cook : <span>$rs[cook]</span></li>
<li>Ready in : <span>$rs[ready]</span></li>
<li class='note'>$rs[kategori]</li>
</ul>
</div>

<div class='ket'>
<h3>Nutrisi</h3>
<ul>
<li>Lemak : <span>$rs[lemak]</span></li>
<li>Kalori : <span>$rs[kalori]</span></li>
<li>Kolesterol : <span>$rs[kolesterol]</span></li>
<li class='note'>"; echo $date->format('j F, Y')."</li>
</ul>
</div>

<div class='detail'>
<h2>Bahan - Bahan</h2>
<ul class='colad'>";
$id = $_GET['id'];
$query = mysql_query("select nama_bahan, keterangan from viewbahan where id_resep = $id");
while ($row = mysql_fetch_array($query)) {
echo"<li>$row[nama_bahan]. $row[keterangan]</li>";}
echo"</ul>
</div>

<div class='detail'>
<h2>Langkah - Langkah</h2>
<ul class='langkah'>";
$id = $_GET['id'];
$query = mysql_query("select cara from caramasak where id_resep = $id");
while ($row = mysql_fetch_array($query)) {
echo"<li>$row[cara]</li>";}
echo"
</ul>
</div>


</div>
";

break;

//detail user
case "detailuser" :

echo"<div class='bar'>
<ul>
<li>Kersa Andika</li>
</ul>
</div>
<div class='detailuser'>
<div class='imgp' style='background:url(img/profile/default.jpg)'></div>
<ul>
<li><label>Level :</label> User</li>
<li><label>Total Review : </label>200</li>
<li><label>Tanggal Register : </label>21-01-12</li>
</div>

<div class='detailuser' style='width:300px'>
<div class='profileinfo'>
<span>contact info</span><hr />";
$tgl = $q['birthDate'];
$date = new DateTime($tgl);
echo"<h1>" .$date->format('jS \of F Y'). "</h1>
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
<li>Home phone</li>
</div>
</div>";

echo"<div class='detailuser' style='width:370px'>
<span>created recipes</span><hr />";;

if($_SESSION['type'] == "admin")
{echo"
<div class='scroll'>";
$q = mysql_query("select id_resep, judul, image, tglBuat, kategori from resep, kategori where id_user = '$_SESSION[id]' and resep.id_kategori = kategori.id_kategori");
while($rs = mysql_fetch_array($q)){
$date = new DateTime($rs['tglBuat']);
$reviewer = mysql_num_rows(mysql_query("select * from review where id_resep = $rs[id_resep]"));
$rt = mysql_fetch_array(mysql_query("select SUM(rating) as ratingtotal from review where id_resep = $rs[id_resep]")); 
echo"<div class='favrecbox'>
<div class='favrecimg' style='background:url(img/recipe/$rs[image])'></div>
<a href='admin.php?view=detailres&id=$rs[id_resep]#judulRes'><h1>$rs[judul]</h1></a>
<label>Dibuat : </label><span>"; echo $date->format('j F, Y')."</span><br />
<label>Kategori : </label><span>$rs[kategori]</span><br />
<label>Rating : </label><span>"; if($reviewer == 0) {echo "N/A";} else { echo round( ($rt['ratingtotal'] / $reviewer), 1, PHP_ROUND_HALF_UP);} echo"</span>
</div>";
	}
	echo"</div></div>";
}
else
{echo"<span>Favorited Recipes</span>";}

break;
}


?>


</div>

</div>

</body>
<script>
  /* when document is ready */
  $(function(){

    /* iniciate jPages without setting any css animation
     * and setting the fallback fadeIn speed to 500
     */
     $("div.holder").jPages({
      	containerID : "tablepag",
		perPage : 20,
		delay: 15,
		previous    : "Sebelumnya",
		next        : "Selanjutnya"
    });

   });
  </script>
  
    <script>
  $(function() {
    $("div.holder").jPages({
      containerID: "thumbview",
      previous : "Sebelumnya",
      next : "Selanjutnya",
      perPage:15,
      midRange: 7,
	  delay: 100,
	  direction: "random",
      animation: "flipInX"
    });
  });
  </script>
  
<script>
$(document).ready( function() {
	$('.delcon').click( function() {
		$('#confirmDel').show().addClass('animCB');
		var linkdel = $(this).attr('href');
		$('#conTrue').attr('href',linkdel);		
		$('#conFalse').click( function() {
			$('#confirmDel').fadeOut(120);
		});
		return false;
	});	
}); 
</script>
<script>
$(document).ready( function() {
	$('.adkat').click( function() {
		$('#addKbox').show().addClass('animCB');	
		$('#kFalse').click( function() {
			$('#addKbox').fadeOut(120);
		});
		return false;
	});	
}); 
</script>
<script>
$(document).ready( function() {
	$('.adhid').click( function() {
		$('#addHbox').show().addClass('animCB');	
		$('#hFalse').click( function() {
			$('#addHbox').fadeOut(120);
		});
		return false;
	});	
}); 
</script>
<script>
$(document).ready(function($){
	$("input.autobahan").autocomplete({source:'data/auto.php', delay: 200});
	});
</script>
<script type="text/javascript">
$(document).ready( function() {
	
	var edit = $('#jml_editB').val();
	if(edit!=null)
	var kode = Number(edit);
	else
	var kode = 2;
	
	//short mode
    shortcut.add("shift+q", function() {
		var tambah = $('#addBahan');
		tambah.append("<div class='wrapform fading'><div class='sideform'><li>Bahan "+kode+" : </li><li>Keterangan :</li></div><div class='sideform'><li><input type='text' name=b"+kode+" class='autobahan' /></li><li><input autocomplete='off' type='text' name=k"+kode+" placeholder='Contoh : 3 buah, 200gr, 100ml, etc' /></li></div></div>");
		$('.autobahan').focus();
		kode=kode+1;
		
		$("input.autobahan").autocomplete({source:'data/auto.php', minLength:2});
		$('#jumlahB').append(1);
    }); 
	
	//click mode
	$('#addButonB').live('click',function() {
		var tambah = $('#addBahan');
		tambah.append("<div class='wrapform fading'><div class='sideform'><li>Bahan "+kode+" : </li><li>Keterangan :</li></div><div class='sideform'><li><input type='text' name=b"+kode+" class='autobahan' /></li><li><input autocomplete='off' type='text' name=k"+kode+" placeholder='Contoh : 3 buah, 200gr, 100ml, etc' /></li></div></div>")
		kode=kode+1;
		
		$("input.autobahan").autocomplete({source:'data/auto.php', minLength:2});
		$('#jumlahB').append(1);
	}); 
	
});
</script>

<script type="text/javascript">
$(document).ready( function() {
	
	var edit = $('#jml_editC').val();
	if(edit!=null)
	var kode = Number(edit);
	else
	var kode = 2;
	
	//short mode
	shortcut.add("shift+e", function() {
		var tambah = $('#addLangkah');
		tambah.append("<div class='wrapform fading'><div class='sideform'><li>Langkah "+kode+" : </li></div><div class='sideform'><li><textarea name=l"+kode+" class='carra'></textarea></li></div></div>");
		$('.carra').focus();
		kode=kode+1;
		$('#jumlahL').append(1);
	});
	
	//click mode
	$('#addButonL').live('click',function() {
		var tambah = $('#addLangkah');
		tambah.append("<div class='wrapform fading'><div class='sideform'><li>Langkah "+kode+" : </li></div><div class='sideform'><li><textarea name=l"+kode+"></textarea></li></div></div>");
		kode=kode+1;
		$('#jumlahL').append(1);
	}); 
});
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