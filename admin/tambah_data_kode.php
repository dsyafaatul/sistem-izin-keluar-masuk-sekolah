<?php
include("koneksi.php");
$kode = $_POST['kode'];
if(empty($kode)){
	$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
	header("Location: index.php?menu=kode");
}else{
	$query = mysql_query("INSERT INTO kode VALUES('','$kode')");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil ditambah";
		header("Location: index.php?menu=kode");
	}else{
		$_SESSION['alert'] = "0,Data gagal ditambah";
		header("Location: index.php?menu=kode");
	}
}
?>