<?php
include("koneksi.php");
$id_siswa = $_POST['id_siswa'];
$nis = $_POST['nis'];
$nama_siswa = $_POST['nama_siswa'];
$id_kelas = $_POST['id_kelas'];
$jenis_kelamin = ($_POST['jenis_kelamin']=="Laki-laki"?"L":"P");
$no_hp = $_POST['no_hp'];
if(empty($nis)||empty($nama_siswa)||empty($id_kelas)||empty($jenis_kelamin)){
	$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
	header("Location: index.php?menu=siswa&id_siswa=$id_siswa");
}else{
	$query = mysql_query("UPDATE siswa SET nis='$nis',nama_siswa='$nama_siswa',id_kelas='$id_kelas',jenis_kelamin='$jenis_kelamin',no_hp='$no_hp' WHERE id_siswa='$id_siswa'");
	if($query){
		$_SESSION['alert'] = "1,Data berhasil diubah";
		header("Location: index.php?menu=siswa");
	}else{
		$_SESSION['alert'] = "0,Data gagal diubah";
		header("Location: index.php?menu=siswa&id_siswa=$id_siswa");
	}
}
?>