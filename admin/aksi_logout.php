<?php
include("koneksi.php");
session_destroy();
session_start();
$_SESSION['alert'] = "1,Logout berhasil";
header("Location:index.php");
?>