<?php
include("koneksi.php");
$kode = (!empty($_POST['kode'])?$_POST['kode']:"");
if(empty($_GET['id_izin'])){
	if(empty($kode)){
		$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
		header("Location: index.php");
	}else{
		$query = mysql_query("SELECT * FROM kode WHERE kode='$kode'");
		if(mysql_num_rows($query)>0){
			$data_kode = mysql_fetch_array($query);
			$id_kode = $data_kode['id_kode'];
			$query = mysql_query("SELECT * FROM izin WHERE id_kode='$id_kode' AND tanggal=CURRENT_DATE() AND status='T'");
			if(mysql_num_rows($query)>0){
				$data_kode = mysql_fetch_array($query);
				$id_izin = $data_kode['id_izin'];
				$query = mysql_query("UPDATE izin SET waktu_masuk=CURRENT_TIME(),status='Y' WHERE id_izin='$id_izin'");
				if($query){
					$_SESSION['alert'] = "1,Data berhasil diubah";
					header("Location: index.php");
				}else{
					$_SESSION['alert'] = "0,Kode sudah digunakan";
					header("Location: index.php");
				}
			}else{
				$_SESSION['alert'] = "0,Kode yang dimasukan salah";
				header("Location: index.php");
			}
		}else{
			$_SESSION['alert'] = "0,Kode yang dimasukan salah";
			header("Location: index.php");
		}
	}
}else{
	$id_izin = $_GET['id_izin'];
	$query = mysql_query("SELECT * FROM izin WHERE id_izin='$id_izin'");
	$data = mysql_fetch_array($query);
	if($data['status']=="T"){
		$query = mysql_query("UPDATE izin SET waktu_masuk=CURRENT_TIME(),status='Y' WHERE id_izin='$id_izin'");
		if($query){
			$_SESSION['alert'] = "1,Data berhasil diubah";
			header("Location: index.php?menu=izin");
		}else{
			$_SESSION['alert'] = "0,Kode sudah digunakan";
			header("Location: index.php?menu=izin");
		}
	}else{
		$query = mysql_query("UPDATE izin SET waktu_masuk='00:00:00',status='T' WHERE id_izin='$id_izin'");
		if($query){
			$_SESSION['alert'] = "1,Data berhasil diubah";
			header("Location: index.php?menu=izin");
		}else{
			$_SESSION['alert'] = "0,Kode sudah digunakan";
			header("Location: index.php?menu=izin");
		}
	}
}
?>