<?php
include("koneksi.php");
$id_akun = $_POST['id_akun'];
$username = $_POST['username'];
$password = $_POST['password'];
if(!empty($password)){
	$password = md5($_POST['password']);
	$p = ",password='$password'";
}else{
	$p = "";
}
$level = $_POST['level'];
if(empty($username)||empty($level)){
	$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
	header("Location: index.php?menu=akun&id_akun=$id_akun");
}else{
	$query = mysql_query("UPDATE akun SET username='$username',level='$level'$p WHERE id_akun='$id_akun'");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil diubah";
		header("Location: index.php?menu=akun");
	}else{
		$_SESSION['alert'] = "0,Data gagal diubah";
		header("Location: index.php?menu=akun&id_akun=$id_akun");
	}
}
?>