<?php
if(!$koneksi){
	header("Location: index.php");
}
?>
<?php
$menu = !empty($_GET['menu'])?$_GET['menu']:"";
switch($menu){
	default:
		include("utama.php");
	break;
}
?>