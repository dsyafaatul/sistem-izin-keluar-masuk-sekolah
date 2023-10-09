<div class="panel panel-default">
	<div class="panel-heading">
		Izin keluar masuk sekolah
		<div class="pull-right">
			<span id="date"></span>
		</div>
	</div>
	<div class="panel-body">
		<ul class="nav nav-pills">
			<li class="active"><a href="" data-toggle="tab" data-target="#izin_keluar">Izin Keluar</a></li>
			<li><a href="" data-toggle="tab" data-target="#izin_masuk">Izin masuk</a></li>
		</ul>
		<div class="tab-content" style="margin-top: 20px">
		<div class="tab-pane active" id="izin_keluar">
		<?php if(empty($_GET['nis'])){ ?>
		<div class="form-group" id="add" style="display: none;">
		<div class="input-group">
		<select name="nis[]" class="form-control select2" required="required" style="width: 100%">
				<option value="">-- Pilih Siswa --</option>
				<?php
					$query = mysql_query("SELECT * FROM siswa INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas ORDER BY siswa.id_kelas ASC");
					while($data = mysql_fetch_array($query)){
				?>
				<option value="<?php echo $data['nis'] ?>"><?php echo $data['nis']." - ".$data['nama_siswa']." - ".$data['nama_kelas'] ?></option>
				<?php } ?>
		</select>
		<div class="input-group-btn">
			<button type="button" class="btn btn-danger hapus" ><span class="glyphicon glyphicon-minus"></span></button>
		</div>
		</div>
	</div>
		<form action="index.php" method="GET" class="form">
			<div id="list">
				<div class="form-group">
					<div class="input-group">
					<select name="nis[]" class="form-control select2" required="required" style="width: 100%">
							<option value="">-- Pilih Siswa --</option>
							<?php
								$query = mysql_query("SELECT * FROM siswa INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas ORDER BY siswa.id_kelas ASC");
								while($data = mysql_fetch_array($query)){
							?>
							<option value="<?php echo $data['nis'] ?>"><?php echo $data['nis']." - ".$data['nama_siswa']." - ".$data['nama_kelas'] ?></option>
							<?php } ?>
					</select>
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary" id="tambah"><span class="glyphicon glyphicon-plus"></span></button>
					</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success center-block" >Lanjut</button>
			</div>
			<span>1/3</span>
		</form>
		<?php }else if(!empty($_GET['nis'])&&isset($_GET['keterangan'])){ ?>
		<form action="tambah_data_izin.php" method="POST" class="form">
			<input type="hidden" name="nis" value="<?php echo $_GET['nis'] ?>">
			<input type="hidden" name="keterangan" value="<?php echo $_GET['keterangan'] ?>">
			<div class="form-group">
				<input type="text" name="kode"  class="form-control" placeholder="Kode" required="required" autofocus="autofocus">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-success center-block" value="Tambah">
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-default center-block" onclick="document.location='index.php'">Batal</button>
			</div>
			<span>3/3</span>
		</form>
		<?php }else if(!empty($_GET['nis'])){ ?>
		<form action="index.php" method="GET" class="form">
			<?php
				$nis = $_GET['nis'];
				$nis_ = implode(",", $nis);
				foreach ($nis as $key => $value) {
					$query = mysql_query("SELECT * FROM siswa INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE nis='$value'");
					$data = mysql_fetch_array($query);
					?>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" name="nama_siswa" value="<?php echo $data['nama_siswa'] ?>" disabled="disabled">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" name="kelas" value="<?php echo $data['nama_kelas'] ?>" disabled="disabled">
						</div>
					</div>
					<?php
				}
				?>
			<input type="hidden" name="nis" value="<?php echo $nis_ ?>">
			<div class="col-md-12">
				<div class="form-group">
					<textarea name="keterangan" id="" cols="30" rows="5" class="form-control" placeholder="Keterangan" style="resize: none" autofocus="autofocus"></textarea>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success center-block" >Lanjut</button>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-default center-block" onclick="document.location='index.php'">Batal</button>
			</div>
			<span>2/3</span>
		</form>
		<?php } ?>
		</div>
		<div class="tab-pane" id="izin_masuk">
			<form action="edit_data_izin.php" method="POST" class="form">
				<div class="form-group">
					<div class="input-group">
						<input type="text" name="kode" class="form-control" placeholder="Kode" required="required" autofocus="autofocus">
						<span class="input-group-btn">
							<button type="submit" name="submit" class="btn btn-primary">Proses</button>
						</span>
					</div>
				</div>
			</form>
		</div>
	</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Daftar siswa yang izin keluar lingkungan sekolah hari ini
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-hover" id="dataTable-min" width="100%">
				<thead>
					<tr>
						<th width="10">No</th>
						<th>Nama Siswa</th>
						<th>Bersama siswa</th>
						<th>Kelas</th>
						<th>No HP</th>
						<th>Jam Keluar</th>
						<th>Jam kembali</th>
						<th>Durasi</th>
						<th>Keterangan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$query = mysql_query("SELECT * FROM izin INNER JOIN kode ON kode.id_kode=izin.id_kode INNER JOIN siswa ON siswa.nis=izin.nis INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE tanggal=CURRENT_DATE() ORDER BY waktu_keluar");
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
						<td><?php echo $data['nama_siswa']; ?></td>
						<td><?php echo $nama2; ?></td>
						<td><?php echo $data['nama_kelas']; ?></td>
						<td><?php echo $data['no_hp']; ?></td>
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
						<td><?php echo ($data['status']=="Y"?"Sudah kembali":"Belum kembali"); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
	$chart = true;
	if(!empty($_GET['range'])){
		$range = explode("-", $_GET['range']);
		$start = date("Y/m/d",strtotime($range[0]));
		$end = date("Y/m/d",strtotime($range[1]));
	}else{
		$start = date("Y/m/d");
		$end = date("Y/m/d");
	}
    $data_izin_perbulan_query = mysql_query("SELECT kelas.nama_kelas,COUNT(*) as jumlah FROM izin INNER JOIN siswa ON siswa.nis=izin.nis INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE izin.tanggal BETWEEN '$start' AND '$end' GROUP BY nama_kelas");
    $data = "[";
    while($data_izin_perbulan = mysql_fetch_array($data_izin_perbulan_query)){
      $data .= "{Kelas: '".$data_izin_perbulan['nama_kelas']."', jumlah:".$data_izin_perbulan['jumlah']."},
      ";
    }
    $data .= "]";
?>