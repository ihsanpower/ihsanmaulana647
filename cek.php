<?php
//============================================================+
// File name   : example_051.php
// Begin       : 2009-04-16
// Last Update : 2013-05-14
//
// Description : Example 051 for TCPDF class
//               Full page background
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Full page background
 * @author Nicola Asuni
 * @since 2009-04-16
 */

// Include the main TCPDF library (search for installation path).
require_once('./tcpdf/examples/tcpdf_include.php');
include './controller/conn.php';
// menangkap data siswa
$id_siswa = $_GET['id_siswa'];
$getDataSiswa = mysqli_query($conn, "SELECT user.nama AS nama, user.nis AS nis,kelas.kelas AS kelas FROM user INNER JOIN kelas ON kelas.id = user.kelas WHERE user.id = '$id_siswa'");
$dataSiswa = mysqli_fetch_array($getDataSiswa);
$sekolah = "SDN LEUWILIANG 01";
$alamatSekolah = "JL.RAYA LEUWILIANG";

//menangkap data sikap dan absensi 
$ambilDataSikapAbsensi = mysqli_query($conn, "SELECT user.id AS id_siswa, user.nama AS nama_siswa, user.email AS email_siswa, kelas.kelas AS kelas_siswa, user.no_hp AS no_hp_siswa, user.nama_wali_murid AS nama_ibu, user.nis AS nis_siswa, user.nisn AS nisn_siswa, raport.izin AS siswa_izin,raport.alfa AS siswa_alpha,raport.sakit AS siswa_sakit,raport.kelakuan AS kelakuan_siswa,raport.kerajinan AS siswa_kerajinan,raport.kebersihan AS siswa_kebersihan, MAX(raport.id) AS raport_siswa FROM user INNER JOIN role ON role.id = user.role INNER JOIN kelas ON kelas.id = user.kelas LEFT JOIN raport ON raport.idSiswa = user.id WHERE role.id = '4' AND user.id = '$id_siswa' GROUP BY user.id");
$dataSikapAbsensi = mysqli_fetch_array($ambilDataSikapAbsensi);

// menangkap nilai siswa
$ambilDataNilai = mysqli_query($conn, "SELECT * FROM raport INNER JOIN mapel ON mapel.id = raport.mapel WHERE raport.idSiswa ='$id_siswa' ");
$dataNilai = mysqli_fetch_array($ambilDataNilai);

// mengambil Nilai Rata Rata
$ambilNilaiRataRata = mysqli_query($conn, "SELECT nilai_pelajaran FROM raport WHERE idSiswa = '$id_siswa'");
$jumlahPelajaran = mysqli_num_rows($ambilNilaiRataRata);
$nilaiJumlahPelajaran = mysqli_fetch_all($ambilNilaiRataRata, MYSQLI_ASSOC);
$jumlahNilai = array_sum(array_column($nilaiJumlahPelajaran, 'nilai_pelajaran'));
$nilaiRataRata = $jumlahNilai / $jumlahPelajaran;


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->AddPage();

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES . '';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();

$html = '<style>
    table {
        background-image: url(' . $img_file . ');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border-collapse: collapse; /* Menggabungkan garis tabel */
        width: 100%;
    }
    th, td {
        border: 1px solid black; /* Menambahkan garis pada sel */
        padding: 5px; /* Menambahkan ruang di dalam sel */
    }
    .d-flex {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .col-md-6 {
        float: left;
        width: 50%;
        background-color: blue;
        color: white;
        padding: 10px;
        box-sizing: border-box;
    }
</style>
<h1 style="text-align:center; margin-bottom:10px;">Nilai Raport Semester Ganjil 2023</h1>';
$html2 = '<p style="font-size:11px;">Nama Siswa     : ' . $dataSiswa['nama'] . '</p>';
$html3 = '<p style="font-size:11px;">Nomor Induk    : ' . $dataSiswa['nis'] . '</p>';
$html4 = '<p style="font-size:11px;">Nama Sekolah   : ' . $sekolah . '</p>';
$html5 = '<p style="font-size:11px;">Alamat Sekolah : ' . $alamatSekolah . '</p>';
$html6 = '<p style="font-size:11px;">Kelas    : ' . $dataSiswa['kelas'] . '</p>';
$html7 = '<p style="font-size:11px;">Semester : Ganjil</p>';
$html8 = '<p style="font-size:11px;">Tahun Ajaran : 2023/2024</p>';
$html9 = '<style>
    table {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border-collapse: collapse; /* Menggabungkan garis tabel */
        width: 100%;
        padding-top:10px;
    }
    th, td {
        border: 1px solid black; /* Menambahkan garis pada sel */
        padding: 5px; /* Menambahkan ruang di dalam sel */
        text-align:center;
    }
    .d-flex{
        display: flex;
        justify-content: space-between;
    }
    .col-md-6 {
        width: 50%;
    }
</style>
<table>
    <tr>
        <th colspan="3" style="text-align: center">Absensi</th>
        <th colspan="3" style="text-align: center">Sikap</th>
    </tr>
    <tr>
        <th>Izin</th>
        <th>Sakit</th>
        <th>Alpha</th>
        <th>Akhlak</th>
        <th>Kerajinan</th>
        <th>Kebersihan</th>
    </tr>
    <tr>
        <td>'.$dataSikapAbsensi['siswa_izin'].'</td>
        <td>'.$dataSikapAbsensi['siswa_sakit'].'</td>
        <td>'.$dataSikapAbsensi['siswa_alpha'].'</td>
        <td>'.$dataSikapAbsensi['kelakuan_siswa'].'</td>
        <td>'.$dataSikapAbsensi['siswa_kerajinan'].'</td>
        <td>'.$dataSikapAbsensi['siswa_kebersihan'].'</td>
    </tr>
</table>';
$html10 = '<style>
    table {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border-collapse: collapse; /* Menggabungkan garis tabel */
        width: 100%;
        padding-top:10px;
    }
    th, td {
        border: 1px solid black; /* Menambahkan garis pada sel */
        padding: 15px; /* Menambahkan ruang di dalam sel */
        text-align : center;
    }
    .d-flex{
        display: flex;
        justify-content: space-between;
    }
    .col-md-6 {
        width: 50%;
    }
</style>
<table>
    <tr style="text-align:center;">
        <th>No</th>
        <th>Nama Pelajaran</th>
        <th>Nilai Keterampilan</th>
        <th>Predikat Keterampilan</th>
        <th>Nilai</th>
        <th>Predikat Nilai</th>
    </tr>';

$no = 1; // Variabel untuk menyimpan nomor urut
while ($dataNilai = mysqli_fetch_array($ambilDataNilai)) {
    $nilaiKeterampilan = getPredikatNilai($dataNilai['nilai_keterampilan']);
    $nilaiPelajaran = getPredikatNilai($dataNilai['nilai_pelajaran']);

    $html10 .= '
    <tr >
        <td >'.$no.'</td>
        <td>'.$dataNilai['mapel'].'</td>
        <td>'.$dataNilai['nilai_keterampilan'].'</td>
        <td>'.$nilaiKeterampilan.'</td>
        <td>'.$dataNilai['nilai_pelajaran'].'</td>
        <td>'.$nilaiPelajaran.'</td>
        <td>dd </td>
    </tr>';
    $no++; // Increment nomor urut
}

function getPredikatNilai($nilai) {
    if ($nilai >= 90) {
        return 'A';
    } elseif ($nilai >= 80) {
        return 'B';
    } elseif ($nilai >= 70) {
        return 'C';
    } else {
        return 'D';
    }
}

$html10 .= '</table>';
$html11= '<p style="font-size:11px;">*Catatan Predikat : </p> ';
$html12= '<p style="font-size:11px;"> A : Sangat Baik </p> ';
$html13= '<p style="font-size:11px;"> B : cukup Baik </p> ';
$html14= '<p style="font-size:11px;"> C :  Baik </p> ';
$html15= '<p style="font-size:11px;"> D : Harus Lebih Baik </p> ';
$html16= '<p style="font-size:11px;"> *Nilai Rata-Rata : '.$nilaiRataRata.'</p> ';
$html17= '<p style="font-size:11px;"> Mengetahui :</p> ';
$html18= '<p style="font-size:11px;"> (Orang Tua / Wali) :</p> ';
$html19= '<p style="font-size:11px;">  ...................</p> ';
$html20= '<p style="font-size:11px;"> Mengetahui :</p> ';
$html21= '<p style="font-size:11px;"> (Wali Kelas) :</p> ';
$html22= '<p style="font-size:11px;">  ...................</p> ';

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 15, 25, $html2, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 15, 32, $html3, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 15, 39, $html4, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 15, 46, $html5, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 130, 25, $html6, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 130, 32, $html7, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 130, 39, $html8, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 59, $html9, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 89, $html10, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 196, $html11, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 202, $html12, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 208, $html13, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 214, $html14, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 220, $html15, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 190, $html16, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 236, $html17, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 241, $html18, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 10, 265, $html19, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 130, 236, $html20, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 130, 241, $html21, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 130, 265, $html22, 0, 1, 0, true, '', true);
$pdf->Output('RaportSiswa.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
