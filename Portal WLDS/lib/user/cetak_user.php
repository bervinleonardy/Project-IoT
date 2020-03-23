<?php
// memanggil library FPDF
require('../../include/fpdf/fpdf.php');
include '../../include/lib_inc.php';

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4');
// membuat halaman baru
$pdf->AddPage();

// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',11);
//logo Cimahi
$pdf->Image('../../img/cimahi.png',10,10,-680);    
$pdf->SetFont('Arial','B',10);
$pdf->Cell(200,5,'UNIT PELAKSANA TEKNIS AIR MINUM',0,1,'C');
$pdf->Cell(200,5,'DINAS PERUMAHAAN DAN KAWASAN PEMUKIMAN',0,1,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(200,5,'Jalan Raden Demang Hardjakusumah Blok Jati Cihanjuang Cimahi 40513 Jawa Barat',0,1,'C');
$pdf->Cell(200,5,'Telepon (022) 20663678 Email: uptam.cimahi@gmail.com ',0,1,'C');

//garis
$pdf->SetLineWidth(1);
$pdf->Line(10,31,200,31);
$pdf->SetLineWidth(0);
$pdf->Line(10,30,200,30);
$pdf->Cell(10,7,'',0,1);
// mencetak string 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(200,5,'LIST PENGGUNA PORTAL WLDS',0,1,'C');

$pdf->SetFont('Arial','',9);
$pdf->Cell(70,8,'Data Pengguna Portal WLDS Sistem Monitoring Kota Cimahi',0,1,'L'); // cell dengan panjang 1
$pdf->ln(0.3);
$pdf->SetFont('Arial','',9);
$pdf->Cell(10,10,'NO',1,0,'C');
$pdf->Cell(30,10,'NIP',1,0,'C');
$pdf->Cell(45,10,'NAMA',1,0,'C');
$pdf->Cell(40,10,'JABATAN',1,0,'C');
$pdf->Cell(40,10,'EMAIL',1,0,'C');
$pdf->Cell(20,10,'NO.TELP',1,0,'C');
$pdf->Ln();

$pdf->SetFont('Arial','',8);
$cari_p = mysqli_query($conn, "SELECT * FROM t_user");
$no=1;
while ($data = mysqli_fetch_array($cari_p)){
	$sqla = "SELECT * FROM t_jabatan WHERE id_jabatan='$data[id_jabatan]'";										
	$querya = mysqli_query($conn, $sqla);	
	$jabs = mysqli_fetch_array($querya);
	$pdf->Cell(10,5,$no++,1,0,'C');
	$pdf->Cell(30,5,$data['NIP'],1,0,'C');
	$pdf->Cell(45,5,$data['nama_user'],1,0,'C');
	$pdf->Cell(40,5,$jabs['nama_jabatan'],1,0,'C');
	$pdf->Cell(40,5,$data['email'],1,0,'C');
	$pdf->Cell(20,5,$data['no_telp'],1,0,'C');
	$pdf->Ln();
}
$pdf->Output('','LP/PWLDS'.'/'.date("d-m-Y").'.pdf');

?>