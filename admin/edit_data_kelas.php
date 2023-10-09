<?php
include("koneksi.php");
$id_kelas = $_POST['id_kelas'];
$nama_kelas = $_POST['nama_kelas'];
if(empty($nama_kelas)){
	$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
	header("Location: index.php?menu=kelas&id_kelas=$id_kelas");
}else{
	$query = mysql_query("UPDATE kelas SET nama_kelas='$nama_kelas' WHERE id_kelas='$id_kelas'");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil diubah";
		header("Location: index.php?menu=kelas");
	}else{
		$_SESSION['alert'] = "0,Data gagal diubah";
		header("Location: index.php?menu=kelas&id_kelas=$id_kelas");
	}
}
?>