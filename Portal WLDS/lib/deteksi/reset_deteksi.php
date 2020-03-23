<!DOCTYPE html>
<html>
<head>
<!--sweet alert-->
<script type='text/javascript' src="../../content/plugins/sweet-alert/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../content/plugins/sweet-alert/sweet-alert.css">	
</head>
<body>	
<?php
	include "../../include/lib_inc.php";

	$del = $_GET['del'];
												
	$akn = mysqli_query($conn,"DELETE FROM t_deteksi");
	echo '<script type="text/javascript">
				swal({ 
			  title: "Sukses",
			   text: "Data Berhasil Dihapus",
				type: "success"
			  },
			  function(){
				  window.location.href = "../../content/index.php?halaman='.md5('deteksi').'";
			});												
	</script>'; 
?>
</body>
</html>