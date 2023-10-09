<?php
include("koneksi.php");
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string(md5($_POST['password']));
$query = mysql_query("SELECT * FROM akun WHERE username='$username'");
$count = mysql_num_rows($query);
if($count>=1){
	$query = mysql_query("SELECT * FROM akun WHERE username='$username' AND password='$password'");
	$count = mysql_num_rows($query);
	$data = mysql_fetch_array($query);
	if($count>=1){
		$_SESSION['id_akun'] = $data['id_akun'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['alert'] = "1,Login berhasil";
		header("Location: index.php");
	}else{
		$_SESSION['alert'] = "0,Password salah";
		header("Location: index.php");
	}
}else{
		$_SESSION['alert'] = "0,Akun tidak ditemukan";
		header("Location: index.php");
}
?>