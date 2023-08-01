<?php
session_start();
include './controller/conn.php';
if (!isset($_SESSION['nama'])) {
	header("Location: ./auth/login.php");
	exit();
}
$id = $_GET['id'];
$nama_kelas = $_GET['nama_kelas'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
	<meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
	<meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
	<meta property="og:image" content="https:/fillow.dexignlab.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>Admin Dashboard</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
	<link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">

	<!-- Style css -->
	<link href="css/style.css" rel="stylesheet">

</head>

<body>

	<!--*******************
        Preloader start
    ********************-->
	<div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
	</div>
	<!--*******************
        Preloader end
    ********************-->

	<!--**********************************
        Main wrapper start
    ***********************************-->
	<div id="main-wrapper">

		<!--**********************************
            Nav header start
        ***********************************-->
		<?php include './include/navHeader.php'?>
		<!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Chat box start
        ***********************************-->

		<!--**********************************
            Chat box End
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
		<?php require("./include/Header.php") ?>
		<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<?php require("./include/Sidebar.php") ?>
		<!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Bootstrap</a></li>
					</ol>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<?php
						if (isset($_SESSION['status-info'])) {
							echo '
                    <div class="alert alert-success solid alert-end-icon alert-dismissible fade show">
                                    <span><i class="mdi mdi-check"></i></span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                    </button> ' . $_SESSION['status-info'] . '
                                </div>';
							unset($_SESSION['status-info']);
						}
						if (isset($_SESSION['status-fail'])) {
							echo '
                            <div class="alert alert-danger solid alert-end-icon alert-dismissible fade show">
                            <span><i class="mdi mdi-help"></i></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                            </button>
                            <strong>Error!</strong> ' . $_SESSION['status-fail'] . '
                        </div>';
							unset($_SESSION['status-fail']);
						}
						?>
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Jadwal Pelajaran <?php echo $nama_kelas ?></h4>
								<a class="btn btn-primary" href="./addJadwalPelajaran.php?id=<?php echo $id ?>&nama_kelas=<?php echo $nama_kelas ?>">Tambah</a>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-responsive-md">
										<thead>
											<tr>
												<th style="width:80px;"><strong>#</strong></th>
												<th><strong>Senin</strong></th>
												<th><strong>Selasa</strong></th>
												<th><strong>Rabu</strong></th>
												<th><strong>Kamis</strong></th>
												<th><strong>Jumat</strong></th>
												<th><strong>Sabtu</strong></th>
												<th><strong>Aksi</strong></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = mysqli_query($conn, "SELECT jadwal_pelajaran.id AS id_jadwal,jadwal_pelajaran.senin AS senin,jadwal_pelajaran.selasa AS selasa,jadwal_pelajaran.rabu AS rabu,jadwal_pelajaran.kamis AS kamis,jadwal_pelajaran.jumat AS jumat,jadwal_pelajaran.sabtu AS sabtu, kelas.id AS id_kelas,kelas.kelas AS kelas,jam_pelajaran.jam_pelajaran AS jam_pelajaran FROM jadwal_pelajaran INNER JOIN jam_pelajaran ON jam_pelajaran.id = jadwal_pelajaran.waktu INNER JOIN kelas ON kelas.id = jadwal_pelajaran.idKelas WHERE idKelas = '$id'");
											// var_dump($query);
											while ($data = mysqli_fetch_array($query)) {
											?>
												<tr>
													<td class="<?php if ($data['senin']=="istirahat") {
														echo 'bg-warning fw-bolder text-white';
													}?>"><?php echo $data['jam_pelajaran'] ?></td>
													<!-- <td><?php echo $data['kelas'] ?></td> -->
													<td class="<?php if ($data['senin']=="istirahat") {
														echo 'bg-warning fw-bolder text-white';
													}?>"><?php echo $data['senin'] ?></td>
													<td class="<?php if ($data['senin']=="istirahat") {
														echo 'bg-warning fw-bolder text-white';
													}?>"><?php echo $data['selasa'] ?></td>
													<td class="<?php if ($data['senin']=="istirahat") {
														echo 'bg-warning fw-bolder text-white';
													}?>"><?php echo $data['rabu'] ?></td>
													<td class="<?php if ($data['senin']=="istirahat") {
														echo 'bg-warning fw-bolder text-white';
													}?>"><?php echo $data['kamis'] ?></td>
													<td class="<?php if ($data['senin']=="istirahat") {
														echo 'bg-warning fw-bolder text-white';
													}?>"><?php echo $data['jumat'] ?></td>
													<td class="<?php if ($data['senin']=="istirahat") {
														echo 'bg-warning fw-bolder text-white';
													}?>"><?php echo $data['sabtu'] ?></td>
													<td>
														<div class="d-flex">
															<a href="./editJadwalPelajaran.php?id_jadwal=<?php echo $data['id_jadwal']?>&id_kelas=<?php echo $data['id_kelas']?>&nama_kelas=<?php echo $data['kelas']?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
															<a href="./controller/Jadwalpelajaran/delete.php?id_jadwal=<?php echo $data['id_jadwal']?>&id_kelas=<?php echo $data['id_kelas']?>&nama_kelas=<?php echo $data['kelas']?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
														</div>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--**********************************
            Content body end
        ***********************************-->




		<!--**********************************
            Footer start
        ***********************************-->
		<div class="footer">
			<div class="copyright">
				<p>Copyright © SDN LEUWILIANG 01 by <a href="../index.htm" target="_blank">DexignLab</a> 2021</p>
			</div>
		</div>
		<!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

		<!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
	<!--**********************************
        Main wrapper end
    ***********************************-->

	<!--**********************************
        Scripts
    ***********************************-->
	<!-- Required vendors -->
	<script src="vendor/global/global.min.js"></script>
	<script src="vendor/chart.js/Chart.bundle.min.js"></script>
	<script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>

	<script src="vendor/chart.js/Chart.bundle.min.js"></script>

	<!-- Chart piety plugin files -->
	<script src="vendor/peity/jquery.peity.min.js"></script>
	<!-- Dashboard 1 -->
	<script src="js/dashboard/dashboard-1.js"></script>

	<script src="vendor/owl-carousel/owl.carousel.js"></script>

	<script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	<script src="js/demo.js"></script>
	<script src="js/styleSwitcher.js"></script>



</body>

</html>