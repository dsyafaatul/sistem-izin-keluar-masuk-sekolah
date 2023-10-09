<?php
include("koneksi.php");
$id_izin = $_GET['id_izin'];
if(empty($id_izin)){
		$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
		header("Location: index.php?menu=izin");
}else{
	$query = mysql_query("DELETE FROM izin WHERE id_izin='$id_izin'");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil dihapus";
		header("Location: index.php?menu=izin");
	}else{
		$_SESSION['alert'] = "0,Data gagal dihapus";
		header("Location: index.php?menu=izin");
	}
}
?>