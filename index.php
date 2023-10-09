<?php
include("admin/koneksi.php");
$chart = false;
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Selamat Datang | Sistem Izin</title>
		<meta charset="utf-8">
		<meta name="author" content="D.Syafa'atul Anbiya,Rena Senja">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="admin/css/bootstrap.min.css">
		<link rel="stylesheet" href="admin/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="admin/css/dataTables.responsive.css">
		<link rel="stylesheet" href="admin/css/daterangepicker.css">
		<link rel="stylesheet" href="admin/css/morris.css">
		<link rel="stylesheet" href="admin/css/select2.min.css">
		<link rel="stylesheet" href="admin/css/bootstrap-datepicker.min.css">
		<link rel="icon" href="favicon.png">
		<style type="text/css">
			body{
				background-image: url("admin/img/bg.jpg");
				padding-top: 70px;
			}
			.navbar-nav .active{
				border-bottom: 5px solid #337ab7;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
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
						<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Utama</a></li>
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
												<form action="admin/aksi_login.php" method="POST" class="form">
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
										<img src="admin/img/user.png" alt="" width="40px;">
									</a>
								<ul class="dropdown-menu">
									<li><a href="admin/index.php"> Dashboard</a></li>
									<li class="divider"></li>
									<li>
										<a href="admin/aksi_logout.php" onclick="return window.confirm('Anda yakin akan logout?')">Logout</a>
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
			<div class="alert alert-success hidden-print">
				<span class="glyphicon glyphicon-info-sign"></span>
				Selamat datang! di sistem izin keluar masuk sekolah
				<button class="close" data-dismiss="alert">&times;</button>
			</div>
			<?php
				include("menu.php");
			?>
		</div>
		<div style="margin-bottom: 50px;"></div>
		<script src="admin/js/jquery.js" ></script>
		<script src="admin/js/bootstrap.min.js" ></script>
		<script src="admin/js/jquery.dataTables.min.js" ></script>
		<script src="admin/js/dataTables.bootstrap.min.js" ></script>
		<script src="admin/js/dataTables.responsive.js" ></script>
		<script src="admin/js/moment.min.js" ></script>
		<script src="admin/js/daterangepicker.js" ></script>
		<script src="admin/js/raphael.min.js" ></script>
		<script src="admin/js/morris.min.js" ></script>
		<script src="admin/js/select2.min.js" ></script>
		<script src="admin/js/bootstrap-datepicker.min.js" ></script>
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
				setInterval(function(){$("#date").html(moment().locale('id').format("D MMMM YYYY | H:mm:ss"));},100);
			})
		</script>
	</body>
</html>