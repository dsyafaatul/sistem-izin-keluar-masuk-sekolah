<?php
include("koneksi.php");
$nis = $_POST['nis'];
$keterangan = $_POST['keterangan'];
$kode = $_POST['kode'];
if(empty($nis)||empty($kode)){
	$_SESSION['alert'] = "0,Data ada yang kosong, tolong isi data";
	header("Location: index.php");
}else{
	$query = mysql_query("SELECT * FROM kode WHERE kode='$kode'");
	if(mysql_num_rows($query)>0){
		$data_kode = mysql_fetch_array($query);
		$id_kode = $data_kode['id_kode'];
		$query = mysql_query("SELECT * FROM izin WHERE id_kode='$id_kode' AND tanggal=CURRENT_DATE() AND status='T'");
		if(mysql_num_rows($query)<=0){
			$query = mysql_query("SELECT * FROM izin WHERE nis='$nis' AND tanggal=CURRENT_DATE() AND status='T'");
			if(mysql_num_rows($query)>=1){
				$_SESSION['alert'] = "0,Anda belum mengembalikan kartu sebelumnya";
				header("Location: index.php");
			}else{
				$query = mysql_query("SELECT * FROM izin WHERE nis='$nis' AND tanggal=CURRENT_DATE()");
				if(mysql_num_rows($query)>=10){
					$_SESSION['alert'] = "0,Anda sudah melakukan izin 10x kartu hari ini";
					header("Location: index.php");
				}else{
					$query = mysql_query("INSERT INTO izin VALUES('','$id_kode','$nis',CURRENT_DATE(),CURRENT_TIME(),'','$keterangan','T')");
					if($query){
						$_SESSION['alert'] = "1,Data berhasil ditambah";
						header("Location: index.php");
					}else{
						$_SESSION['alert'] = "0,Data gagal ditambah";
						header("Location: index.php");
					}
				}
			}
		}else{
			$_SESSION['alert'] = "0,Kartu sedang digunakan";
			header("Location: index.php");
		}
	}else{
		$_SESSION['alert'] = "0,Kartu yang dimasukan salah";
		header("Location: index.php");
	}
}
?>