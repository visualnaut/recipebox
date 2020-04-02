<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Join With Recipe Box</title>
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="icon" type="image/png" href="icons/fav.png" />
</head>

<body>
<div class="containertop">
<div class="logo"><div class="limg"></div>
<span>Registrasi</span>
</div><a class='join' href='index.php' style="right:10px">Kembali ke halaman utama</a>
<div class="wrapper" style="width:949px; border-bottom:none; padding:5px; position:relative; margin-top:67px; ">
<table class='register' border="0">
<form method="post" action="action.php?act=reg">
<tr><td colspan='2'><h2>Account Info<span>(Dibutuhkan)</span></h2></td></tr>
<tr><td width='300px'><span>Username</span></td><td><input type="text" name="username" required /></td></tr>
<?php if(!isset($_GET['fail'])){$_GET['fail']=0;} switch($_GET['fail']){ case 1 :echo"
<tr><td></td><td><div class='enotif'>Username Sudah Digunakan</div></td></tr>"; }?>

<tr><td><span>Email</span></td><td><input type="email" name='email' required /></td></tr>
<tr><td><span>Password</span></td><td><input type="password" name='pass' required /></td></tr>

<tr><td colspan='2'><h2>Personal Info</h2></td></tr>
<tr><td><span>Nama Depan</span></td><td><input type="text" name='fname' required /></td></tr>
<tr><td><span>Nama Belakang</span></td><td><input type="text" name='lname' required /></td></tr>
<tr><td><span>Tanggal Lahir</span></td><td><input type="date" name='tgl' /></td></tr>
<tr><td><span>Jenis Kelamin</span></td><td>
<select name='jk'>
<option value='Pria'>Pria</option>
<option value='Wanita'>Wanita</option>
</select>
</td></tr>
<tr><td valign="top"><span>Alamat</span></td><td><textarea name='alamat'></textarea></td></tr>
<tr><td colspan='2'><h2>Contact Info<span>(Opsional)</span></h2></td></tr>
<tr><td><span>No Telepon</span></td><td><input type="text" name='tel' /></td></tr>
<tr><td><span>No Handphone</span></td><td><input type="text" name='hp' /></td></tr>
<tr><td colspan='2'><h2></h2></td></tr>
<tr><td colspan='2' align="center"><input type="submit" value="Register" />
<input type="reset" value="Reset" /></td></tr>
</form>
</table>
<div class="footer" style=" margin-top:30px ;border-top:thin dashed #ccc;">
<p>Recipe Box (c) 2013</p>
</div>
</div>

</body>
</html>