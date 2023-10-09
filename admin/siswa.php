<?php
if(!$koneksi){
	header("Location: index.php");
}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		Data Siswa
		<div class="pull-right">
			<span id="date"></span>
		</div>
	</div>
	<div class="panel-body">
		<?php
		$aksi = !empty($_GET['aksi'])?$_GET['aksi']:"";
		if($aksi=="detail"){ ?>
		<?php
		$id_siswa = $_GET['id_siswa'];
		$query = mysql_query("SELECT * FROM siswa INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE id_siswa=$id_siswa");
		$data = mysql_fetch_array($query);
		?>
		<table class="table table-bordered">
			<tr>
				<td>NIS</td>
				<td width="10">:</td>
				<tD><?php echo $data['nis'] ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td width="10">:</td>
				<tD><?php echo $data['nama_siswa'] ?></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td width="10">:</td>
				<tD><?php echo $data['nama_kelas'] ?></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td width="10">:</td>
				<tD><?php echo ($data['jenis_kelamin'])=="L"?"Laki-laki":"Perempuan" ?></td>
			</tr>
			<tr>
				<td>No HP</td>
				<td width="10">:</td>
				<tD><?php echo $data['no_hp'] ?></td>
			</tr>
		</table>
		<table class="table table-bordered table-striped table-hover" id="dataTable-min" width="100%">
				<thead>
					<tr>
						<th width="10">No</th>
						<th>Kode Kartu</th>
						<th>Bersama siswa</th>
						<th>Tanggal</th>
						<th>Jam Keluar</th>
						<th>Jam Masuk</th>
						<th>Keterangan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$query = mysql_query("SELECT * FROM izin INNER JOIN kode ON kode.id_kode=izin.id_kode INNER JOIN siswa ON siswa.nis=izin.nis INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE id_siswa=$id_siswa");
					while($data = mysql_fetch_array($query)){
						$nis2 = $data['nis2'];
						if($nis2!='-'){
							$data2 = mysql_fetch_array(mysql_query("SELECT nama_siswa FROM siswa WHERE nis='$nis2'"));
							$nama2 = $data2[0];
						}else{
							$nama2 = $nis2;
						}
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['kode']; ?></td>
						<td><?php echo $nama2; ?></td>
						<td><?php echo $data['tanggal']; ?></td>
						<td><?php echo $data['waktu_keluar']; ?></td>
						<td><?php echo $data['waktu_masuk']; ?></td>
						<td><?php echo ($data['keterangan']==""?"-":$data['keterangan']); ?></td>
						<td><?php echo ($data['status']=="Y"?"Sudah masuk":"Belum masuk"); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<input type="button" name="batal" class="btn btn-default" value="Kembali" onclick="document.location='index.php?menu=siswa'">
		<?php }else{ ?>
		<?php if(empty($_GET['id_siswa'])){ ?>
		<?php if($_SESSION['level']=="admin"){ ?>
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
		<?php } ?>
		<table class="table table-bordered table-striped table-hover table-responsive" id="dataTable" width="100%">
			<thead>
				<tr>
					<th width="10">No</th>
					<th>NIS</th>
					<th>Nama</th>
					<th>Kelas</th>
					<th>Jenis Kelamin</th>
					<th>No Hp</th>
					<th width="10">Izin</th>
					<?php if($_SESSION['level']=="admin"){ ?>
					<th width="50">Aksi</th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = 0;
			$query = mysql_query("SELECT * FROM siswa INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas ORDER BY nama_siswa ASC");
			while($data = mysql_fetch_array($query)){
			?>
				<tr>
					<td><?php echo ++$no ?></td>
					<td><?php echo $data["nis"] ?></td>
					<td><a href="index.php?menu=siswa&id_siswa=<?php echo $data["id_siswa"] ?>&aksi=detail"><?php echo $data["nama_siswa"] ?></a></td>
					<td><?php echo $data["nama_kelas"] ?></td>
					<td><?php echo ($data["jenis_kelamin"]=="L"?"Laki-laki":"Perempuan") ?></td>
					<td><?php echo $data["no_hp"] ?></td>
					<?php
						$nis = $data['nis'];
						$q = mysql_query("SELECT COUNT(*) FROM izin WHERE nis='$nis'");
						$jumlah = mysql_fetch_array($q);
					?>
					<td><?php echo $jumlah[0] ?></td>
					<?php if($_SESSION['level']=="admin"){ ?>
					<td>
						<a href="hapus_data_siswa.php?id_siswa=<?php echo $data['id_siswa'] ?>" class="btn btn-danger btn-sm" onclick="return window.confirm('Anda yakin akan menghapus data <?php echo $data['nama_siswa'] ?>?')"><span class="glyphicon glyphicon-trash"></span></a>
						<a href="index.php?menu=siswa&id_siswa=<?php echo $data['id_siswa'] ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
					</td>
					<?php } ?>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<div class="modal fade" id="modal_tambah">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">Tambah data</div>
					<div class="modal-body">
						<form action="tambah_data_siswa.php" method="POST" class="form">
							<div class="form-group">
								<input type="text" name="nis" class="form-control" placeholder="NIS" required="required" autofocus="autofocus">
							</div>
							<div class="form-group">
								<input type="text" name="nama_siswa" class="form-control" placeholder="Nama Siswa" required="required">
							</div>
							<div class="form-group">
								<select name="id_kelas" id="select2" class="form-control" required="required" style="width: 100%;">
									<option value="">-- Pilih Kelas --</option>
									<?php
										$query = mysql_query("SELECT * FROM kelas ORDER BY kelas.nama_kelas ASC");
										while($data = mysql_fetch_array($query)){
									?>
									<option value="<?php echo $data['id_kelas'] ?>"><?php echo $data['nama_kelas'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="radio">
								<label for="lk"><input type="radio" name="jenis_kelamin" value="Laki-laki" id="lk">Laki-laki</label>
								<label for="pr"><input type="radio" name="jenis_kelamin" value="Perempuan" id="pr">Perempuan</label>
							</div>
							<div class="form-group">
								<input type="text" name="no_hp" class="form-control" placeholder="No Hp">
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
			$id_siswa = $_GET['id_siswa'];
			$query = mysql_query("SELECT * FROM siswa WHERE id_siswa='$id_siswa'");
			$data = mysql_fetch_array($query);
			$nis = $data['nis'];
			$nama_siswa = $data['nama_siswa'];
			$id_kelas = $data['id_kelas'];
			$jenis_kelamin = $data['jenis_kelamin'];
			$no_hp = $data['no_hp'];
		?>
		<form action="edit_data_siswa.php" method="POST" class="form">
			<input type="hidden" name="id_siswa" value="<?php echo $data['id_siswa'] ?>">
			<div class="form-group">
				<input type="text" name="nis" class="form-control" placeholder="NIS" required="required" value="<?php echo $nis ?>" autofocus="autofocus">
			</div>
			<div class="form-group">
				<input type="text" name="nama_siswa" class="form-control" placeholder="Nama Siswa" required="required" value="<?php echo $nama_siswa ?>">
			</div>
			<div class="form-group">
				<select name="id_kelas" id="select2" class="form-control" required="required" style="width: 100%;">
					<option value="">-- Pilih Kelas --</option>
					<?php
						$query = mysql_query("SELECT * FROM kelas ORDER BY kelas.nama_kelas ASC");
						while($data = mysql_fetch_array($query)){
					?>
					<option value="<?php echo $data['id_kelas'] ?>" <?php echo ($id_kelas==$data['id_kelas']?"selected":"") ?>><?php echo $data['nama_kelas'] ?></option>
					<?php } ?>
				</select>
			</div>
			<?php echo $data['jenis_kelamin'] ?>
			<div class="radio">
				<label for="lk"><input type="radio" name="jenis_kelamin" value="Laki-laki" id="lk" <?php echo ($jenis_kelamin=="L"?"checked":"") ?>>Laki-laki</label>
				<label for="pr"><input type="radio" name="jenis_kelamin" value="Perempuan" id="pr" <?php echo ($jenis_kelamin=="P"?"checked":"") ?>>Perempuan</label>
			</div>
			<div class="form-group">
				<input type="text" name="no_hp" class="form-control" placeholder="No Hp" value="<?php echo $no_hp ?>">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-success" value="Simpan">
				<input type="button" name="batal" class="btn btn-default" value="Batal" onclick="document.location='index.php?menu=siswa'">
			</div>
		</form>
		<?php } ?>
		<?php } ?>
	</div>
</div>