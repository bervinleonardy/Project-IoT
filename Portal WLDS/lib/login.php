<?php 
include "../include/lib_inc.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--sweet alert-->
<script type='text/javascript' src="../content/plugins/sweet-alert/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../content/plugins/sweet-alert/sweet-alert.css">	
</head>
<body>	
<?php
switch ($_GET["log"]){   	
	case md5("login")	:
		
						 $pu   = mysqli_real_escape_string($conn,$_POST["username"]);
						 $pp   = md5($_POST["password"]);
						 $user = mysqli_query($conn,"SELECT * FROM t_user WHERE (NIP  ='".$pu."'OR username  ='".$pu."') AND password ='".$pp."' ");
						 $row  = mysqli_fetch_array($user);

							if(mysqli_num_rows($user)>=1){
								$jabatan = "SELECT * FROM t_jabatan WHERE id_jabatan='$row[id_jabatan]'";
								$query   = mysqli_query($conn, $jabatan);
								$rowjab  = mysqli_fetch_array($query);
								session_start();									   
								$_SESSION["NIP"]        = $row['NIP'];
								$_SESSION["id_jabatan"] = $rowjab['id_jabatan'];
								$_SESSION["wlds"]     	= true;	
								if ($_SESSION["id_jabatan"] == 1){ 
									echo 
									'<script type="text/javascript">
										swal({ 
											  title: "Selamat Datang",
											   text: "'.$rowjab['nama_jabatan'].'",
												type: "success"
											  });								
										setTimeout(function(){
												window.location.href = "../content/index.php?halaman='.md5("dash").'";
											}, 1000);
									</script>'; }
								else if ($_SESSION["id_jabatan"] == 2 || $_SESSION["id_jabatan"] == 3){
									echo 
									'<script type="text/javascript">
										swal({ 
											  title: "Selamat Datang",
											   text: "'.$rowjab['nama_jabatan'].'",
												type: "success"
											  });								
										setTimeout(function(){
												window.location.href = "../content/index.php?halaman='.md5("reservoir").'";
											}, 1000);
									</script>';}								
							   }
							else {
								echo 
								'<script type="text/javascript">
									swal({ 
										  title: "Oops",
										   text: "Username/Email atau Password salah !!",
											type: "error"
										  });
									setTimeout(function(){
											window.history.back();
										}, 1000);											
								</script>';
								}
								mysqli_close($conn);
						break;
									   
	case md5("logout")	 : $user    = $_GET['sesi'] ;
						   $u_date  = date("Y-m-d H:i:s", time());
//						   print_r(md5($user));
//						   print_r($user);
//						   $buka    = md5($user);
						   $usr 	   = mysqli_query($conn,"UPDATE t_user SET terakhir_login='$u_date' WHERE NIP='$user'");
							//hapus PHPSESSID dari browser
//							if ( isset( $_COOKIE[session_name()] ) )
//							setcookie( session_name(), "", time()-3600, "/" );
							//bersihkan session global
//							$_SESSION = array();
							//hapus session dari penyimpanan
//							session_unset($_SESSION[$user]);	   
//						   	session_destroy();
							echo '<script type="text/javascript">
									swal({ 
									  title: "Terima Kasih",
									   text: "Anda Sudah Logout dari Sistem",
										type: "success"
									  });
									setTimeout(function(){
											window.location.href = "../index.php";
										}, 1000);											
							</script>'; 
							break;
								   
   }
?>
</body>
</html>