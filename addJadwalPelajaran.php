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
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Jadwal Pelajaran <?php echo $nama_kelas ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="needs-validation" novalidate="" method="POST" action="./controller/jadwalPelajaran/add.php">
                                        <div class="row">
                                            <div class="col-lg-4 mb-3">
                                                <div class="mb-3">
                                                    <label class="text-label form-label">Jam Pelajaran</label>
                                                        <input hidden type="text" value="<?php echo $id?>" name="id_kelas">
                                                    <select class="default-select wide form-control" id="validationCustom05" name="jam_pelajaran">
                                                        <option data-display="Select">Pilih</option>
                                                        <?php
                                                        $ambilDataKelas = mysqli_query($conn, "SELECT * FROM jam_pelajaran");
                                                        while ($data = mysqli_fetch_array($ambilDataKelas)) {
                                                        ?>
                                                            <option value="<?php echo $data["id"] ?>"><?php echo $data["jam_pelajaran"] ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>

                                                </div>
                                            </div>
                                              <div class="col-md-4 mb-3">
                                              <div class="mb-3">
                                                    <label class="text-label form-label fw-bolder">Hari Senin</label>
                                                        <input hidden type="text" value="<?php echo $id?>" name="id_kelas">
                                                    <select class="default-select wide form-control" id="validationCustom05" name="senin">
                                                        <option data-display="Select">Pilih</option>
                                                        <?php
                                                        $ambilDataKelas = mysqli_query($conn, "SELECT * FROM mapel");
                                                        while ($data = mysqli_fetch_array($ambilDataKelas)) {
                                                        ?>
                                                            <option value="<?php echo $data["mapel"] ?>"><?php echo $data["mapel"] ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>

                                                </div>
                                              </div>
                                              <div class="col-md-4 mb-3">
                                              <div class="mb-3">
                                                    <label class="text-label form-label fw-bolder">Hari Selasa</label>
                                                        <input hidden type="text" value="<?php echo $id?>" name="id_kelas">
                                                    <select class="default-select wide form-control" id="validationCustom05" name="selasa">
                                                        <option data-display="Select">Pilih</option>
                                                        <?php
                                                        $ambilDataKelas = mysqli_query($conn, "SELECT * FROM mapel");
                                                        while ($data = mysqli_fetch_array($ambilDataKelas)) {
                                                        ?>
                                                            <option value="<?php echo $data["mapel"] ?>"><?php echo $data["mapel"] ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>

                                                </div>
                                              </div>
                                              <div class="col-md-4 mb-3">
                                              <div class="mb-3">
                                                    <label class="text-label form-label fw-bolder">Hari Rabu</label>
                                                        <input hidden type="text" value="<?php echo $id?>" name="id_kelas">
                                                    <select class="default-select wide form-control" id="validationCustom05" name="rabu">
                                                        <option data-display="Select">Pilih</option>
                                                        <?php
                                                        $ambilDataKelas = mysqli_query($conn, "SELECT * FROM mapel");
                                                        while ($data = mysqli_fetch_array($ambilDataKelas)) {
                                                        ?>
                                                            <option value="<?php echo $data["mapel"] ?>"><?php echo $data["mapel"] ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>

                                                </div>
                                              </div>
                                              <div class="col-md-4 mb-3">
                                              <div class="mb-3">
                                                    <label class="text-label form-label fw-bolder">Hari Kamis</label>
                                                        <input hidden type="text" value="<?php echo $id?>" name="id_kelas">
                                                    <select class="default-select wide form-control" id="validationCustom05" name="kamis">
                                                        <option data-display="Select">Pilih</option>
                                                        <?php
                                                        $ambilDataKelas = mysqli_query($conn, "SELECT * FROM mapel");
                                                        while ($data = mysqli_fetch_array($ambilDataKelas)) {
                                                        ?>
                                                            <option value="<?php echo $data["mapel"] ?>"><?php echo $data["mapel"] ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>

                                                </div>
                                              </div>
                                              <div class="col-md-4 mb-3">
                                              <div class="mb-3">
                                                    <label class="text-label form-label fw-bolder">Hari Jum'at</label>
                                                        <input hidden type="text" value="<?php echo $id?>" name="id_kelas">
                                                    <select class="default-select wide form-control" id="validationCustom05" name="jumat">
                                                        <option data-display="Select">Pilih</option>
                                                        <?php
                                                        $ambilDataKelas = mysqli_query($conn, "SELECT * FROM mapel");
                                                        while ($data = mysqli_fetch_array($ambilDataKelas)) {
                                                        ?>
                                                            <option value="<?php echo $data["mapel"] ?>"><?php echo $data["mapel"] ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>

                                                </div>
                                              </div>
                                              <div class="col-md-4 mb-3">
                                              <div class="mb-3">
                                                    <label class="text-label form-label fw-bolder">Hari Sabtu</label>
                                                        <input hidden type="text" value="<?php echo $id?>" name="id_kelas">
                                                        <input hidden type="text" value="<?php echo $nama_kelas?>" name="nama_kelas">
                                                    <select class="default-select wide form-control" id="validationCustom05" name="sabtu">
                                                        <option data-display="Select">Pilih</option>
                                                        <?php
                                                        $ambilDataKelas = mysqli_query($conn, "SELECT * FROM mapel");
                                                        while ($data = mysqli_fetch_array($ambilDataKelas)) {
                                                        ?>
                                                            <option value="<?php echo $data["mapel"] ?>"><?php echo $data["mapel"] ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>

                                                </div>
                                              </div>
                                              <div class="col-md-4">
                                                  <div class="form-check custom-checkbox mb-3 checkbox-success">
                                                      <input type="checkbox" class="form-check-input" id="customCheckBox3" name="istirahat" value="istirahat">
                                                      <label for="customCheckBox3" class="form-check-label fw-bolder">Istirahat</label>
                                                  </div>
                                              </div>                                        
                                            </div>
                                       </div>
                                        <a href="./dataJadwalPelajaran.php?id=<?php echo $id?>&nama_kelas=<?php echo $nama_kelas ?>" class="btn btn-warning text-white">Kembali</a>
                                        <button class="btn btn-primary " type="submit" style="float: right;">Save</button>
                                    </form>
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