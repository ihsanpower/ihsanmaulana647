<?php
session_start();
include "./controller/conn.php";
$id_siswa = $_SESSION['idSiswa'];
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
    <style>
        .information-content {
            display: flex;
            flex-direction: column;
        }

        .information-content p {
            display: flex;
            align-items: center;
            font-weight: 600;
        }

        .information-content p span {
            margin-left: 5px;
            /* Atur jarak antara tanda titik dua dan teks */
        }

        .line {
            width: 100%;
            height: 1px;
            background: #000;
        }

        .saran {
            border: 1px solid #000;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .keputusan{
            border: 1px solid #000;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .keputusan h4{
            font-weight: bold;
        }
        .mengetahui{
            margin-bottom: 50px;
        }
        .paraf {
            text-align: center;
        }
    </style>
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
        <?php include './include/navHeader.php' ?>
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
                    <h2 class="text-center fw-bolder" style="text-align: center">RAPOR PESERTA DIDIK DAN PROFIL PESERTA DIDIK</h2>
                </div>

                <div class="row">
                    <div class="col-lg-12">


                        <div class="card">

                            <!-- <div class="card-header" style="align-items: center;">
                                <h2 class="text-center" style="text-align: center">Nilai Raport Semester Ganjil 2023</h2>
                            </div> -->
                            <?php
                            $cekNilaiRaport = mysqli_query($conn, "SELECT * FROM raport WHERE idSiswa = '$id_siswa'");
                            $r = mysqli_fetch_array($cekNilaiRaport);
                            
                            if (!empty($r)) {
                            ?>
                             <div class="card-body">
                                <div class="information">
                                    <?php
                                    $getInfoSiswa = mysqli_query($conn, "SELECT user.nama AS nama, user.nis AS nis, user.nisn AS nisn,kelas.kelas AS kelas FROM user INNER JOIN kelas ON kelas.id = user.kelas WHERE user.id ='$id_siswa'");
                                    while ($dataSiswa = mysqli_fetch_array($getInfoSiswa)) {
                                    ?>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="information-content">
                                                <p>Nama : <span><?php echo $dataSiswa['nama']?></span></p>
                                                <p>Nomor Induk/NISN : <span> <?php echo $dataSiswa['nis']?>/ <?php echo $dataSiswa['nisn']?></span></p>
                                                <p>Nama Sekolah : <span> SD Leuwiliang 01</span></p>
                                                <p>Alamat Sekolah : <span> Jl.raya Leuwliang</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="information-content">
                                                <p>Kelas : <span> <?php echo $dataSiswa['kelas']?></span></p>
                                                <p>Semester : <span> 2 (Dua)</span></p>
                                                <p>Tahun Pelajaran : <span> 2022/2023</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="line mb-4"></div>
                                </div>
                                <h2 class="fw-bolder" style="font-size: 18px;">A.SIKAP</h2>
                                <?php
                                $getDataSikap = mysqli_query($conn, "SELECT * FROM raport WHERE idSiswa = '$id_siswa' GROUP BY raport.idSiswa ");
                                while ($dataSikap = mysqli_fetch_array($getDataSikap)) {
                                
                                ?>
                                <div class="row mb-4">
                                    <div class="table-responsive">
                                        <table id="example3" class="table table-sm table-bordered" style="min-width: 845px; border: 1px solid #000;">
                                            <tr style="background-color: #E4E9FF; border: 1px solid #000;">
                                                <th colspan="3" style="text-align: center;border: 1px solid #000; font-weight:bolder;" class="fw-bolder">Deskripsi</th>
                                            </tr>
                                            <tr>
                                                <td class="fw-bolder" style="width:150px; border: 1px solid #000;">1. Sikap Spritual</td>
                                                <td style="border: 1px solid #000;"><?php echo $dataSikap['sikap_spritual']?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bolder" style="width:150px; border: 1px solid #000;">2. Sikap Sosial</td>
                                                <td style="border: 1px solid #000;"><?php echo $dataSikap['sikap_sosial']?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                               
                                <div class="row mb-4">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <tr style="background-color: #E4E9FF; border: 1px solid #000;">
                                                <th class="bold no" rowspan="2" style="border: 1px solid #000;">NO</th>
                                                <th rowspan="2" class="bold" class="mapel bold" style="border: 1px solid #000;">Mata Pelajaran</th>
                                                <th class="bold" colspan="3" style="text-align:center;border: 1px solid #000;">Pengetahuan</th>
                                                <th class="bold" colspan="3" style="text-align:center;border: 1px solid #000;">Keterampilan</th>
                                            </tr>
                                            <tr style="background-color: #E4E9FF; border: 1px solid #000;">
                                                <th style="border: 1px solid #000;" class="bold" class="angka">Angka</th>
                                                <th style="border: 1px solid #000;" class="bold" class="predikat">Predikat</th>
                                                <th style="border: 1px solid #000; text-align:center;" class="bold" class="deskripsi">Deskripsi</th>
                                                <th style="border: 1px solid #000;" class="bold" class="angka">Angka</th>
                                                <th style="border: 1px solid #000;" class="bold" class="predikat">Predikat</th>
                                                <th style="border: 1px solid #000; text-align:center;" class="bold" class="deskripsi">Deskripsi</th>
                                            </tr>
                                            <?php }?>
                                <h2 class="fw-bolder" style="font-size: 18px;">B. PENGETAHUAN DAN KETERAMPILAN</h2>
                                <h3 class="fw-bolder" style="font-size: 18px;">Kriteria Ketuntasan Minimal Satuan Pendidikan= 70</h3>
                                <?php
                                $getDataNilai = mysqli_query($conn, "SELECT * FROM raport INNER JOIN mapel ON mapel.id = raport.mapel WHERE raport.idSiswa ='$id_siswa'");
                                $i = 1;
                                while ($dataNilai = mysqli_fetch_array($getDataNilai)) {
                                   
                                ?>
                                            <tr>
                                                <td style="border: 1px solid #000;"><?php echo $i;?></td>
                                                <td style="border: 1px solid #000;"><?php echo $dataNilai['mapel']?></td>
                                                <td style="border: 1px solid #000;"><?php echo $dataNilai['nilai_pelajaran']?></td>
                                                <td style="border: 1px solid #000;"><?php if ($dataNilai['nilai_pelajaran'] >= 90) {
                                                    echo 'A';
                                                }elseif($dataNilai['nilai_pelajaran'] >= 80){
                                                    echo 'B';
                                                }elseif($dataNilai['nilai_pelajaran'] >= 70){
                                                    echo 'C';
                                                }else{
                                                    echo 'D';
                                                }
                                                ?></td>
                                                <td style="border: 1px solid #000;"><?php echo $dataNilai['deskripsi_nilai_pelajaran']?></td>
                                                <td style="border: 1px solid #000;"><?php echo $dataNilai['nilai_keterampilan']?></td>
                                                <td style="border: 1px solid #000;"><?php if ($dataNilai['nilai_keterampilan'] >= 90) {
                                                    echo 'A';
                                                }elseif($dataNilai['nilai_keterampilan'] >= 80){
                                                    echo 'B';
                                                }elseif($dataNilai['nilai_keterampilan'] >= 70){
                                                    echo 'C';
                                                }else{
                                                    echo 'D';
                                                }
                                                ?></td>
                                                <td style="border: 1px solid #000;"><?php echo $dataNilai['deskripsi_nilai_keterampilan']?></td>
                                            </tr>
                                            <?php $i++?>
                                <?php }?>
                                        </table>
                                    </div>
                                </div>
                               
                                <h2 class="fw-bolder" style="font-size: 18px;">C. EKSTRAKURIKULER</h2>
                                <div class="row mb-4">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered" style="min-width: 845px; border: 1px solid #000;">
                                            <tr style="background-color: #E4E9FF; border: 1px solid #000;">
                                                <th style="border: 1px solid #000; width:80px; text-align:center;">NO</th>
                                                <th style="border: 1px solid #000 ;width:280px; text-align:center;">Kegiatan Ekstrakulikuler</th>
                                                <th style="border: 1px solid #000; text-align:center;">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000;">1</td>
                                                <td style="border: 1px solid #000;"></td>
                                                <td style="border: 1px solid #000;"></td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000;">2</td>
                                                <td style="border: 1px solid #000;"></td>
                                                <td style="border: 1px solid #000;"></td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000;">3</td>
                                                <td style="border: 1px solid #000;"></td>
                                                <td style="border: 1px solid #000;"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <h2 class="fw-bolder" style="font-size: 18px;">D. SARAN-SARAN</h2>
                                <div class="row mb-4">
                                    <div class="saran">
                                        <?php
                                        $getSaran = mysqli_query($conn, "SELECT * FROM raport WHERE idSiswa = '$id_siswa' GROUP BY idSiswa");
                                        while ($dataSaran = mysqli_fetch_array($getSaran)) {
                                            
                                        ?>
                                        <p><?php echo $dataSaran['saran']?></p>
                                        <?php }?>
                                    </div>
                                </div>
                                <h2 class="fw-bolder" style="font-size: 18px;">E. TINGGI DAN BERAT BADAN</h2>
                                <div class="row mb-4">
                                    <div class="table-responsive">
                                        <table id="example3" class="table table-sm table-bordered" style="min-width: 845px; border: 1px solid #000;">
                                            <tr style="background-color: #E4E9FF; border: 1px solid #000;">
                                                <th rowspan="2" class="bold no" style="border:1px solid #000;">NO</th>
                                                <th rowspan="2" style="text-align: center; border: 1px solid #000;" class="bold aspek">Aspek Yang Dinilai</th>
                                                <th style="text-align: center;border: 1px solid #000;" class="bold semester" colspan="2">Semester</th>
                                            </tr>
                                            <tr style="background-color: #E4E9FF; border: 1px solid #000;">
                                                <th style="border: 1px solid #000;">semester 1</th>
                                                <th colspan="" style="border: 1px solid #000;">semester 2</th>
                                            </tr>
                                            <?php
                                            $getDataTb = mysqli_query($conn, "SELECT * FROM raport WHERE idSiswa = '$id_siswa' GROUP BY idSiswa");
                                            while ($dataTb = mysqli_fetch_array($getDataTb)) {
                                            ?>
                                            <tr>
                                                <td style="border: 1px solid #000;">1</td>
                                                <td style="border: 1px solid #000;">Tinggi Badan</td>
                                                <td style="border: 1px solid #000;"><?php echo $dataTb['tbs1']?></td>
                                                <td style="border: 1px solid #000;"><?php echo $dataTb['tbs2']?></td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000;">2</td>
                                                <td style="border: 1px solid #000;">Berat Badan</td>
                                                <td style="border: 1px solid #000;"><?php echo $dataTb['bbs1']?></td>
                                                <td style="border: 1px solid #000;"><?php echo $dataTb['bbs2']?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                        </table>
                                    </div>
                                </div>
                                <h2 class="fw-bolder" style="font-size: 18px;">F. KONDISI KESEHATAN</h2>
                                <div class="row mb-4">
                                    <div class="table-responsive">
                                        <table id="example3" class="table table-sm table-bordered" style="min-width: 845px; border: 1px solid #000;">
                                            <tr style="background-color: #E4E9FF; border: 1px solid #000;">
                                                <th colspan="1" style="border: 1px solid #000;">NO</th>
                                                <th style="text-align: center;border: 1px solid #000;" >Aspek Yang Dinilai </th>
                                                <th style="text-align: center;border: 1px solid #000;" >Keterangan</th>
                                            </tr>
                                            <tr>
                                                <td class="bold" style="border: 1px solid #000;">1</td>
                                                <td style="border: 1px solid #000;">Pendengeran</td>
                                                <td style="border: 1px solid #000;">BAIK</td>
                                            </tr>
                                            <tr>
                                                <td class="bold" style="border: 1px solid #000;">2</td>
                                                <td style="border: 1px solid #000;">Penglihatan</td>
                                                <td style="border: 1px solid #000;">BAIK</td>
                                            </tr>
                                            <tr>
                                                <td class="bold" style="border: 1px solid #000;">3</td>
                                                <td style="border: 1px solid #000;">Gigi</td>
                                                <td style="border: 1px solid #000;">BAIK</td>
                                            </tr>
                                            <tr>
                                                <td class="bold" style="border: 1px solid #000;">4</td>
                                                <td style="border: 1px solid #000;">Lainya</td>
                                                <td style="border: 1px solid #000;"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <h2 class="fw-bolder" style="font-size: 18px;">G. PRESTASI</h2>
                                <div class="row mb-4">
                                <div class="table-responsive">
                                        <table id="example3" class="table table-sm table-bordered" style="min-width: 845px; border: 1px solid #000;">
                                            <tr style="background-color: #E4E9FF; border: 1px solid #000;">
                                                <th colspan="1" style="border: 1px solid #000;">NO</th>
                                                <th style="text-align: center;border: 1px solid #000;" >Jenis Prestasi</th>
                                                <th style="text-align: center;border: 1px solid #000;" >Keterangan</th>
                                            </tr>
                                            <tr>
                                                <td class="bold" style="border: 1px solid #000;">1</td>
                                                <td style="border: 1px solid #000;"></td>
                                                <td style="border: 1px solid #000;"></td>
                                            </tr>
                                            <tr>
                                                <td class="bold" style="border: 1px solid #000;">2</td>
                                                <td style="border: 1px solid #000;"></td>
                                                <td style="border: 1px solid #000;"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <h2 class="fw-bolder" style="font-size: 18px;">H. KETIDAKHADIRAN</h2>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="paraf">
                                        <table style="border: 1px solid #000;" class="table">
                                        <?php
                                        $getDataHadir = mysqli_query($conn, "SELECT * FROM raport WHERE idSiswa = '$id_siswa' GROUP BY idSiswa");
                                        while ($dataHadir = mysqli_fetch_array($getDataHadir)) {
                                            
                                        ?>
                                            <tr>
                                                <td style=" border-bottom: 1px solid black;">Sakit</td>
                                                <td style=" border-bottom: 1px solid black;">:</td>
                                                <td style=" border-bottom: 1px solid black;"><?php echo $dataHadir['sakit']?></td>
                                                <td style=" border-bottom: 1px solid black;">Hari</td>
                                            </tr>
                                            <tr>
                                                <td style=" border-bottom: 1px solid black;">Izin</td>
                                                <td style=" border-bottom: 1px solid black;">:</td>
                                                <td style=" border-bottom: 1px solid black;"><?php echo $dataHadir['izin']?></td>
                                                <td style=" border-bottom: 1px solid black;">Hari</td>
                                            </tr>
                                            <tr>
                                                <td style=" border-bottom: 1px solid black;">Tanpa Keterangan</td>
                                                <td style=" border-bottom: 1px solid black;">:</td>
                                                <td style=" border-bottom: 1px solid black;"><?php echo $dataHadir['alfa']?></td>
                                                <td style=" border-bottom: 1px solid black;">Hari</td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="keputusan">
                                            <h4>Keputusan :</h4>
                                            <p>Berdasarkan pencapaian seluruh kompetensi,peserta didik dinyatakan:</p>
                                            <h4>NAIK KE KELAS : IV ( EMPAT )</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="paraf">
                                        <p class="mengetahui">Mengetahui,<br/> Orang Tua/Wali,</p>
                                        <p>.................</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="paraf">
                                        <p class="mengetahui">Leuwisadeng, 24 Juni 2023<br/>Wali Kelas,</p>
                                        <p>.................</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <p style="text-align: center; margin-bottom:50px;">Mengetahui,<br/>Kepala Sekolah</p>
                                        <p style="text-align: center;">..............</p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                <div style="display: flex; align-items:center;">
                                                    <a href="./printRaport.php?id_siswa=<?php echo $r['idSiswa']?>" target="_blank" class="btn btn-primary">Unduh Raport </a>
                                                </div>
                                </div>
                            </div>
                            
                             <?php } else{
                                    echo "<div class='card-body'><h1 style='text-align : center; color:red;'>Belum Ada Nilai</h1></div>";
                                }?>
                           
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