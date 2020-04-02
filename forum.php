<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RecipeBox - Forum</title>
<?php
$koneksi = mysql_connect("127.0.0.1", "root", "");
if (!$koneksi) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("recipeboxforum", $koneksi);
?>
<style>
* { padding:0; margin:0}
html { font-family:"Segoe UI"; background:#f2f5f7}
a { color:#ff6600; text-decoration:none}
a:hover { text-decoration:underline} 
.headerwrapper, .navwrapper, .mainwrapper { width:100%; height:100%; background:#f2f5f7; position:relative; border-bottom:thin solid #e2e3e5; overflow:auto; min-width:960px}
.header { width: 295px; height:87px; background:url(icons/forumhead.png); margin-left:40px; border:thin solid #e2e3e5; border-top:none; border-bottom:none; float:left}
.headoption { width:auto; height:5px; padding-top:32px; float:right; margin-right:40px}
.headoption ul { list-style:none; font-size:10pt}
.headoption ul li { float:left; margin-left:10px}

.navwrapper { background:-webkit-linear-gradient(top, #eeeff1 0%, #e7e8ea 100%); border-bottom:thin solid #ccd0d3 }
.navwrapper a {  color:#444}
.navwrapper a:hover { text-decoration:none} 
.navwrapper ul { list-style:none; padding:15px;}
.navwrapper ul li{ float:left; margin-left:30px;  font-family:"Segoe UI Bold"; margin-bottom:15px; position:relative;}
.navwrapper ul .aktif a { color:#ff6600;}
.navwrapper ul .aktif:after { content:url(icons/top_arrow_big.png); position:absolute; left:20%; bottom:-15px;}
.navwrapper ul li:last-child, .navwrapper ul li:nth-child(5) { float:right; font-family:"Segoe UI"}

.subthreadlist { width:100%; height:40px; background:#eff1f3; border-bottom:thin solid #e8ebee; position:relative; margin-top:10px; margin-bottom:10px; min-width:960px}
.subthreadlist ul { list-style:none; height:25px; position:relative; top:8px;}
.subthreadlist ul li { float:left; margin-left:20px; padding:0px 10px 4px 10px}
.subthreadlist ul li a { color:#666}
.subthreadlist ul li:last-child { float:right}
.subthreadlist ul .aktif a {color:#ff6600}
.subthreadlist ul .aktif { border-bottom:4px solid #ff6600;}
.newthread { border:thin solid #ccc; width:200px; height:30px; position:relative; bottom:5px; right:3px; background:url(icons/newthread.png) #fff; background-position:15px 2px; background-repeat:no-repeat; background-size:25px; text-indent:50px; line-height:28px}

.listthreadw {height:auto; background:#fff; overflow:hidden; float:left; width:auto; position:absolute; left:0; right:0;}
.listthreadw .thread:nth-child(2n) { background:#f9f9f9}
.thread { width:100%; height:75px; background:#fff; border-bottom:thin dashed #ccc; position:relative; padding:10px; -webkit-transition:all 0.2s}
.thread:hover { background:#f5f5f5 !important}
.thrimg { width:70px; height:70px; border:thin solid #ccd0d3; position:relative; float:left; margin-left:30px; margin-right:10px}
.thrtitle {}
.thrtitle h3 { display:inline; font-size:12pt}
.thrdetail { color:#888}
.thread .thrdetail:last-child { color:#999; font-size:9pt; margin-top:15px}

.sidebarwrapper { float:right; width:230px; height:500px; background:#ddd; position:relative}
</style>

</head>

<body>
<div class="headerwrapper">
<div class="header"></div>
<div class="headoption">
<ul>
<li><a href=''>Login</a></li>
<li> | </li>
<li><a href=''>Registrasi</a></li>
</ul>
</div>
</div>
<div class="navwrapper">
<ul>
<?php
$query=mysql_query('select * from kategorif');
while($rs=mysql_fetch_array($query)){
	echo"
	<li><a href='forum.php?f=$rs[id_kForum]'>$rs[kForum]</a></li>
	";
	}
//<li class="aktif"> untuk link yang aktif
?>
<li><a href='index.php'>Halaman Utama</a></li>
<li><a href=''>Pencarian</a></li>
</ul>
</div>
<div class='subthreadlist'>
<ul>
<li><a href=''>Semua</a></li>
<?php
if(!isset($forum)){$forum = 1;}
$forum = $_GET['f'];
$query=mysql_query("select * from subkategorif where id_kForum = $forum") or die(mysql_error());
while($result=mysql_fetch_array($query)){
	echo"<li><a href='forum.php?f=$forum&sub=$result[id_sub]'>$result[subkategori]</a></li>";
	}
?>
<li><a href=''><div class="newthread"> Buat Thread Baru</div></a></li>
</ul>
</div>

<div class='mainwrapper'>
<div class="listthreadw">

<div class="thread">
<div class="thrimg"></div>
<div class="thrtitle"><a href=''><h3>Thread baru! woooooooooooooooooooooooooooow!!!</h3></a></div>
<div class='thrdetail'>[Berita] | <a href=''>Kersa</a>, 3 January 2013 | Dilihat : 1200 | Dibalas : 10  </div>
<div class='thrdetail'>Terakhir dibalas oleh <a href=''>andika</a>, <a href=''>10 January 2013</a> </div>
</div>

<div class="thread">
<div class="thrimg"></div>
<div class="thrtitle"><a href=''><h3>Thread baru! woooooooooooooooooooooooooooow!!!</h3></a></div>
<div class='thrdetail'>[Berita] | <a href=''>Kersa</a>, 3 January 2013 | Dilihat : 1200 | Dibalas : 10  </div>
<div class='thrdetail'>Terakhir dibalas oleh <a href=''>andika</a>, <a href=''>10 January 2013</a> </div>
</div>


</div>

<div class="sidebarwrapper">
asa
</div>


</div>
</body>
</html>