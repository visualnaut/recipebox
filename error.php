<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Oops!</title>
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
.img { width:20em; height:20em; background:url(icons/error.png); float:left; background-size:cover; position:relative; -webkit-animation:animateimg 0.4s; -webkit-animation-iteration-count:1; opacity:1;right:10px}
.text { width:auto; height:auto; float:left; font-family:"Segoe UI"; font-size:45pt; color:#fff; text-shadow:0px 0px 1px #fff; position:relative;-webkit-animation:animatetext 0.4s; -webkit-animation-iteration-count:1; opacity:1}
.text span {font-family:"Segoe UI Light"; font-size:35pt;}
.error a { position:absolute; bottom:0; right:0; font-size:18pt; padding:3px 8px 3px 8px; background:#fff; color:#ff6600; text-decoration:none; font-family:"Segoe UI"}

@-webkit-keyframes animateimg {
	from { right: 200px; opacity:0}
	to { right:0px; opacity:1}
	}
@-webkit-keyframes animatetext {
	from { left: 200px; opacity:0}
	to { left:0px; opacity:1}
	}
</style>

</head>
<body>
<div class="error">
<div class="img"></div>
<div class="text">
Ooops! <br>
<span>Something Got Wrong</span>
</div>
<br><a href="#" onClick="history.go(-2)">Go Back</a>
</div>
</body>
</html>
