<?php
include("koneksi.php");
$id_kelas = $_GET['id_kelas'];
if(empty($id_kelas)){
		$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
		header("Location: index.php?menu=kelas");
}else{
	$query = mysql_query("DELETE FROM kelas WHERE id_kelas='$id_kelas'");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil dihapus";
		header("Location: index.php?menu=kelas");
	}else{
		$_SESSION['alert'] = "0,Data gagal dihapus";
		header("Location: index.php?menu=kelas");
	}
}
?>