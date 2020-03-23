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
	
	$NIP	      = $_POST['NIP'];
	$namaus       = $_POST['namaus'];
	$jabatan	  = $_POST['jabs'];
	$email        = $_POST['email'];
	$notel 		  = $_POST['notel'];
	$username     = $_POST['username'];
	$password     = $_POST['password'];
	
	if($_FILES['fotous']['name']!="") {
		$fotous        = $_FILES['fotous']['name'];
		$filetoupload  = $_FILES['fotous']['tmp_name'];
		$target        = "../content/dist/img/user";
												
		$ext           = explode('.',$fotous);										
		$ekstensi      = end($ext);												
		$ekstensi      = strtolower($ekstensi);	
											
		if($ekstensi=='gif' OR $ekstensi=='jpg' OR $ekstensi=='jpeg' OR $ekstensi=='png') {	
			move_uploaded_file($filetoupload, $target.$fotous );													
		}													
	}
											
	$passus  = md5($password);
									
	$query   = mysqli_query($conn,"INSERT INTO t_user(NIP, nama_user, foto_user, email, no_telp, username, password, id_jabatan) 
									VALUES ('$NIP','$namaus','$fotous','$email','$notel','$username','$passus','$jabatan')");
	if ($query){
	echo '<script type="text/javascript">
				swal({ 
			  title: "Sukses",
			   text: "Data Pengguna Berhasil Dimasukan",
				type: "success"
			  },
			  function(){
				  window.location.href = "../../content/index.php?halaman='.md5('pengguna').'";
			});												
	</script>'; 
	}
	else {
		echo '<script type="text/javascript">
				swal({ 
			  title: "Oops",
			   text: "Data Pengguna Gagal Dimasukan",
				type: "error" 
			  },
			  function(){
				 window.location.href = "../../content/index.php?halaman='.md5('pengguna').'";
			});												
	</script>';		
	}
?>
</body>
</html>