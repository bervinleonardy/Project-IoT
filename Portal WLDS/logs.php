<?php
//error_reporting(0);
$url=$_SERVER['REQUEST_URI'];
//header("Refresh: 5; URL=$url");
if($_SERVER['REQUEST_METHOD']==='GET'){
//Connect to database
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "db_wlds";

// buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);
// cek koneksi
if ($conn->connect_error) {
	die("Gagal terhubung dengan Database: " . $conn->connect_error);
}
	
$pilihres    = mysqli_query($conn,"SELECT * FROM t_reservoir ORDER BY id_res DESC");	
	while ($rowres = mysqli_fetch_array($pilihres)){
		$pilihret    = mysqli_query($conn,"SELECT * FROM t_p_retikulasi ORDER BY id_ret DESC");
		$rowret      = mysqli_fetch_array($pilihret);
		$pilihdin	 = mysqli_query($conn,"SELECT * FROM t_p_dinas ORDER BY id_pdinas DESC");
		$rowdin		 = mysqli_fetch_array($pilihdin);
		$array_data[] = array(
		"volume_reservoir"=>$rowres['sens_ultrasonic'],
		"tekanan_reservoir"=>$rowres['sens_tekanan'],			
		"pipa_retikulasi_awal"=>$rowret['debit_retikulasi1'],
		"pipa_retikulasi_akhir"=>$rowret['debit_retikulasi2'],
		"pipa_dinas_awal"=>$rowdin['debit_dinas1'],
		"pipa_dinas_akhir"=>$rowdin['debit_dinas2'],
		"tekanan_reservoir"=>$rowdin['sens_tekanan'],
		"latitude"=>$rowret['latitude'],
		"longitude"=>$rowret['longitude'],
		"waktu"=>$rowret['waktu'],
		"tanggal"=>$rowret['tanggal']
		);
	}
	header('Content-Type:application/json');
	
    if (!empty($array_data)){
		echo json_encode($array_data);
	}	
	else if (empty($array_data)){
		echo "Array data kosong";
	}
	
    //Get current date and time
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d");
    //echo " Date:".$d."<BR>";
    $waktu   = date("H:i:s");
	
if(!empty($_GET['retikulasiawal']) && !empty($_GET['retikulasiakhir']) && !empty($_GET['pdinasawal']) && !empty($_GET['pdinasakhir']) && !empty($_GET['ultrasonic']) && !empty($_GET['tekanan']))
{	
	$debit_retikulasi1  = $_GET['retikulasiawal'];
	$debit_retikulasi2  = $_GET['retikulasiakhir'];	
	$debit_dinas1  		= $_GET['pdinasawal'];	
	$debit_dinas2  		= $_GET['pdinasakhir'];
	$volume_res		  	= $_GET['ultrasonic'];
	$tekanan		  	= $_GET['tekanan'];	
	
	$sqlret    = "INSERT INTO t_p_retikulasi 
				(id_ret,debit_retikulasi1,debit_retikulasi2,latitude,longitude,waktu,tanggal) VALUES 
				( 'id_ret', '$debit_retikulasi1', '$debit_retikulasi2','-6.883985221578506','118907.551901 ' , '$waktu' , '$tanggal' )";
	
	$sqldin   = "INSERT INTO t_p_dinas 
				(id_pdinas,debit_dinas1,debit_dinas2,latitude,longitude,waktu,tanggal) VALUES 
				( 'id_ret', '$debit_dinas1', '$debit_dinas2','-6.883383411976825','118907.55124390125' , '$waktu' , '$tanggal' )";
	
	$sqlres  = "INSERT INTO t_reservoir
				(id_res,sens_ultrasonic,sens_tekanan,latitude,longitude,waktu,tanggal) VALUES 
				( 'id_res' , '$volume_res', '$tekanan', '-6.869313', '107.555098', '$waktu' , '$tanggal' )";	

	if (($conn->multi_query($sqlret) === TRUE) AND ($conn->multi_query($sqldin) === TRUE) AND ($conn->multi_query($sqlres) === TRUE) ) {
		echo "Record baru berhasil ditambahkan!!";
	} else {
		echo "Error: " . $sqlret . "<br>" . $conn->error;
		echo "Error: " . $sqldin . "<br>" . $conn->error;
		echo "Error: " . $sqlres . "<br>" . $conn->error;
	}
 }
//  else if (empty($debit_retikulasi1))	{
//	  echo " tidak ada data";
//  }

} else {

	echo "Check Again";

}
$conn->close();
?>