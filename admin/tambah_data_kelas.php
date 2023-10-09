<?php
include("koneksi.php");
$nama_kelas = $_POST['nama_kelas'];
if(empty($nama_kelas)){
	$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
	header("Location: index.php?menu=kelas");
}else{
	$query = mysql_query("INSERT INTO kelas VALUES('','$nama_kelas')");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil ditambah";
		header("Location: index.php?menu=kelas");
	}else{
		$_SESSION['alert'] = "0,Data gagal ditambah";
		header("Location: index.php?menu=kelas");
	}
}
?>