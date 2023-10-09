<?php
include("koneksi.php");
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];
if(empty($username)||empty($password)||empty($level)){
	$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
		header("Location: index.php?menu=akun");
}else{
	$password = md5($password);
	$query = mysql_query("INSERT INTO akun VALUES('','$username','$password','$level')");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil ditambah";
		header("Location: index.php?menu=akun");
	}else{
		$_SESSION['alert'] = "0,Data gagal ditambah";
		header("Location: index.php?menu=akun");
	}
}
?>