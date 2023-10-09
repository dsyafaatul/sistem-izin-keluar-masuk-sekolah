<?php
include("koneksi.php");
$id_kode = $_POST['id_kode'];
$kode = $_POST['kode'];
if(empty($kode)){
	$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
	header("Location: index.php?menu=kode&id_kode=$id_kode");
}else{
	$query = mysql_query("UPDATE kode SET kode='$kode' WHERE id_kode='$id_kode'");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil diubah";
		header("Location: index.php?menu=kode");
	}else{
		$_SESSION['alert'] = "0,Data gagal diubah";
		header("Location: index.php?menu=kode&id_kode=$id_kode");
	}
}
?>