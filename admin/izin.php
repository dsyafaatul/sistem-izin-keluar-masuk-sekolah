<?php
if(!$koneksi){
	header("Location: index.php");
}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		Data Izin
		<span class="pull-right" id="date"></span>
	</div>
	<div class="panel-body">
		<?php if($_SESSION['level']=="admin"){ ?>
		<form action="index.php" method="GET" class="form">
			<input type="hidden" name="menu" value="izin">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
					<input type="text" class="form-control input-md" name="date" id="datepicker" value="<?php echo (!empty($_GET['date'])?$_GET['date']:date("m/d/Y")) ?>">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span></button>
					</span>
				</div>
			</div>
		</form>
		<?php } ?>
		<table class="table table-bordered table-striped table-hover" id="dataTable" width="100%">
			<thead>
				<tr>
					<th width="10">No</th>
					<th>NIS</th>
					<th>Nama Siswa</th>
					<th>Bersama Siswa</th>
					<th>Kelas</th>
					<th>No HP</th>
					<th>Tanggal</th>
					<th>Jam Keluar</th>
					<th>Jam Masuk</th>
					<th>Durasi</th>
					<th>Keterangan</th>
					<th>Status</th>
					<th width="50">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				if(!empty($_GET['date'])){
					$date = date("Y-m-d",strtotime($_GET['date']));
					$query = mysql_query("SELECT * FROM izin INNER JOIN kode ON kode.id_kode=izin.id_kode INNER JOIN siswa ON siswa.nis=izin.nis INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE tanggal='$date' order by waktu_keluar");
				}else{
					$query = mysql_query("SELECT * FROM izin INNER JOIN kode ON kode.id_kode=izin.id_kode INNER JOIN siswa ON siswa.nis=izin.nis INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE tanggal=CURRENT_DATE() order by waktu_keluar");
				}
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
					<td><?php echo $data['nis']; ?></td>
					<td><?php echo $data['nama_siswa']; ?></td>
					<td><?php echo $nama2; ?></td>
					<td><?php echo $data['nama_kelas']; ?></td>
					<td><?php echo $data['no_hp']; ?></td>
					<td><?php echo $data['tanggal']; ?></td>
					<td><?php echo $data['waktu_keluar']; ?></td>
					<td><?php echo $data['waktu_masuk']; ?></td>
					<?php
							$date1 = $data['waktu_keluar'];
							$date2 = $data['waktu_masuk'];
							if($data['status']=="Y"){
								$durasi = date_diff(date_create($date1),date_create($date2));
							}else{
								$datenow = mysql_fetch_array(mysql_query("SELECT CURRENT_TIME();"));
								$durasi = date_diff(date_create($date1),date_create($datenow[0]));
							}
							$selisih="";
							if($durasi->h!=0){
								$selisih = ($durasi->h==0?"":$durasi->h." jam");
							}else{
								if($durasi->i!=0){
									$selisih = ($durasi->i==0?"":$durasi->i." menit");
								}else{
									$selisih = ($durasi->s==0?"":$durasi->s." detik");
								}
							}
						?>
						<td><?php echo $selisih ?></td>
					<td><?php echo ($data['keterangan']==""?"-":$data['keterangan']); ?></td>
					<td><?php echo ($data['status']=="Y"?"Sudah masuk":"Belum masuk"); ?></td>
					<td>
					<?php if($_SESSION['level']=="admin"){ ?>
						<a href="hapus_data_izin.php?id_izin=<?php echo $data['id_izin'] ?>" class="btn btn-danger btn-sm" onclick="return window.confirm('Anda yakin akan menghapus data izin <?php echo $data['nama_siswa'] ?>?')"><span class="glyphicon glyphicon-trash"></span></a>
					<?php } ?>
						<a href="edit_data_izin.php?id_izin=<?php echo $data['id_izin'] ?>" class="btn <?php echo ($data['status']=="Y"?"btn-danger":"btn-success") ?> btn-sm" onclick="return window.confirm('Anda yakin akan mengubah status data izin <?php echo $data['nama_siswa'] ?>?')"><span class="glyphicon glyphicon-refresh"></span></a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>