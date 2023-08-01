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
$getDataSiswa = mysqli_query($conn, "SELECT user.nama AS nama, user.nis AS nis,user.nisn AS nisn,kelas.kelas AS kelas FROM user INNER JOIN kelas ON kelas.id = user.kelas WHERE user.id = '$id_siswa'");
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
<h1 style="text-align:center; margin-bottom:10px;">RAPORT PESERTA DIDIK DAN PROFIL PESERTA DIDIK</h1>';
$html2 = '<p style="font-size:11px;">Nama Siswa          :     ' . $dataSiswa['nama'] . '</p>';
$html3 = '<p style="font-size:11px;">Nomor Induk/NISN    : ' . $dataSiswa['nis'] . '/' . $dataSiswa['nisn'] . '</p>';
$html4 = '<p style="font-size:11px;">Nama Sekolah   : ' . $sekolah . '</p>';
$html5 = '<p style="font-size:11px;">Alamat Sekolah : ' . $alamatSekolah . '</p>';
$html6 = '<p style="font-size:11px;">Kelas    : ' . $dataSiswa['kelas'] . '</p>';
$html7 = '<p style="font-size:11px;">Semester : 2 (Dua)</p>';
$html8 = '<p style="font-size:11px;">Tahun Ajaran : 2022/2023</p>';
$html9 = '<h2 style="font-size:14px;">A. SIKAP</h2>';
$html10 = '<style>
table {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-collapse: collapse; /* Menggabungkan garis tabel */
    width: 100%;
    padding : 5px;
    margin-bottom : 40px;
}
th{
    background-color: #E4E9FF; /* Menambahkan latar belakang biru pada header */
    color: #000; /* Mengubah warna teks menjadi putih */
    border: 1px solid black;
}
td {
    border: 1px solid black; /* Menambahkan garis pada sel */
    
    
}
td.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}
th.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}

</style>
<table>
<tr>
    <th colspan="3" style="text-align: center" class="bold">Deskripsi</th>
</tr>
<tr>
   <td class="bold">1.Sikap Spritual</td>
   <td colspan="3">Lorem ipsum dolor sit amet consectetur. Quisque nisl et laoreet sed quis turpis sem. Purus quis nisl ut elit maecenas. Risus tristique tortor id diam non aliquet nunc vestibulum. Vestibulum amet congue feugiat ut vehicula neque egestas.</td>
</tr>
<tr>
   <td class="bold">2.Sikap Sosial</td>
   <td colspan="3">Lorem ipsum dolor sit amet consectetur. Quisque nisl et laoreet sed quis turpis sem. Purus quis nisl ut elit maecenas. Risus tristique tortor id diam non aliquet nunc vestibulum. Vestibulum amet congue feugiat ut vehicula neque egestas.</td>
</tr>

</table>';
$html11 = '<h2 style="font-size:14px;">B. PENGETAHUAN DAN KETERAMPILAN </h2>';
$html12 = '<p style="font-size:12px;  font-weight: bold;">Kriteria Ketuntasan Minimal Satuan Pendidikan= 70</p>';
$html13 = '<style>
table {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-collapse: collapse; /* Menggabungkan garis tabel */
    width: 100%;
    padding : 5px;
    margin-bottom : 140px;
}
th{
    background-color: #E4E9FF; /* Menambahkan latar belakang biru pada header */
    color: #000; /* Mengubah warna teks menjadi putih */
    border: 1px solid black;
}
td {
    border: 1px solid black; /* Menambahkan garis pada sel */
    
    
}
td.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}
th.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}
th.no{
    width : 8%;
}
th.no,td.no{
    width : 6%;
}
th.mapel{
    width:19%
}
th.angka{
    width:7%;
    font-size:8px;
    font-weight:bold;
    padding : 2px;
}
th.predikat{
    width:9%;
    font-size:8px;
    font-weight:bold;
    padding : 2px;
}
th.deskripsi{
    width : 21.5%;
    font-size:8px;
    font-weight:bold;
    padding : 2px;
}
td.deskripsi{
    font-size:8px;
}
td.nilai{
    font-size:10px;
}
</style>
<table>
    <tr>
        <th class="bold no" rowspan="2">NO</th>
        <th rowspan="2" class="bold" class="mapel bold">Mata Pelajaran</th>
        <th class="bold" colspan="3" style="text-align:center;">Pengetahuan</th>
        <th class="bold" colspan="3" style="text-align:center;">Keterampilan</th>
    </tr>
    <tr>
        <th class="bold" class="angka">Angka</th>
        <th class="bold" class="predikat">Predikat</th>
        <th class="bold" class="deskripsi">Deskripsi</th>
        <th class="bold" class="angka">Angka</th>
        <th class="bold" class="predikat">Predikat</th>
        <th class="bold" class="deskripsi">Deskripsi</th>
    </tr>';
    $no = 1; // Variabel untuk menyimpan nomor urut
    while ($dataNilai = mysqli_fetch_array($ambilDataNilai)) {
        $nilaiKeterampilan = getPredikatNilai($dataNilai['nilai_keterampilan']);
        $nilaiPelajaran = getPredikatNilai($dataNilai['nilai_pelajaran']);
    
        $html13 .= '
        <tr >
            <td >'.$no.'</td>
            <td>'.$dataNilai['mapel'].'</td>
            <td class="nilai">'.$dataNilai['nilai_keterampilan'].'</td>
            <td class="nilai">'.$nilaiKeterampilan.'</td>
            <td class="deskripsi">Penguasaan pengetahuan
            sangat baik, terutama
            kompetensi Menjelaskan dan
            menentukan luas volume dlm
            satuan tidak baku</td>
            <td class="nilai">'.$dataNilai['nilai_pelajaran'].'</td>
            <td class="nilai">'.$nilaiPelajaran.'</td>
            <td class="deskripsi">Penguasaan pengetahuan
            sangat baik, terutama
            kompetensi Menjelaskan dan
            menentukan luas volume dlm
            satuan tidak baku</td>
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
   
$html13.='</table>';

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 15, 25, $html2, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 15, 31, $html3, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 15, 37, $html4, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 15, 43, $html5, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 150, 25, $html6, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 150, 31, $html7, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 150, 37, $html8, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0,0, 15, 60, $html9, 0, 0, 0, true, '', true);
$pdf->writeHTMLCell(0,0, 15, 70, $html10, 0, 0, 0, true, '', true);
$pdf->writeHTMLCell(0,0, 15, 140, $html11, 0, 0, 0, true, '', true);
$pdf->writeHTMLCell(0,0, 15, 147, $html12, 0, 0, 0, true, '', true);
$pdf->writeHTMLCell(0,0, 15, 157, $html13, 0, 0, 0, true, '', true);
// $pdf->writeHTMLCell(0,0, 15, 200, $html14, 0, 0, 0, true, '', true);
$pdf->SetLineStyle(array('width' => 0.2, 'color' => array(0, 0, 0))); // Mengatur lebar garis menjadi 0.2mm (sekitar 1 piksel)

$pdf->Line(15, 55, 200, 55); // Menggambar garis dengan koordinat x1=15, y1=55, x2=200, y2=55

$pdf->writeHTMLCell(0, 0, 15, 157, $html13, 0, 0, 0, true, '', true);

$pdf->lastPage();
$pdf->AddPage();
$html14 = '<h2 style="font-size:14px;">C. EKSTRAKULIKULER </h2>';
$html15 = '
<style>
table {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-collapse: collapse; /* Menggabungkan garis tabel */
    width: 100%;
    padding : 5px;
    margin-bottom : 40px;
}
th{
    background-color: #E4E9FF; /* Menambahkan latar belakang biru pada header */
    color: #000; /* Mengubah warna teks menjadi putih */
    border: 1px solid black;
}
td {
    border: 1px solid black; /* Menambahkan garis pada sel */
    
    
}
td.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}
th.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}

</style>
<table>
<tr>
    <th  colspan="1" class="bold no">NO</th>
    <th style="text-align: center" class="bold">Kegiatan Ektrakulikuler</th>
    <th style="text-align: center" class="bold">Keterangan</th>
</tr>
<tr>
   <td class="bold">1</td>
   <td ></td>
   <td ></td>
</tr>
<tr>
   <td class="bold">2</td>
   <td ></td>
   <td ></td>
</tr>
</table>';
$html16 = '<h2 style="font-size:14px;">D. SARAN-SARAN </h2>';
$html17 = '
<div class="saran" style="border: 1px solid #000">
    <p style="text-indent: 15px;">Penguasaan pengetahuan
    sangat baik, terutama
    kompetensi Menjelaskan dan
    menentukan luas volume dlm
    satuan tidak baku</p>
</div> ';
$html18 = '<h2 style="font-size:14px;">E. TINGGI DAN BERAT BADAN</h2>';
$html19 = '<style>
table {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-collapse: collapse; /* Menggabungkan garis tabel */
    width: 100%;
    padding : 5px;
    margin-bottom : 40px;
}
th{
    background-color: #E4E9FF; /* Menambahkan latar belakang biru pada header */
    color: #000; /* Mengubah warna teks menjadi putih */
    border: 1px solid black;
}
td {
    border: 1px solid black; /* Menambahkan garis pada sel */
    
    
}
td.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}
th.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}

</style>
<table>
<tr>
    <th rowspan="2" class="bold no">NO</th>
    <th rowspan="2" style="text-align: center" class="bold aspek">Aspek Yang Dinilai</th>
    <th style="text-align: center" class="bold semester" colspan="2">Semester</th>
</tr>
<tr>
   <th >semester 1</th>
   <th colspan="">semester 2</th>
</tr>
<tr>
    <td>1</td>
    <td>Tinggi Badan</td>
    <td>123 cm</td>
    <td>123 cm</td>
</tr>
<tr>
    <td>2</td>
    <td>Berat Badan</td>
    <td>25 kg</td>
    <td>25 kg</td>
</tr>
</table>';
$html20 = '<h2 style="font-size:14px;">F. KONDISI KESEHATAN</h2>';
$html21='<style>
table {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-collapse: collapse; /* Menggabungkan garis tabel */
    width: 100%;
    padding : 5px;
    margin-bottom : 40px;
}
th{
    background-color: #E4E9FF; /* Menambahkan latar belakang biru pada header */
    color: #000; /* Mengubah warna teks menjadi putih */
    border: 1px solid black;
}
td {
    border: 1px solid black; /* Menambahkan garis pada sel */
    
    
}
td.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}
th.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}

</style>
<table>
<tr>
    <th  colspan="1" class="bold no">NO</th>
    <th style="text-align: center" class="bold">Aspek Yang Dinilai </th>
    <th style="text-align: center" class="bold">Keterangan</th>
</tr>
<tr>
   <td class="bold">1</td>
   <td >Pendengeran</td>
   <td >BAIK</td>
</tr>
<tr>
   <td class="bold">2</td>
   <td >Penglihatan</td>
   <td >BAIK</td>
</tr>
<tr>
   <td class="bold">3</td>
   <td >Gigi</td>
   <td >BAIK</td>
</tr>
<tr>
   <td class="bold">4</td>
   <td >Lainya</td>
   <td >BAIK</td>
</tr>
</table>';
$html22='<h2 style="font-size:14px;">G. PRESTASI</h2>';
$html23='<style>
table {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-collapse: collapse; /* Menggabungkan garis tabel */
    width: 100%;
    padding : 5px;
    margin-bottom : 40px;
}
th{
    background-color: #E4E9FF; /* Menambahkan latar belakang biru pada header */
    color: #000; /* Mengubah warna teks menjadi putih */
    border: 1px solid black;
}
td {
    border: 1px solid black; /* Menambahkan garis pada sel */
    
    
}
td.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}
th.bold{
    font-weight: bold; /* Menambahkan efek teks tebal (bold) */
}

</style>
<table>
<tr>
    <th  colspan="1" class="bold no">NO</th>
    <th style="text-align: center" class="bold">Jenis Prestasi</th>
    <th style="text-align: center" class="bold">Keterangan</th>
</tr>
<tr>
   <td class="bold">1</td>
   <td ></td>
   <td ></td>
</tr>
<tr>
   <td class="bold">2</td>
   <td ></td>
   <td ></td>
</tr>
</table>';
$pdf->writeHTMLCell(0, 0, '', '', $html14, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 18, $html15, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 58, $html16, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 68, $html17, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 108, $html18, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 118, $html19, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 162, $html20, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 172, $html21, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 222, $html22, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 230, $html23, 0, 1, 0, true, '', true);
$pdf->AddPage();

$html24= '<h2 style="font-size:14px;">H. KETIDAKHADIRAN</h2>';
$html25= '
<style>
table{
    border: 1px solid #000;
    padding:5px;
    width : 50%;
}
tr{
    
}
td{
    border-bottom: 1px solid black; /* Menambahkan garis pada sel */
}
</style>
<table>
<tr>
    <td>Sakit</td>
    <td>:</td>
    <td>'.$dataSikapAbsensi['siswa_sakit'].'</td>
    <td>Hari</td>
</tr>
<tr>
    <td>Izin</td>
    <td>:</td>
    <td>'.$dataSikapAbsensi['siswa_izin'].'</td>
    <td>Hari</td>
</tr>
<tr>
    <td>Tanpa Keterangan</td>
    <td>:</td>
    <td>'.$dataSikapAbsensi['siswa_alpha'].'</td>
    <td>Hari</td>
</tr>
</table>';
$html26 = '
<style>
    table{
        border: 1px solid #000;
        padding:5px;
        width : 100%;
    }
    .keputusan {
        font-weight:bold;
    }
</style>
<table>
<tr>
    <td class="keputusan">Keputusan:</td>
</tr>
<tr>
<td >Berdasarkan pencapaian seluruh kompetensi,
peserta didik dinyatakan:</td>
</tr>
<tr>
<td class="keputusan">NAIK KE KELAS : IV ( EMPAT )</td>
</tr>
</table>';
$html27='<p>Mengetahui 
Orang Tua/Wali</p>';
$html28='................';
$html30='................';
$html29='<p>Leuwisadeng, 24 Juni 2023<br/>Wali Kelas</p>';
$html31 = 'Mengetahui
Kepala Sekolah';
$html32 = '................';
$pdf->writeHTMLCell(0, 0, '', '', $html24, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 18, $html25, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 120, 18, $html26, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 78, $html27, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 25, 98, $html28, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 125, 98, $html28, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 120, 78, $html29, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 65, 115, $html31, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, 85, 135, $html32, 0, 1, 0, true, '', true);
$pdf->Output('RaportSiswa.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
