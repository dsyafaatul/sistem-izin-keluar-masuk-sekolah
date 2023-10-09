<?php
include("koneksi.php");
$chart = false;
?>
<?php if(empty($_SESSION['id_akun']) OR empty($_SESSION['id_akun'])){ ?>
	<?php header("Location: ../index.php"); ?>
<?php }else{ ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Selamat Datang | Sistem Izin</title>
		<meta charset="utf-8">
		<meta name="author" content="D.Syafa'atul Anbiya,Rena Senja">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="css/dataTables.responsive.css">
		<link rel="stylesheet" href="css/daterangepicker.css">
		<link rel="stylesheet" href="css/morris.css">
		<link rel="stylesheet" href="css/select2.min.css">
		<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
		<link rel="icon" href="../favicon.png">
		<style type="text/css">
			body{
				background-image: url("img/bg.jpg");
			}
			.navbar-nav .active{
				border-bottom: 5px solid #337ab7;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top hidden-print">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="" class="navbar-brand"><b>SISTEM</b> IZIN</a>
					<button class="navbar-toggle" data-toggle="collapse" data-target="#mycollapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="mycollapse">
					<ul class="nav navbar-nav">
						<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
						<?php if(!empty($_SESSION['id_akun'])){ ?>
						<li><a href="index.php?menu=siswa"><span class="glyphicon glyphicon-user"></span> Siswa</a></li>
						<?php } ?>
						<?php if(!empty($_SESSION['id_akun'])&&(!empty($_SESSION['level'])?($_SESSION['level']=="admin"):false)){ ?>
							<li><a href="index.php?menu=kelas"><span class="glyphicon glyphicon-tags"></span>&nbsp; Kelas</a></li>
							<li><a href="index.php?menu=akun"><span class="glyphicon glyphicon-ok-sign"></span> Akun</a></li>
							<li><a href="index.php?menu=kode"><span class="glyphicon glyphicon-barcode"></span> Kode</a></li>
						<?php } ?>
						<?php if(!empty($_SESSION['id_akun'])){ ?>
							<li><a href="index.php?menu=izin"><span class="glyphicon glyphicon-refresh"></span> Izin</a></li>
						<?php } ?>
						<?php if(!empty($_SESSION['id_akun'])&&(!empty($_SESSION['level'])?($_SESSION['level']=="admin"):false)){ ?>
							<li><a href="index.php?menu=laporan"><span class="glyphicon glyphicon-file"></span> Laporan</a></li>
						<?php } ?>
					</ul>
					<div class="navbar-right">
						<ul class="nav navbar-nav">
							<?php if(empty($_SESSION['id_akun']) OR empty($_SESSION['id_akun'])){ ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									Login <span class="caret"></span>
								</a>
								<ul class="dropdown-menu" style="min-width: 250px;padding: 14px 14px 0;margin-right: 10px;">
									<li>
										<div class="row">
											<div class="col-md-12">
												<form action="aksi_login.php" method="POST" class="form">
													<div class="form-group">
														<input type="text" placeholder="Username" class="form-control" name="username">
													</div>
													<div class="form-group">
														<input type="password" placeholder="Password" class="form-control" name="password">
													</div>
													<div class="form-group">
														<input type="submit" class="btn btn-primary btn-block" value="Login">
													</div>
												</form>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<?php }else{ ?>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin: 0px;padding:5px;">
										<?php echo strtoupper($_SESSION['username']) ?> | <!-- <span class="caret"></span> -->
										<img src="img/user.png" alt="" width="40px;">
									</a>
								<ul class="dropdown-menu">
									<li><a href="../index.php">Utama</a></li>
									<li><a href="index.php?menu=ganti_password">Ganti Password</a></li>
									<li class="divider"></li>
									<li>
										<a href="aksi_logout.php" onclick="return window.confirm('Anda yakin akan logout?')">Logout</a>
									</li>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		<nav class="navbar navbar-default navbar-fixed-bottom">
			<div class="contianer-fluid">
				<div class="navbar-head">
					<div class="navbar-text">Hak Cipta &copy; Tahun <?php echo date("Y") ?> D.Syafaatul Anbiya | Rena Senja | XII RPL Teknik Informatika</div>
				</div>
			</div>
		</nav>
		<div class="container">
			<?php
			$alert = isset($_SESSION['alert'])?$_SESSION['alert']:"";
			if(!empty($alert)){
				$alert_ = explode(",", $alert);
				if($alert_[0]==1){
					?>
					<div class="alert alert-success hidden-print" id="alert">
						<span class="glyphicon glyphicon-info-sign"></span>
						<?php echo $alert_[1] ?>
						<button class="close" data-dismiss="alert">&times;</button>
					</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger hidden-print" id="alert">
						<span class="glyphicon glyphicon-info-sign"></span>
						<?php echo $alert_[1] ?>
						<button class="close" data-dismiss="alert">&times;</button>
					</div>
					<?php
				}
				unset($_SESSION['alert']);
			}
			?>
			<div class="alert alert-success hidden-print" style="margin-top: 70px;">
				<span class="glyphicon glyphicon-info-sign"></span>
				Selamat datang! di sistem izin keluar masuk sekolah
				<button class="close" data-dismiss="alert">&times;</button>
			</div>
			<?php
				include("menu.php");
			?>
		</div>
		<div style="margin-bottom: 50px;"></div>
		<script src="js/jquery.js" ></script>
		<script src="js/bootstrap.min.js" ></script>
		<script src="js/jquery.dataTables.min.js" ></script>
		<script src="js/dataTables.bootstrap.min.js" ></script>
		<script src="js/dataTables.responsive.js" ></script>
		<script src="js/moment.min.js" ></script>
		<script src="js/daterangepicker.js" ></script>
		<script src="js/raphael.min.js" ></script>
		<script src="js/morris.min.js" ></script>
		<script src="js/select2.min.js" ></script>
		<script src="js/bootstrap-datepicker.min.js" ></script>
		<script type="text/javascript">
            $(document).ready(function(){
                var siswa = $("#add").html();
                $("#tambah").click(function(){
                    $("#list").append('<div class=\'form-group tes\'>'+siswa+'</div>');
                    console.log("berhasil");
                    $("#tambah").attr('disabled','disabled');
                    $(".select2").select2();
                })
                $("body").on("click",".hapus",function(){
                    $(this).parents(".tes").remove();
                    $("#tambah").removeAttr('disabled');
                })
            })
        </script>
		<script type="text/javascript">
			$(function(){
				<?php
			    if(!empty($_GET['menu'])){
			    ?>
			    	$(".navbar-nav [href='index.php?menu=<?php echo $_GET['menu'] ?>']").unwrap().wrap("<li class=active></li>");
			    <?php
			    }else{
			    ?>
			    	$(".navbar-nav [href='index.php']").unwrap().wrap("<li class=active></li>");
			    <?php
			    }
			    ?>
			    $('#alert').slideDown(1000).delay(3000).slideUp(1000);
				$("#daterangepicker").daterangepicker();
				$("#datepicker").datepicker();
				$(".select2").select2();
				$('#dataTable').DataTable({
					'responsive'  : true,
					'paging'      : true,
					'lengthChange': false,
					'searching'   : true,
					'ordering'    : true,
					'info'        : false,
					'autoWidth'   : true
				});
				$('#dataTable-min').DataTable({
					'responsive'  : true,
					'paging'      : true,
					'lengthChange': false,
					'searching'   : false,
					'ordering'    : true,
					'info'        : false,
					'autoWidth'   : true
				});
				<?php if($chart){ ?>
				var bar = new Morris.Bar({
		            element: 'barchart',
		            resize: true,
		            data: <?php echo $data ?>,
		            barColors: ['#00a65a'],
		            xkey: 'Kelas',
		            ykeys: ['jumlah'],
		            labels: ['Jumlah Siswa Izin'],
		            hideHover: 'auto'
		          });
				<?php } ?>
				setInterval(function(){$("#date").html(moment().locale('id').format("D MMMM YYYY | H:mm:ss"));},100);
			})
		</script>
	</body>
</html>
<?php } ?>