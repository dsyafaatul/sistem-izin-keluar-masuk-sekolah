<?php
if(!$koneksi){
	header("Location: index.php");
}
?>
<?php
$menu = !empty($_GET['menu'])?$_GET['menu']:"";
switch($menu){
	case "siswa":
		include("siswa.php");
	break;
	case "kelas":
		include("kelas.php");
	break;
	case "akun":
		include("akun.php");
	break;
	case "laporan":
		include("laporan.php");
	break;
	case "kode":
		include("kode.php");
	break;
	case "izin":
		include("izin.php");
	break;
	case "ganti_password":
		include("ganti_password.php");
	break;
	default:
		include("utama.php");
	break;
}
?>