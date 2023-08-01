<?php
session_start();
include './controller/conn.php';
$kelas= $_SESSION['kelas'];
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
    <!-- Datatable -->
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Page</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Siswa</a></li>
					</ol>
				</div>

				<div class="row">
                <div class="col-12">
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
                            <strong>Error!</strong> '. $_SESSION['status-fail'] .'
                        </div>';
                            unset($_SESSION['status-fail']);
                        }
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Raport Siswa <?php echo $kelas?></h4>   
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>NIS</th>
                                                <th>NISN</th>
                                                <th>Status Raport</th>
                                                <th>Wali Murid</th>
                                                <th>No HP Wali</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ambilDataSiswa = mysqli_query($conn, "SELECT user.id AS id_siswa, user.nama AS nama_siswa, user.email AS email_siswa, kelas.kelas AS kelas_siswa, user.no_hp AS no_hp_siswa, user.nama_wali_murid AS nama_ibu, user.nis AS nis_siswa, user.nisn AS nisn_siswa, MAX(raport.id) AS raport_siswa FROM user INNER JOIN role ON role.id = user.role INNER JOIN kelas ON kelas.id = user.kelas LEFT JOIN raport ON raport.idSiswa = user.id WHERE role.id = '4' GROUP BY user.id");
                                            $i = 1;
                                            while ($data = mysqli_fetch_array($ambilDataSiswa)) {
                                            if ($data['kelas_siswa'] == $kelas ) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $data['nama_siswa']?></td>
                                                <td><?php echo $data['nis_siswa']?></td>
                                                <td><?php echo $data['nisn_siswa']?></td>
                                                <td><?php if ($data['raport_siswa']) {
                                                    echo "<span class='badge badge-success text-white'>done</span>";
                                                } else {
                                                    echo"<span class='badge badge-warning text-white'>pending</span>";
                                                }
                                                ?></td>
                                                <td><?php echo $data['nama_ibu']?></td>
                                                <td><?php echo $data['no_hp_siswa']?></td>
                                                <td>
													<div class="d-flex">
                                                    <a href="./detailNilaiSiswa.php?id_siswa=<?php echo $data['id_siswa']?>" class="btn btn-warning me-2 shadow btn-xs sharp" data-toggle="tooltip" title="Lihat"><i class="fa fa-eye"></i></a>
														<a href="addRaport.php?id_siswa=<?php echo $data['id_siswa']?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
														
													</div>												
												</td>												
                                            </tr>
                                            <?php $i++?>
                                            <?php }?>
                                            <?php }?>
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
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
	
    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>

	<script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	<script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>



</body>

</html>