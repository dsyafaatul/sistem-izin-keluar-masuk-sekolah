<?php
if(!$koneksi){
	header("Location: index.php");
}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		Ganti Password
		<span class="pull-right" id="date"></span>
	</div>
	<div class="panel-body">
		<form action="edit_password.php" method="POST" class="form">
			<div class="form-group">
				<input type="password" name="password_old" class="form-control" placeholder="Password lama" required="required">
			</div>
			<div class="form-group">
				<input type="password" name="password_new" class="form-control" placeholder="Password baru" required="required">
			</div>
			<div class="form-group">
				<input type="password" name="password_repeat" class="form-control" placeholder="Ulangi password" required="required">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-success" value="Simpan">
				<input type="button" name="batal" class="btn btn-default" value="Batal" onclick="document.location='index.php'">
			</div>
		</form>
	</div>
</div>