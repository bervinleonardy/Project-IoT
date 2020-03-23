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
$pdf->Cell(200,5,'DATA SENSOR DI PIPA RETIKULASI',0,1,'C');

$pdf->SetFont('Arial','',9);
$pdf->Cell(70,8,'Data Pipa Retikulasi Portal WLDS Sistem Monitoring Kota Cimahi',0,1,'L'); // cell dengan panjang 1
$pdf->ln(0.3);
$pdf->SetFont('Arial','',9);
$pdf->Cell(10,10,'NO',1,0,'C');
$pdf->Cell(40,10,'Debit Retikulasi Awal',1,0,'C');
$pdf->Cell(40,10,'Debit Retikulasi Akhir',1,0,'C');
$pdf->Cell(40,10,'Waktu',1,0,'C');
$pdf->Cell(40,10,'Tanggal',1,0,'C');
$pdf->Ln();

$pdf->SetFont('Arial','',8);
$cari_p = mysqli_query($conn, "SELECT * FROM t_p_retikulasi");
$no=1;
while ($data = mysqli_fetch_array($cari_p)){
	$pdf->Cell(10,5,$no++,1,0,'C');
	$pdf->Cell(40,5,$data['debit_retikulasi1'].' Liter/detik',1,0,'C');
	$pdf->Cell(40,5,$data['debit_retikulasi2'].' Liter/detik',1,0,'C');
	$pdf->Cell(40,5,$data['waktu'],1,0,'C');
	$pdf->Cell(40,5,$data['tanggal'],1,0,'C');
	$pdf->Ln();
}
$pdf->Output('','DSPR/PWLDS'.'/'.date("d-m-Y").'.pdf');

?>