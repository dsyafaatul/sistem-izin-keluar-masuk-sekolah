<?php
include("koneksi.php");
$id_siswa = $_GET['id_siswa'];
if(empty($id_siswa)){
		$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
		header("Location: index.php?menu=siswa");
}else{
	$query = mysql_query("DELETE FROM siswa WHERE id_siswa='$id_siswa'");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil dihapus";
		header("Location: index.php?menu=siswa");
	}else{
		$_SESSION['alert'] = "0,Data gagal dihapus";
		header("Location: index.php?menu=siswa");
	}
}
?>