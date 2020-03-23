<?php 
//error_reporting(0);
$db_host = 'localhost'; // Nama Server
$db_user = 'root'; // User Server
$db_pass = ''; // Password Server
$db_name = 'db_wlds'; // Nama Database

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Gagal terhubung MySQL: ' . mysqli_connect_error());	
}
//include_once '../include/lib_inc.php';

$listdata = "SELECT * FROM t_deteksi WHERE keterangan LIKE '%Dinas Bocor%'  ORDER BY id_deteksi DESC LIMIT 1";
$query = mysqli_query($conn, $listdata);
while($data= mysqli_fetch_array($query)){
	$sqlb = "SELECT a.id_res, a.sens_tekanan AS tekanan, a.sens_ultrasonic AS volume,b.id_pdinas,b.debit_dinas_1 AS debdin1 , b.debit_dinas_2 AS debdin2, c.id_ret, c.debit_retikulasi1 AS debret1, c.debit_retikulasi2 AS debret2 
			FROM t_reservoir a, t_p_dinas  b, t_p_retikulasi c WHERE a.id_res='$data[id_res]' AND b.id_pdinas='$data[id_pdinas]' AND c.id_ret='$data[id_ret]' ";										
	$queryb = mysqli_query($conn, $sqlb);								
	$rowb = mysqli_fetch_array($queryb);
		
	$array_data[] = array(
		"id"=>$data['id_deteksi'],
		"pipa_retikulasi_awal"=>$rowb['debret1'],
		"pipa_retikulasi_akhir"=>$rowb['debret2'],
		"pipa_dinas_awal"=>$rowb['debdin1'],
		"pipa_dinas_akhir"=>$rowb['debdin2'],
		"tekanan_reservoir"=>$rowb['tekanan'],
		"volume_reservoir"=>$rowb['volume'],
		"latitude"=>$data['latitude'],
		"longitude"=>$data['longitude'],
		"waktu"=>$data['waktu'],
		"tanggal"=>$data['tanggal'],
		"keterangan"=>$data['keterangan']
	);	
	
}
header('Content-Type: application/json;charset=utf-8');
echo (json_encode($array_data,true));

?>
