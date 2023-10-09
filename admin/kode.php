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
		Data Kode
		<span class="pull-right" id="date"></span>
	</div>
	<div class="panel-body">
		<?php if(empty($_GET['id_kode'])){ ?>
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
					<th>Nama Kode</th>
					<th width="50">Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = 0;
			$query = mysql_query("SELECT * FROM kode ORDER BY id_kode ASC");
			while($data = mysql_fetch_array($query)){
			?>
				<tr>
					<td><?php echo ++$no ?></td>
					<td><?php echo $data["kode"] ?></td>
					<td>
						<a href="hapus_data_kode.php?id_kode=<?php echo $data['id_kode'] ?>" class="btn btn-danger btn-sm" onclick="return window.confirm('Anda yakin akan menghapus data <?php echo $data['kode'] ?>?')"><span class="glyphicon glyphicon-trash"></span></a>
						<a href="index.php?menu=kode&id_kode=<?php echo $data['id_kode'] ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
					</td>
			<?php } ?>
			</tbody>
		</table>
		<div class="modal fade" id="modal_tambah">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">Tambah data</div>
					<div class="modal-body">
						<form action="tambah_data_kode.php" method="POST" class="form">
							<div class="form-group">
								<input type="text" name="kode" class="form-control" placeholder="Kode" required="required" autofocus="autofocus">
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
			$id_kode = $_GET['id_kode'];
			$query = mysql_query("SELECT * FROM kode WHERE id_kode='$id_kode'");
			$data = mysql_fetch_array($query);
			$kode = $data['kode'];
		?>
		<form action="edit_data_kode.php" method="POST" class="form">
			<input type="hidden" name="id_kode" value="<?php echo $data['id_kode'] ?>">
			<div class="form-group">
				<input type="text" name="kode" class="form-control" placeholder="kode" required="required" value="<?php echo $kode ?>" autofocus="autofocus">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-success" value="Simpan">
				<input type="button" name="batal" class="btn btn-default" value="Batal" onclick="document.location='index.php?menu=kode'">
			</div>
		</form>
		<?php } ?>
	</div>
</div>
<?php } ?>