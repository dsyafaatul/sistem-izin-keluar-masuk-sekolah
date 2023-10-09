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
<?php if(!empty($_GET['range'])){ ?>
<h2 class="page-header visible-print" style="position: relative;">
<table border="0" width="100%">
  <img src="img/favicon.png" alt="" style="width: 70px;height: 70px;position: absolute;left: 30px;top: 15px;">
  <tr>
      <td align="center" style="width: 100%;padding: 5px;font-size: 20pt;font-weight: bold;">
      SMK PUI Majalengka
      </td>
  </tr>
  <tr>
    <td align="center" style="padding: 5px;font-size: 11pt;">
      Jalan Suma No.478 Majalengka 45419 Telp. /Fax (0233) 281027
    </td>
  </tr>
  <tr style="border-bottom: 1px solid black;">
    <td align="center" style="padding: 5px;font-size: 11pt;">
      www.smkpui-majalengka.sch.id email: smkpuimjlk@yahoo.com
    </td>
  </tr>
  <tr>
    <td align="center" style="padding-top: 15px;font-size: 11pt;font-weight: bold;">IZIN KELUAR MASUK SISWA</td>
  </tr>
  <tr>
    <td align="center" style="font-size: 11pt;">TANGGAL 
      <?php
      if(!empty($_GET['range'])){
      	$extgl = explode("-", $_GET['range']);
      	if(trim($extgl[0])==trim($extgl[1])){
      		echo $extgl[0];
      	}else{
        	echo $_GET['range'];
      	}
      }else{  
        echo strtoupper(date("d/m/Y"));
      }
      ?>
    </td>
  </tr>
</table>
</h2>
<style type="text/css">
	.printo{
		border-collapse: collapse;
	}
	.printo td,th{
		font-size: 12px;
		padding: 5px;
	}
</style>
<table class="visible-print printo" border="1" align="center">
	<thead>
		<tr>
			<th width="10" align="center">No</th>
			<th>NIS</th>
			<th>Nama Siswa</th>
			<th>Tanggal</th>
			<th>Jam Keluar</th>
			<th>Jam Kembali</th>
			<th>Keterangan</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		$range = explode("-", $_GET['range']);
		$start = date("Y/m/d",strtotime($range[0]));
		$end = date("Y/m/d",strtotime($range[1]));
		$query = mysql_query("SELECT * FROM izin INNER JOIN kode ON kode.id_kode=izin.id_kode INNER JOIN siswa ON siswa.nis=izin.nis WHERE tanggal BETWEEN '$start' AND '$end' order by tanggal asc, waktu_keluar asc");
		$jumlah = mysql_num_rows(mysql_query("SELECT * FROM izin INNER JOIN kode ON kode.id_kode=izin.id_kode INNER JOIN siswa ON siswa.nis=izin.nis WHERE tanggal BETWEEN '$start' AND '$end'"));
		while($data = mysql_fetch_array($query)){
		?>
		<tr>
			<td align="center"><?php echo $no++; ?></td>
			<td><?php echo $data['nis']; ?></td>
			<td><?php echo $data['nama_siswa']; ?></td>
			<td><?php echo $data['tanggal']; ?></td>
			<td width="85" align="center"><?php echo $data['waktu_keluar']; ?></td>
			<td width="86" align="center"><?php echo $data['waktu_masuk']; ?></td>
			<td><?php echo ($data['keterangan']==""?"-":$data['keterangan']); ?></td>
			<td><?php echo ($data['status']=="Y"?"Sudah Kembali":"Belum Kembali"); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<table border="0" class="visible-print" style="margin-left: 50px;margin-top: 10px;">
	<tr>
		<td>Jumlah Siswa</td>
		<td>:</td>
		<td><?php echo $jumlah; ?></td>
	</tr>
</table>
<?php } ?>
<div class="panel panel-default hidden-print">
	<div class="panel-heading">
		Laporan
		<span class="pull-right" id="date"></span>
	</div>
	<div class="panel-body">
		<form action="index.php" method="GET" class="form">
			<input type="hidden" name="menu" value="laporan">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
					<input type="text" class="form-control input-md" name="range" id="daterangepicker" autofocus="autofocus" value="<?php echo (!empty($_GET['range'])?$_GET['range']:date("Y/m/d")."-".date("Y/m/d")) ?>">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span></button>
						<?php if(!empty($_GET['range'])){ ?>
						<button type="button" class="btn btn-default" onclick="window.print()"><span class="glyphicon glyphicon-print"></span></button>
						<?php } ?>
					</span>
				</div>
			</div>
		</form>
		<?php if(!empty($_GET['range'])){ ?>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th width="10">No</th>
						<th>NIS</th>
						<th>Nama Siswa</th>
						<th>Tanggal</th>
						<th>Jam Keluar</th>
						<th>Jam Kembali</th>
						<th>Durasi</th>
						<th>Keterangan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$range = explode("-", $_GET['range']);
					$start = date("Y/m/d",strtotime($range[0]));
					$end = date("Y/m/d",strtotime($range[1]));
					$query = mysql_query("SELECT * FROM izin INNER JOIN kode ON kode.id_kode=izin.id_kode INNER JOIN siswa ON siswa.nis=izin.nis WHERE tanggal BETWEEN '$start' AND '$end' order by tanggal asc, waktu_keluar asc");
					$jumlah = mysql_num_rows(mysql_query("SELECT * FROM izin INNER JOIN kode ON kode.id_kode=izin.id_kode INNER JOIN siswa ON siswa.nis=izin.nis WHERE tanggal BETWEEN '$start' AND '$end'"));
					while($data = mysql_fetch_array($query)){
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['nis']; ?></td>
						<td><?php echo $data['nama_siswa']; ?></td>
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
								$selisih = ($durasi->h==0?"":$durasi->h." jam yang lalu");
							}else{
								if($durasi->i!=0){
									$selisih = ($durasi->i==0?"":$durasi->i." menit yang lalu");
								}else{
									$selisih = ($durasi->s==0?"":$durasi->s." detik yang lalu");
								}
							}
						?>
						<td><?php echo $selisih ?></td>
						<td><?php echo ($data['keterangan']==""?"-":$data['keterangan']); ?></td>
						<td><?php echo ($data['status']=="Y"?"Sudah Kembali":"Belum Kembali"); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<table border="0">
				<tr>
					<td>Jumlah Siswa</td>
					<td>:</td>
					<td><?php echo $jumlah; ?></td>
				</tr>
			</table>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>