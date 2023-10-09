<?php
include("koneksi.php");
$id_kode = $_GET['id_kode'];
if(empty($id_kode)){
		$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
		header("Location: index.php?menu=kode");
}else{
	$query = mysql_query("DELETE FROM kode WHERE id_kode='$id_kode'");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil dihapus";
		header("Location: index.php?menu=kode");
	}else{
		$_SESSION['alert'] = "0,Data gagal dihapus";
		header("Location: index.php?menu=kode");
	}
}
?>