<?php
//dsyafaatultamvan
ini_set('display_errors', 0);
session_start();
$host = "localhost";
$user = "root";
$password = "";
$database = "db_izin";
$koneksi = mysql_connect($host,$user,$password);
if($koneksi){
	//echo "server berhasil terhubung";
	$selected = mysql_select_db("db_izin");
	if($selected){
		//echo "database berhasil ditemukan";
	}else{
		echo "database tidak ditemukan";
	}
}else{
	echo "server tidak terhubung";
}
?>
<!--
	name 		: D.Syafa'atul Anbiya
	email		: dikisyafaatul@gmail.com
	facebook	: www.facebook.com/dsyafaatul.a
-->
