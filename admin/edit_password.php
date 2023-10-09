<?php
include("koneksi.php");
$id_akun = $_SESSION['id_akun'];
$password_old = $_POST['password_old'];
$password_new = $_POST['password_new'];
$password_repeat = $_POST['password_repeat'];
if(empty($password_old)||empty($password_repeat)||empty($password_new)){
	$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
	header("Location: index.php?menu=ganti_password");
}else{
	$query = mysql_query("SELECT * FROM akun WHERE id_akun='$id_akun'");
	$data = mysql_fetch_array($query);
	if(md5($password_old)==$data['password'])){
		if(md5($password_new)==(md5($password_repeat)){
			$password_new = md5($password_new);
			$query = mysql_query("UPDATE akun SET password='$password_new' WHERE id_akun='$id_akun'");
			if($query){
		$_SESSION['alert'] = "1,Data berhasil diubah";
		header("Location: index.php?menu=ganti_password");
			}else{
		$_SESSION['alert'] = "0,Data gagal diubah";
		header("Location: index.php?menu=ganti_password");
			}
		}else{
		$_SESSION['alert'] = "0,Password tidak sama";
		header("Location: index.php?menu=ganti_password");
		}
	}else{
		$_SESSION['alert'] = "0,Password lama salah";
		header("Location: index.php?menu=ganti_password");
	}
}
?>