<?php
session_start();
include "./controller/conn.php";
$idSiswa = $_GET['id_siswa'];
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
                    <!-- <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Page</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Data Kelas</a></li>
                    </ol> -->
                    <?php
                    $judul = "Nilai Raport Semester Ganjil 2023"; 
                    ?>
                    <h2 class="text-center" style="text-align: center"><?php echo $judul?></h2>
                </div>

                <div class="row">
                    <div class="col-lg-12">


                        <div class="card">

                            <!-- <div class="card-header" style="align-items: center;">
                                <h2 class="text-center" style="text-align: center">Nilai Raport Semester Ganjil 2023</h2>
                            </div> -->

                            <div class="card-body">

                                <div class="table-responsive mb-4">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="3" style="text-align: center">Absensi</th>
                                                <th colspan="3" style="text-align: center">Sikap</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Izin</th>
                                                <th>Sakit</th>
                                                <th>Alpha</th>
                                                <th>Kelakuan</th>
                                                <th>Kerajinan</th>
                                                <th>Kebersihan</th>
                                            </tr>
                                            <?php
                                            // mengambil data absensi dan sikap
                                            $ambilDataSikapAbsensi = mysqli_query($conn, "SELECT user.id AS id_siswa, user.nama AS nama_siswa, user.email AS email_siswa, kelas.kelas AS kelas_siswa, user.no_hp AS no_hp_siswa, user.nama_wali_murid AS nama_ibu, user.nis AS nis_siswa, user.nisn AS nisn_siswa, raport.izin AS siswa_izin,raport.alfa AS siswa_alpha,raport.sakit AS siswa_sakit,raport.kelakuan AS kelakuan_siswa,raport.kerajinan AS siswa_kerajinan,raport.kebersihan AS siswa_kebersihan, MAX(raport.id) AS raport_siswa FROM user INNER JOIN role ON role.id = user.role INNER JOIN kelas ON kelas.id = user.kelas LEFT JOIN raport ON raport.idSiswa = user.id WHERE role.id = '4' AND user.id = '$idSiswa' GROUP BY user.id");
                                            while ($dataSikapAbsensi = mysqli_fetch_array($ambilDataSikapAbsensi)) {
                                            ?>
                                            <tr>
                                                <!--td style="text-align: center">40</td-->
                                                <td><?php echo $dataSikapAbsensi['siswa_izin']?></td>
                                                <td><?php echo $dataSikapAbsensi['siswa_sakit']?></td>
                                                <td><?php echo $dataSikapAbsensi['siswa_alpha']?></td>
                                                <td><?php echo $dataSikapAbsensi['kelakuan_siswa']?></td>
                                                <td><?php echo $dataSikapAbsensi['siswa_kerajinan']?></td>
                                                <td><?php echo $dataSikapAbsensi['siswa_kebersihan']?></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive mb-4">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pelajaran</th>
                                                <th>Nilai Pelajaran</th>
                                                <th>Nilai Keterampilan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // mengambil data nilai siswa
                                            $ambilDataNilai = mysqli_query($conn, "SELECT * FROM raport INNER JOIN mapel ON mapel.id = raport.mapel WHERE raport.idSiswa ='$idSiswa' ");
                                            $i= 1;
                                            while ($dataNilai = mysqli_fetch_array($ambilDataNilai)) {
                                                if (empty($judul)) {
                                                    $judul = $dataNilai['judul'];
                                                }
                                            ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $dataNilai['mapel']?></td>
                                                <td><?php echo $dataNilai['nilai_pelajaran']?></td>
                                                <td><?php echo $dataNilai['nilai_keterampilan']?></td>
                                            </tr>
                                           <?php $i++?>
                                           <?php }?>
                                            <tr class="alert-success text-white">
                                                <td colspan="3">Jumlah</td>
                                                <td>1,125</td>
                                            </tr>
                                            <tr class="bg-warning text-white">
                                                <td colspan="3">Rata-Rata</td>
                                                <td>48.91</td>
                                            </tr>
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