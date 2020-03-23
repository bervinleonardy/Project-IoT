<?php
switch ((isset($_GET['halaman']) ? $_GET['halaman']: '')) {		
		
	case md5("dash"):
		$redirect="dashboard.php";
		break;
		
	case md5("reservoir"):
		$redirect="reservoir.php";
		break;		
		
	case md5("retikulasi"):
		$redirect="retikulasi.php";
		break;	
		
	case md5("pdinas"):
		$redirect="pdinas.php";
		break;	
		
	case md5("deteksi"):
		$redirect="deteksi.php";
		break;	
		
	case md5("geografis"):
		$redirect="geografis.php";
		break;			
		
	case md5("pengguna"):
		$redirect="user.php";
		break;	
		

	default:
		$redirect="404.php";
		break;
					
}
			
include_once "$redirect";
?>