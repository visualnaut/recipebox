<div class="containertop">
<div class="logo"><div class="limg"></div>
<span>Recipe</span><span>Box</span>
</div>

<?php
if ($_SESSION['open'] == FALSE){
echo"
<a class='join' href='register.php'>Bergabunglah dengan kami!</a>
<div id='login' class='login'>LOGIN BOX
<div class='loginpane'>
<form method='post' action='action.php?act=log'>
<table border='0'><tr>
<td><input type='text' autocomplete='off' name='uname' placeholder='username'  /></td>
<td><input type='password' name='password' placeholder='password'   /></td>
<td rowspan='2' valign='top'><input type='submit' value='Login'  /></td>
</tr><tr>
<td valign='top'><span>Remember me</span><input type='checkbox' name='remember' /></td>
<td valign='top'><a href=''>Forget your password?</a></td>
</tr></table>
</form>
</div>
</div>";}
else {
	
	
	$q = mysql_query( "select fName, lName, imgThumb from user where id_user = $_SESSION[id]") or die(mysql_error());
	$rs = mysql_fetch_array($q);
	
	echo"
	<div class='accinfo'>
	<div class='imgThumb' style='background:url(img/profile/thumb/$rs[imgThumb])'></div>
	<div class='name'><span>$rs[fName]</span> $rs[lName]</div>
	<div class='accoptionbox'>";
	
	if($_SESSION['type'] == 'admin'){echo"<a href='admin.php'><div class='btn'>Admin Pane</div></a> ";}
	echo"<a href='profile.php'><div class='btn'>Profile</div></a>
	<a href=''><div class='btn'>Account Option</div></a>
	<a href='action.php?act=logout'><div class='btn'>Logout</div></a>
	
	
	</div>
	</div>";
	
	}

?>
<ul class="nav">
<li><a href='index.php'>Terbaru</a></li>
<li class="hierarc"><a style="cursor:default">Hidangan</a>
<div class="popbox">
<ul>
<?php 
$query = mysql_query("select * from hidangan");
while($row=mysql_fetch_array($query)){
echo"<a href='index.php?view=hidangan&id=$row[id_hidangan]'><li>$row[hidangan]</li></a>";
}
?>
</ul>
</li>
<li class="hierarc"><a style="cursor:default">Resep</a>
<div class="popbox">
<ul>
<?php 
$query = mysql_query("select * from kategori");
while($row=mysql_fetch_array($query)){
echo"<a href='index.php?view=kategori&id=$row[id_kategori]'><li>$row[kategori]</li></a>";
}
?>
</ul>
</div>
</li>
<li><a href="#">Event</a></li>
<li><form method="post" action="index.php?view=search"><input type='search' name='keyword' placeholder="Contoh : milkshake"><input type='submit' value='Cari' /></form></li>
</ul>
</div>