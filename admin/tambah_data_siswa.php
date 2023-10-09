<?php
include("koneksi.php");
$nis = $_POST['nis'];
$nama_siswa = $_POST['nama_siswa'];
$id_kelas = $_POST['id_kelas'];
$jenis_kelamin = ($_POST['jenis_kelamin']=="Laki-laki"?"L":"P");
$no_hp = $_POST['no_hp'];
if(empty($nis)||empty($nama_siswa)||empty($id_kelas)||empty($jenis_kelamin)){
	$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
	header("Location: index.php?menu=siswa");
}else{
	$query = mysql_query("INSERT INTO siswa VALUES('','$nis','$nama_siswa','$id_kelas','$jenis_kelamin','$no_hp')");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil diubah";
		header("Location: index.php?menu=siswa");
	}else{
		$_SESSION['alert'] = "0,Data gagal diubah";
		header("Location: index.php?menu=siswa");
	}
}
?>