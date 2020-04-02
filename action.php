
<?php

$include = include('connect.php'); 
if (!$include) {
	ob_clean();
    die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php">');
}

if($_SESSION['open'] == TRUE){}else{header("location:index.php");}

session_start();

$aksi = $_GET['act'];
switch($aksi)
{	
	//Login Action
	case "log" : 
	
	if (!isset($_SESSION['open'])) {
    $_SESSION['open'] = FALSE;
	}
	if (!isset($_SESSION['id'])) {
		$_SESSION['id'] = NULL;
	}
	if (!isset($_SESSION['type'])) {
		$_SESSION['type'] = NULL;
	}

	
	if($_SESSION['id'] != NULL AND $_SESSION['type'] != NULL){
		$_SERVER['HTTP_REFERER'];
		}
		
	$uname = mysql_real_escape_string($_POST['uname']);
	$pass = mysql_real_escape_string($_POST['password']);
	
	$query = mysql_query("select id_user, username, password, tipe from user where username = '$uname' AND BINARY password = '$pass'") or die( mysql_error());
	$data = mysql_fetch_array($query);
	
	if($data == NULL){
		header('location:referrer.php?show=logfail');
		} else {
	$_SESSION['open'] = TRUE;
	$_SESSION['id'] = $data['id_user'];
	$_SESSION['type'] = $data['tipe'];
	header('location:referrer.php?show=logSucces');
		}
	
	break;
	
	//Logout Action
	case "logout" : 
	session_destroy();
	header('location:referrer.php?show=outSucces');
	
	break;
	
	//tambah resep
	case "addresep" :
	
	$judul = ucwords(strtolower($_POST['judul']));
	$id_hid = $_POST['hidangan'];
	$id_kat = $_POST['kategori'];
	$caption = $_POST['caption'];
	$tgl = date("Y-m-d");
	$id_user = $_SESSION['id'];
	$prep = $_POST['prep'];
	$cook = $_POST['cook'];
	$ready = $_POST['ready'];
	$kol = $_POST['kol'];
	$kal = $_POST['kal'];
	$fat = $_POST['fat'];
	
	$namafile=$_FILES['mimg']['name'];
	if ($namafile != NULL){
	$dir='img/recipe/';
	$temp=$_FILES['mimg']['tmp_name'];
	}else {$namafile = 'default.jpg';}
	
	move_uploaded_file($temp, $dir.$namafile);
	
	mysql_query("insert into resep(id_user, judul, tglBuat, caption, image, id_hidangan, id_kategori, prep, cook, ready, kalori, kolesterol, lemak) values('$id_user', '$judul', '$tgl', '$caption', '$namafile', '$id_hid', '$id_kat', '$prep', '$cook', '$ready', '$kal', '$kol', '$fat')") or die(mysql_error());
	
	$idrec = mysql_fetch_array(mysql_query("select id_resep from resep order by id_resep DESC limit 1"));
	
	//insert bahan
	$jmlB = $_POST['jmlB'];
	$a = strlen($jmlB)+1;
	for($i=1;$i<=$a;$i++) {
		$bv = "b".$i;
		$b = $_POST[$bv];
		
		$q = mysql_query("select id_bahan from bahan where nama_bahan = '$b'");
		$nrs = mysql_num_rows($q);
		
		//cek bahan sudah ada ?
		if ($nrs <= 0){
			//bahan belum ada lanjut insert & ambil id-nya
			$bCap = ucfirst(strtolower($b));
			if($bCap != NULL){
				mysql_query("insert into bahan(nama_bahan) values('$bCap')");
				$id_bah = mysql_fetch_array(mysql_query("select id_bahan from bahan where nama_bahan = '$b'"));}
			} else {
				//bahan ada tinggal ambil id
				$id_bah = mysql_fetch_array($q);
			}
		$k = $_POST['k'.$i.''];
	if($b != NULL){
		mysql_query("insert into bahanresep(id_resep, id_bahan, keterangan) value ('$idrec[id_resep]','$id_bah[id_bahan]','$k')");}	
	}
	
	//insert langkah
	$jmlL = $_POST['jmlL'];
	$a = strlen($jmlL)+1;
	for($i=1;$i<=$a;$i++) {
		$l = $_POST['l'.$i];
	//	echo $l."<br>";
	if($l != NULL){
		mysql_query("insert into caramasak(id_resep, cara) value ('$idrec[id_resep]','$l')");	}
	}
	header("location:admin.php?view=detailres&id=$idrec[id_resep]");
	break;
	
	case "favorit" :
	
	mysql_query("insert into resepfavorit() values('$_SESSION[id]', '$_GET[id]')");
	header("location:recipe.php?id=$_GET[id]#judulRes");
	
	break;
	
	//registrasi
	case "reg" :
	$user = $_POST['username'];
	$query=mysql_query("select * from user where username = '$user'");
	$check = mysql_num_rows($query);
	if($check > 0){
		//username invalid,  ada dlm db
		header("location:$_SERVER[HTTP_REFERER]?fail=1");
		} else 
		{ //username valid, lanjut insert
		$tgl=str_replace('/', '-', $_POST['tgl']);
		$datenow = date("Y-m-d");
			mysql_query("insert into user(username, password, tipe, fname, lname, birthdate, jkelamin, adress, email, phone, mobile, tgl_register) 
			value('$user', '$_POST[pass]','user','$_POST[fname]','$_POST[lname]','$tgl','$_POST[jk]',
			'$_POST[alamat]','$_POST[email]','$_POST[tel]','$_POST[hp]', '$datenow')");
			header("location:referrer.php?show=regsuc");
			}
	
	
	break;
	
	//add review
	case "addrev" : 
	$id_user = $_SESSION['id'];
	$id_resep = $_GET['idr'];
	$date = date("Y-m-d");
	$rate = $_POST['rating'];
	$rating = $rate / 20;
	mysql_query("insert into review(id_user, id_resep,tglReview, judulReview, review, rating) value ('$id_user', '$id_resep', '$date', '$_POST[title]', '$_POST[review]', '$rating')");
	
	header("location:recipe.php?id=$_GET[idr]#myrev");
	break;
	
	//update review
	case "uprev" : 
	$id_user = $_SESSION['id'];
	$id_resep = $_GET['idr'];
	$date = date("Y-m-d");
	$rate = $_POST['rating'];
	$rating = $rate / 20;
	mysql_query("update review set tglReview = '$date', judulReview = '$_POST[title]', 
	review = '$_POST[review]', rating = '$rating' where id_resep = '$id_resep' and id_user = '$id_user'");
	
	header("location:recipe.php?id=$_GET[idr]#myrev");
	break;
	
	//delete kategori
	case "delka" :
	$q = mysql_query("select * from resep where id_kategori = '$_GET[id]'");
	$qrow = mysql_num_rows($q);
	if($qrow < 1){
			mysql_query("delete from kategori where id_kategori = '$_GET[id]'");
			header("location:admin.php?view=kategori");
		} else {
			$rs2 = mysql_fetch_array(mysql_query("select judul from resep where id_kategori = '$_GET[id]'"));
			echo"kategori di pakai di resep $rs2[judul]";
			}
	
	break;
	
	//delete bahan
	case "delba" :
	$q = mysql_query("select * from bahanresep where id_bahan = '$_GET[id]'");
	$rs = mysql_fetch_array($q);
	$qrow = mysql_num_rows($q);
	if($qrow < 1){
		mysql_query("delete from bahan where id_bahan = '$_GET[id]'");
		header("location:admin.php?view=bahan");
		} else {
			$rs2 = mysql_fetch_array(mysql_query("select judul from resep where id_resep = '$rs[id_resep]'"));
			echo"bahan di pakai di resep $rs2[judul]";
			}
	
	break;
	
	//delete kategori
	case "delhi" :
	$q = mysql_query("select * from resep where id_hidangan = '$_GET[id]'");
	$qrow = mysql_num_rows($q);
	if($qrow < 1){
			mysql_query("delete from hidangan where id_hidangan = '$_GET[id]'");
			header("location:admin.php?view=hidangan");
		} else {
			$rs2 = mysql_fetch_array(mysql_query("select judul from resep where id_hidangan = '$_GET[id]'"));
			echo"hidangan di pakai di resep $rs2[judul]";
			}
	
	break;
	
	//delete resep
	case "delre" :
	
	mysql_query("delete from resep where id_resep = $_GET[id]");
	mysql_query("delete from bahanresep where id_resep = $_GET[id]");
	mysql_query("delete from caramasak where id_resep = $_GET[id]");
	mysql_query("delete from review where id_resep = $_GET[id]");
	header("location:admin.php?view=resep");
	
	break;
	
	//add kategori
	case "addkat" :
	mysql_query("insert into kategori(kategori) values('$_POST[kategori]')");
	header("location:admin.php?view=kategori");
	
	break;
	
	//add hidangan
	case "addhid" :
	mysql_query("insert into hidangan(hidangan) values('$_POST[hidang]')");
	header("location:admin.php?view=hidangan");
	
	break;
	
	//edit resep
	case "editres" :
	
	$judul = ucwords(strtolower($_POST['judul']));
	$id_hid = $_POST['hidangan'];
	$id_kat = $_POST['kategori'];
	$caption = $_POST['caption'];
	$tgl = date("Y-m-d");
	$prep = $_POST['prep'];
	$cook = $_POST['cook'];
	$ready = $_POST['ready'];
	$kol = $_POST['kol'];
	$kal = $_POST['kal'];
	$fat = $_POST['fat'];
	
	$namafile=$_FILES['mimg']['name'];
	if ($namafile != NULL){
	$dir='img/recipe/';
	$temp=$_FILES['mimg']['tmp_name'];
	}else {
		$img = mysql_fetch_array(mysql_query("select image from resep where id_resep = '$_GET[id]'"));
		$namafile = $img['image'];
		}
	
	move_uploaded_file($temp, $dir.$namafile);
	
	mysql_query("update resep set judul='$judul', tglBuat='$tgl', caption='$caption', image='$namafile', id_hidangan='$id_hid', id_kategori='$id_kat', prep='$prep', cook='$cook', ready='$ready', kalori='$kal', kolesterol='$kol', lemak='$fat') where id_resep = '$_GET[id]'") or die(mysql_error());
	
// bagian edit langkah
	//insert langkah
/*	$jmlL = $_POST['jmlL'];
	$q = mysql_query("select * from caramasak where id_resep = '$_GET[id]'")
	$cara = mysql_num_rows($q);
	$totalcara = strlen($jmlL) + $cara + 1; */
	


	break;
	
}


?>
