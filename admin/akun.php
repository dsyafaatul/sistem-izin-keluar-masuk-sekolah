<?php
if(!$koneksi){
	header("Location: index.php");
}
?>
<?php if($_SESSION['level']!="admin"){ ?>
<script type="text/javascript">
	document.location='index.php';
</script>
<?php }else{ ?>
<div class="panel panel-default">
	<div class="panel-heading">
		Data Akun
		<span class="pull-right" id="date"></span>
	</div>
	<div class="panel-body">
		<?php if(empty($_GET['id_akun'])){ ?>
		<div class="btn-group">
			<button class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
				<span class="glyphicon glyphicon-plus-sign"></span>
				Tambah Data
			</button>
			<!-- <button class="btn btn-default" onclick="window.print()">
				<span class="glyphicon glyphicon-print"></span>
				Print
			</button> -->
		</div>
		<table class="table table-bordered table-striped table-hover" id="dataTable" width="100%">
			<thead>
				<tr>
					<th width="10">No</th>
					<th>Username</th>
					<th>Level</th>
					<th width="50">Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = 0;
			$query = mysql_query("SELECT * FROM akun ORDER BY username ASC");
			while($data = mysql_fetch_array($query)){
			?>
				<tr>
					<td><?php echo ++$no ?></td>
					<td><?php echo $data["username"] ?></td>
					<td><?php echo $data["level"] ?></td>
					<td>
					<?php if($data['level']!="admin"){ ?>
						<a href="hapus_data_akun.php?id_akun=<?php echo $data['id_akun'] ?>" class="btn btn-danger btn-sm" onclick="return window.confirm('Anda yakin akan menghapus data <?php echo $data['username'] ?>?')"><span class="glyphicon glyphicon-trash"></span></a>
					<?php } ?>
						<a href="index.php?menu=akun&id_akun=<?php echo $data['id_akun'] ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
					</td>
			<?php } ?>
			</tbody>
		</table>
		<div class="modal fade" id="modal_tambah">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">Tambah data</div>
					<div class="modal-body">
						<form action="tambah_data_akun.php" method="POST" class="form">
							<div class="form-group">
								<input type="text" name="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="Password" required="required">
							</div>
							<div class="form-group">
								<select name="level" id="" class="form-control" required="required">
									<option value="">-- Pilih Level --</option>
									<option value="admin">Admin</option>
									<option value="operator">Operator</option>
								</select>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" class="btn btn-success" value="Tambah">
								<input type="button" name="batal" class="btn btn-default" value="Batal" data-dismiss="modal">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
			}else{
			$id_akun = $_GET['id_akun'];
			$query = mysql_query("SELECT * FROM akun WHERE id_akun='$id_akun'");
			$data = mysql_fetch_array($query);
			$username = $data['username'];
			$level = $data['level'];
		?>
		<form action="edit_data_akun.php" method="POST" class="form">
			<input type="hidden" name="id_akun" value="<?php echo $data['id_akun'] ?>">
			<div class="form-group">
				<input type="text" name="username" class="form-control" placeholder="Username" required="required" value="<?php echo $username ?>" autofocus="autofocus">
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Password">
			</div>
			<div class="form-group">
				<select name="level" id="" class="form-control" required="required">
					<option value="">-- Pilih Level --</option>
					<option value="admin" <?php echo ($level=="admin"?"selected":"") ?>>Admin</option>
					<option value="operator" <?php echo ($level=="operator"?"selected":"") ?>>Operator</option>
				</select>
			</div>
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-success" value="Simpan">
				<input type="button" name="batal" class="btn btn-default" value="Batal" onclick="document.location='index.php?menu=akun'">
			</div>
		</form>
		<?php } ?>
	</div>
</div>
<?php } ?>