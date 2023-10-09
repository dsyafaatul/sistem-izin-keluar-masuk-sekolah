<?php
include("koneksi.php");
$id_akun = $_GET['id_akun'];
if(empty($id_akun)){
		$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
		header("Location: index.php?menu=akun");
}else{
	$query = mysql_query("DELETE FROM akun WHERE id_akun='$id_akun'");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil dihapus";
		header("Location: index.php?menu=akun");
	}else{
		$_SESSION['alert'] = "0,Data gagal dihapus";
		header("Location: index.php?menu=akun");
	}
}
?>