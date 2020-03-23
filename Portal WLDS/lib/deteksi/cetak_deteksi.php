<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--sweet alert-->
<script type='text/javascript' src="../../content/plugins/sweet-alert/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../content/plugins/sweet-alert/sweet-alert.css">	
</head>
<body>	
<?php
ob_start();
//Get current date and time
date_default_timezone_set('Asia/Jakarta');
// memanggil library FPDF
require('../../include/fpdf/fpdf.php');
require '../../include/lib_inc.php';
//Ambil tanggal
//$tgl_awal  = $_POST['tgl_awal'];
//$tgl_akhir = $_POST['tgl_akhir'];
//print_r($tgl_awal .' dan '. $tgl_akhir);
if(empty($_POST['tgl_awal']) || empty($_POST['tgl_akhir'])){
	echo 
	'<script type="text/javascript">
		swal({ 
			  title: "Oops",
			   text: "Kedua Tanggal Harus Diisi !!",
				type: "error"
			  });
		setTimeout(function(){
				window.history.back();
			}, 1000);											
	</script>';	
}else{	
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
$pdf->Cell(200,5,'BERITA ACARA KEBOCORAN PIPA',0,1,'C');

$pdf->SetFont('Arial','',9);
$pdf->Cell(20,8,'Pada tanggal :....'.date("d", strtotime( $_POST['tgl_akhir'])).'.... Bulan.... '.date("m", strtotime( $_POST['tgl_akhir'])).'....Tahun.... '.date("Y", strtotime( $_POST['tgl_akhir'])).'.... telah terdeteksi kebocoran pipa',0,1,'L'); // cell dengan panjang 1

$pdf->ln(0.3);
$pdf->SetFont('Arial','',9);
$pdf->Cell(10,10,'NO',1,0,'C');
$pdf->Cell(13,10,'Tekanan',1,0,'C');
$pdf->Cell(20,10,'Volume',1,0,'C');
$pdf->Cell(23,10,'Retikulasi Awal',1,0,'C');
$pdf->Cell(23,10,'Retikulasi Akhir',1,0,'C');
$pdf->Cell(20,10,'Dinas Awal',1,0,'C');
$pdf->Cell(20,10,'Dinas Akhir',1,0,'C');
$pdf->Cell(30,10,'Koordinat',1,0,'C');
$pdf->Cell(30,10,'Waktu',1,0,'C');
$pdf->Ln();

$pdf->SetFont('Arial','',8);
	
$cekfilter = "SELECT * FROM t_deteksi WHERE DATE(tanggal) BETWEEN '".$_POST['tgl_awal']."' AND '".$_POST['tgl_akhir']."' ";
$sqlfilter = mysqli_query($conn,$cekfilter);
$rowfilter = mysqli_num_rows($sqlfilter);
if($rowfilter>0){								
$no=1;
while ($row = mysqli_fetch_array($sqlfilter))						
{
  $sqla = "SELECT * FROM t_reservoir WHERE id_res='$row[id_res]'";	
  $querya = mysqli_query($conn, $sqla);
  $rowa = mysqli_fetch_array($querya);

  $sqlb = "SELECT * FROM t_p_retikulasi WHERE id_ret='$row[id_ret]'";
  $queryb = mysqli_query($conn, $sqlb);
  $rowb = mysqli_fetch_array($queryb);										
  $sqlc = "SELECT * FROM t_p_dinas WHERE id_pdinas='$row[id_pdinas]'";	
  $queryc = mysqli_query($conn, $sqlc);
  $rowc = mysqli_fetch_array($queryc);	
	
	$pdf->Cell(10,5,$no++,1,0,'C');
	$pdf->Cell(13,5,$rowa['sens_tekanan'].' PSi',1,0,'C');
	$pdf->Cell(20,5,$rowa['sens_ultrasonic'].' Liter',1,0,'C');
	$pdf->Cell(23,5,$rowb['debit_retikulasi1'].' Liter/detik',1,0,'C');
	$pdf->Cell(23,5,$rowb['debit_retikulasi2'].' Liter/detik',1,0,'C');
	$pdf->Cell(20,5,$rowc['debit_dinas_1'].' Liter/detik',1,0,'C');
	$pdf->Cell(20,5,$rowc['debit_dinas_2'].' Liter/detik',1,0,'C');
	$pdf->Cell(30,5,$row['latitude'].','.$row['longitude'],1,0,'C');
	$pdf->Cell(30,5,$row['tanggal'].'/'.$row['waktu'],1,0,'C');
	$pdf->Ln();
}
}
else {
	$pdf->Cell(100,5,'Data tidak ada!!',1,0,'C');
}	

$pdf->SetFont('Arial','',9);
$pdf->Cell(70,5,'Demikian Berita Acara ini dibuat dan ditandatangani dengan sebenar-benarnya',0,1,'L'); // 	
$pdf->Cell(290,7,'Penanggung Jawab Sistem',0,1,'L');

$pdf->SetFont('Arial','',9);
$pdf->Cell(290,7,'(Petugas)',0,1,'L');
$pdf->Output('','BAKP/PWLDS'.'/'.date("d-m-Y").'.pdf');
ob_end_flush(); 	
}
?>
</body>
</html>