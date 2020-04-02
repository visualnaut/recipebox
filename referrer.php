<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/png" href="icons/fav.png" />
<title>Recipe Box</title>
<style>
body {background:#ff6600; }
.error{
    position:fixed;
    top: 50%;
    left: 50%;
    width:50em;
    height:20em;
    margin-top: -10em; /*set to a negative number 1/2 of your height*/
    margin-left: -25em; /*set to a negative number 1/2 of your width*/
}
*:focus {
    outline: none;
}
.img { width:300px; height:300px; float:left; background-size:cover !important; position:relative; -webkit-animation:animateimg 1s; -webkit-animation-iteration-count:1; opacity:1;right:10px}
.text { width:auto; height:auto; float:left; font-family:"Segoe UI"; font-size:45pt; color:#fff; text-shadow:0px 0px 1px #fff; position:relative;-webkit-animation:animatetext 0.8s; -webkit-animation-iteration-count:1; opacity:1; margin-left:20px}
.text span {font-family:"Segoe UI Light"; font-size:35pt;}
.error a { position:absolute; bottom:80px; right:0; font-size:15pt; padding:3px 8px 3px 8px; background:#fff; color:#ff6600; text-decoration:none; font-family:"Segoe UI"}
.error a:last-child{bottom:40px;}
.error a:hover { text-decoration:underline}
.loginpane { position:absolute; width:280px; height:200px; background:none; top:0; right:0; padding:0; margin:0; font-family:"Segoe UI"; color:#ff6600; background:#fff; border-left:20px solid #dd5500; padding-right:10px; padding-top:10px}
.loginpane h3 { font-family:"Segoe UI"; text-align:center; padding:0; padding-bottom:5px; margin:0; font-weight:normal; border-bottom:thin solid #f6f6f6}
.loginpane table tr td a { position:relative; background:none; color:#ff6600; font-size:10pt; left:-7px; top:0 }
.loginpane table tr td span { font-size:11pt; }
.loginpane input { padding:5px; border: 2px solid #ff6600}
.loginpane input[type=checkbox] { margin-left:0; position:relative; top:1px}
.loginpane input[type=text], .loginpane input[type=password]{ width:170px}
.loginpane input[type=submit] { border:2px solid #dd5500; background:#ff6600; color:#fff; width:90px;}
.loginpane input[type=submit]:hover { background:#fff; color:#ff6600}
.loginpane table { float:right}

@-webkit-keyframes animateimg {
	from {top:-200px; opacity:0}
	to {top:0; opacity:1}
	}
@-webkit-keyframes animatetext {
	from {right:-200px; opacity:0}
	to {right:0px; opacity:1}
	}
</style>

</head>
<body>
<div class="error">
<?php
$include = include('connect.php'); 
if (!$include) {
	ob_clean();
    die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');
}
session_start();
$show = $_GET['show'];
//Show Check
if (!$show) 
	{ob_clean();
	die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');}
	
switch($show){
	
	default : 
	echo"<META HTTP-EQUIV='Refresh' CONTENT='0;URL=error.php'>";
	break;
	
	//Login Success
	case "logSucces" :
	
	//Admin Redirect
	$query = mysql_query("select img, fName, lName from user where id_user = '$_SESSION[id]'");
	$data = mysql_fetch_array($query);	
	
	//Data Check
	if (!$data) 
	{ob_clean();
	die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');}
	
	echo"<div class='img' style='background:url(img/profile/$data[img])'></div>
	<div class='text'>
	Welcome, <br>
	<span>$data[fName] $data[lName]</span>
	</div>";
		if($_SESSION['type'] == 'admin'){
		echo"<a href='admin.php'>To Admin Panel</a>";
			} else 	{
					//User Redirect
					echo"<a href='profile.php'>To Profile Page</a>";
					}
		echo"<a href='index.php'>Back to Main Page</a>";
	break;
	
	
	//Logout Success
	case "outSucces" :
	echo"<div class='text'>
	Thank You, <br>
	Come Back Soon <br>
	</div>
	<a href='index.php'>Back to Main Page</a>";
	break;
	
	//Login Fail
	case "logfail" :
	if ($_SESSION['open'] == TRUE){
		header('location:index.php');} 
				else {
					echo"<div class='text' style='width:450px;'>
					Username atau Password salah.
					</div>
					<div class='loginpane'>
					<form method='post' action='action.php?act=log'>
					<table border='0'>
					<tr>
					<td>Username</td><td><input type='text' name='uname' placeholder='username'  /></td>
					</tr>
					<tr>
					<td>Password</td><td><input type='password' name='password' placeholder='password'   /></td>
					</tr>
					<tr>
					<td valign='top' colspan='2'><input type='checkbox' name='remember' /> <span>Remember me ?</span></td>
					</tr>
					<tr>
					<td valign='top' colspan='2'><input type='submit' value='Login'  /></td>
					</tr>
					<tr>
					<td valign='top' colspan='2'><a href='#'>lupa password?</a></td>
					</tr>
					</table>
					</form>
					</div>
					<a href='index.php'>Back to Main Page</a>";
					break;}
					
		case "regsuc" :
			echo"<div class='text' style='width:450px;'>
					Selamat! <br><span>akun berhasil dibuat.</span>
					</div>
					<div class='loginpane'>
					<h3>Silahkan Login Disini</h3>
					<form method='post' action='action.php?act=log'>
					<table border='0'>
					<tr>
					<td>Username</td><td><input type='text' name='uname' placeholder='username'  /></td>
					</tr>
					<tr>
					<td>Password</td><td><input type='password' name='password' placeholder='password'   /></td>
					</tr>
					<tr>
					<td valign='top' colspan='2'><input type='checkbox' name='remember' /> <span>Remember me ?</span></td>
					</tr>
					<tr>
					<td valign='top' colspan='2'><input type='submit' value='Login'  /></td>
					</tr>
					<tr>
					<td valign='top' colspan='2'><a href='#'>lupa password?</a></td>
					</tr>
					</table>
					</form>
					</div>
					<a href='index.php'>Back to Main Page</a>";
		
		break;
				
					
	
			}
?>

</div>
</body>
</html>
