<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
$koneksi = mysql_connect("127.0.0.1", "root", "root");
if (!$koneksi) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("recipebox", $koneksi) or die('no database');

?>