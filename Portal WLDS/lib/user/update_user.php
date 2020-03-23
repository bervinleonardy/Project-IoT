<?php
	include "../../include/lib_inc.php";

	$iduser       = $_POST['iduser'];
	$namaus       = $_POST['namaus'];
	$email        = $_POST['email'];
	$notel 		  = $_POST['no_telp'];
	$username     = $_POST['username'];
	$tipeuser     = $_POST['tipeuser'];
	$status       = $_POST['status'];
	$passus        = md5($password);
	
	if($_FILES['fotous']['name']!="") {
		$fotous       = $_FILES['fotous']['name'];
		$filetoupload  = $_FILES['fotous']['tmp_name'];
		$target        = "dist/img/";
												
		$ext           = explode('.',$fotous);										
		$ekstensi      = end($ext);												
		$ekstensi      = strtolower($ekstensi);	
													
		if($ekstensi=='gif' OR $ekstensi=='jpg' OR $ekstensi=='jpeg' OR $ekstensi=='png') {	
			move_uploaded_file($filetoupload, $target.$fotous );													
		}													
	} elseif($_FILES['fotous']['name']=="") {
	   		$fotous = $foto;
	}
												
										
	$query = mysqli_query($conn,"UPDATE t_user SET nama_user='$nama', foto_user='$fotous', email='$email', no_telp='$notel', username='$username', 				 								tipe_user='$idtipe', status='$status'
								WHERE id_user='$iduser'");
	
												
	header('location:../../index.php?hal='.md5('user').'');
?>
