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
	include "../../include/lib_inc.php";
	$lat        = $_POST['lat'];
	$lng        = $_POST['lng'];	
	
	$sql = mysqli_query($conn,"SELECT * FROM t_deteksi WHERE keterangan LIKE '%Dinas%' ");
	$row = mysqli_fetch_array($sql);
	$lat_ori_dinas = $row['latitude'];
	$lng_ori_dinas = $row['longitude'];
	
	$query   = mysqli_query($conn,"UPDATE t_deteksi SET latitude='$lat', longitude='$lng' WHERE latitude='$lat_ori_dinas' AND longitude ='$lng_ori_dinas' ");
	
	if ($query === TRUE) {
	echo '<script type="text/javascript">
			swal({ 
			  title: "Sukses",
			   text: "Data Lokasi Pipa Berhasil Disetel Ulang",
				type: "success"
			  });
			  setTimeout(function(){
				window.location.href = "../../content/index.php?halaman='.md5('deteksi').'";
			}, 2000);										
	</script>';			
		
	} else {
//		echo "Error: " . $sql . "<br>" . $query . "<br>" .$conn->error;
	echo '<script type="text/javascript">
			swal({ 
			  title: "Oops",
			   text: "Data Lokasi Pipa Gagal Disetel Ulang",
				type: "error"
			  });
			  setTimeout(function(){
				window.location.href = "../../content/index.php?halaman='.md5('deteksi').'";
			}, 2000);											
	</script>';			
	}							

?>
</body>
</html>