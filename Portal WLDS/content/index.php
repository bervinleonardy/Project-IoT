<?php 
session_start();
//error_reporting(0);

include_once'../include/lib_inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--  <meta http-equiv="Refresh" content="5">-->
  <meta name="viewport" content="width=device-width, initial-scale=0.0">	

  <title>UPTAM Cimahi | Beranda</title>
  <link rel='shortcut icon' type='image/x-icon' href='../img/cimahi_logo_icon.ico' />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!--Library Leaflet Maps-->
<!--  <script src="maps/leaflet.js"></script>-->
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
  <script src="maps/wax.leaf.min.js"></script>
<!--  <link href="maps/leaflet.css" rel="stylesheet">-->
  <link href="maps/leaflet.ie.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
  <!--Library Leaflet Maps AJAX Geojson-->
  <script type="text/javascript" src="maps/leaflet.ajax.js"></script>
  <script src="maps/spin.js"></script>
  <script src="maps/leaflet.spin.js"></script>
<!--  <script src="maps/leaflet-src1.js"></script>-->
  <script type="text/javascript" src="maps/bouncemarker.js"></script>
  <!--Library Leaflet Maps LineString (Pipa) Geojson-->	
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Turf.js/5.1.5/turf.js"></script>
  <!--Library Leaflet Maps Fullscreen-->
  <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
  <!--Library Leaflet Maps Gesture Handling untuk ctrl + zoom -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css" type="text/css">
  <script type="text/javascript" src="https://unpkg.com/leaflet-gesture-handling@1.1.8/dist/leaflet-gesture-handling.min.js"></script>
  <!--Library highcharts -->	  
  <link rel="stylesheet" href="dist/css/highcharts.css" type="text/css">
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/highcharts-more.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <!-- Library Leaflet Maps Pulse Marker	-->
  <link rel="stylesheet" href="maps/icon-pulse/L.Icon.Pulse.css" type="text/css">
  <script type="text/javascript" src="maps/icon-pulse/L.Icon.Pulse.js"> </script>
  <!-- Library Leaflet Maps Draw & Editable Maps polygon etc -->
    <script src="maps/map-draw/Leaflet.draw.js"></script>
    <script src="maps/map-draw/Leaflet.Draw.Event.js"></script>
    <link rel="stylesheet" href="maps/map-draw/leaflet.draw.css" type="text/css"/>

    <script src="maps/map-draw/Toolbar.js"></script>
    <script src="maps/map-draw/Tooltip.js"></script>

    <script src="maps/map-draw/ext/GeometryUtil.js"></script>
    <script src="maps/map-draw/ext/LatLngUtil.js"></script>
    <script src="maps/map-draw/ext/LineUtil.Intersect.js"></script>
    <script src="maps/map-draw/ext/Polygon.Intersect.js"></script>
    <script src="maps/map-draw/ext/Polyline.Intersect.js"></script>
    <script src="maps/map-draw/ext/TouchEvents.js"></script>

    <script src="maps/map-draw/draw/DrawToolbar.js"></script>
    <script src="maps/map-draw/draw/handler/Draw.Feature.js"></script>
    <script src="maps/map-draw/draw/handler/Draw.SimpleShape.js"></script>
    <script src="maps/map-draw/draw/handler/Draw.Polyline.js"></script>
    <script src="maps/map-draw/draw/handler/Draw.Marker.js"></script>
    <script src="maps/map-draw/draw/handler/Draw.Circle.js"></script>
    <script src="maps/map-draw/draw/handler/Draw.CircleMarker.js"></script>
    <script src="maps/map-draw/draw/handler/Draw.Polygon.js"></script>
    <script src="maps/map-draw/draw/handler/Draw.Rectangle.js"></script>


    <script src="maps/map-draw/edit/EditToolbar.js"></script>
    <script src="maps/map-draw/edit/handler/EditToolbar.Edit.js"></script>
    <script src="maps/map-draw/edit/handler/EditToolbar.Delete.js"></script>

    <script src="maps/map-draw/Control.Draw.js"></script>

    <script src="maps/map-draw/edit/handler/Edit.Poly.js"></script>
    <script src="maps/map-draw/edit/handler/Edit.SimpleShape.js"></script>
    <script src="maps/map-draw/edit/handler/Edit.Rectangle.js"></script>
    <script src="maps/map-draw/edit/handler/Edit.Marker.js"></script>
    <script src="maps/map-draw/edit/handler/Edit.CircleMarker.js"></script>
    <script src="maps/map-draw/edit/handler/Edit.Circle.js"></script>	
	<!--sweet alert-->
	<script type='text/javascript' src="plugins/sweet-alert/sweet-alert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="plugins/sweet-alert/sweet-alert.css">		
<style>
	#info {
    width:250px;
    height:100px;
    background:rgba(255, 255, 255, 0.7);
    border: 1px solid #000000;
    border-radius:5px;
    position:fixed;
    top:200px;
    left:calc(50% - 125px);
    margin: auto;
    padding:10px;
    color:#000000;
}
/*Info Legenda */
.legend {
  padding: 6px 8px;
  font: 14px Arial, Helvetica, sans-serif;
  background: white;
  background: rgba(255, 255, 255, 0.8);
  /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
  /*border-radius: 5px;*/
  line-height: 24px;
  color: #555;
}
.legend h4 {
  text-align: center;
  font-size: 16px;
  margin: 2px 12px 8px;
  color: #777;
}

.legend span {
  position: relative;
  bottom: 3px;
}

.legend i {
  width: 18px;
  height: 18px;
  float: left;
  margin: 0 8px 0 0;
  opacity: 0.7;
}

.legend i.icon {
  background-size: 18px;
  background-color: rgba(255, 255, 255, 1);
}
</style>	
</head>
	
<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<?php 
if (isset($_SESSION["wlds"]) ==true){
	$sql = "SELECT * FROM t_user WHERE NIP='$_SESSION[NIP]'  ";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($query);	
	
	$sqla = "SELECT * FROM t_jabatan WHERE id_jabatan='$row[id_jabatan]'  ";
	$querya = mysqli_query($conn, $sqla);
	$rowa = mysqli_fetch_array($querya);	
//	include_once 'profile.php';
?>	
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">   
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
		   <i class="far fa-bell"></i>
        <?php
			$sqla = "SELECT * FROM t_deteksi WHERE keterangan='Bocor'";											
			$querya = mysqli_query($conn, $sqla);
			
			if(mysqli_num_rows($querya)!=0){
				echo '<span class="badge badge-warning navbar-badge">'.mysqli_num_rows($querya).'</span>';
				}
			else{
				echo '';
				}
		?>			
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
		<?php 
			if(mysqli_num_rows($querya)!=0){
				$judul='<span class="dropdown-item dropdown-header">Notifikasi Kebocoran</span>';
				}
			else{
				echo '<span class="dropdown-item dropdown-header">Tidak ada Pemberitahuan</span>';
				}			
			?>				
			<div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
		<?php 
			if(mysqli_num_rows($querya)!=0){
				echo '<i class="fas fa-envelope mr-2"></i> Pipa Bocor';
				echo '<span class="float-right text-muted text-sm">3 mins</span>';
				}
			else{
				echo '';
				}			
			?>				  
          </a>
<!--
						
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
-->
        </div>
      </li>
      <!--Logout Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user-alt"></i>
		  <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
			
            <!-- Profile Image -->
            <div class="card card-primary">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/user/<?=$row['foto_user'] ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?=$rowa['nama_jabatan']?></h3>

                <p class="text-muted text-center"><?=$row['nama_user'] ?></p>

                <a href="../lib/login.php?log=<?=md5("logout")?>&sesi=<?=$_SESSION['NIP'];?>&hapussesi=<?=$_COOKIE[session_name()];?>" class="btn btn-primary btn-block"><b>Logout</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
        </div>
      </li>		
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-dark-navy">
    <!-- Brand Logo -->
    <a class="brand-link navbar-primary ">
      <img src="../img/cimahi_logo_icon.ico" alt="Logo UPT" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">UPT Air Minum</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user/<?=$row['foto_user']?>" class="img-circle elevation-2" alt="Gambar Pengguna">
        </div>
        <div class="info">
          <a class="d-block"><?=$rowa['nama_jabatan']?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
		<?php include'../lib/menu_nav.php';?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Water Leakage Detector System</h1>
          </div><!-- /.col -->
			
<!--
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div> /.col 
-->
			
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
<!--    <section class="content">-->
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
				 <p>Status Reservoir</p>
				<?php
					$sqlb = "SELECT * FROM t_reservoir ORDER BY id_res DESC";											
					$queryb = mysqli_query($conn, $sqlb);
					$rowc = mysqli_fetch_array($queryb);
	
					if($rowc['sens_tekanan'] >= 1.00 OR $rowc['sens_ultrasonic'] != 0){
						echo '<p>Tekanan : Stabil</p>';
						echo '<p>Volume  : '.$rowc['sens_ultrasonic'].' Liter</p>';
						}
					else if ($rowc['sens_tekanan'] >= 3.00 OR $rowc['sens_ultrasonic'] != 0){
						echo '<p>Tekanan : Tinggi</p>';
						echo '<p>Volume  : '.$rowc['sens_ultrasonic'].' Liter</p>';
						}
//					else if ($rowc['sens_tekanan'] <= 1.00){
//						echo '<h3>Tekanan : Rendah</h3>';
//						}
					else if ($rowc['sens_tekanan'] >= 0 OR $rowc['sens_ultrasonic'] != 0){
						echo '<p>Tidak Ada Data !</p>';
						}	
				  ?>					
              </div>
              <div class="icon">
                <i class="ion ion-ios-speedometer"></i>
              </div>
<!--              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
				
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
				 <p>Status Pipa Retikulasi</p> 
				<?php
					$sqlc = "SELECT * FROM t_p_retikulasi ORDER BY id_ret DESC";											
					$queryc = mysqli_query($conn, $sqlc);
					$rowd = mysqli_fetch_array($queryc);
	
					if($rowd['debit_retikulasi2'] != $rowd['debit_retikulasi1']){
						echo '<p>Status : Aman</p>';
						echo '<p>Debit  : '.$rowd['debit_retikulasi2'].' Liter/detik</p>';
						}
					else if ($rowd['debit_retikulasi2'] <= $rowd['debit_retikulasi1']){
						echo '<p>Status : Bocor</p>';
						echo '<p>Debit  : '.$rowd['debit_retikulasi2'].' Liter/detik</p>';
						}
					else if ($rowd['debit_retikulasi2'] == 0){
						echo '<p>Tidak Ada Data !</p>';
						}	
				  ?>				  
              </div>
				

              <div class="icon">
                <i class="ion ion-waterdrop"></i>
              </div>
<!--
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
				<p>Status Pipa Dinas</p>  
				<?php
					$sqld = "SELECT * FROM t_p_dinas ORDER BY id_pdinas DESC";											
					$queryd = mysqli_query($conn, $sqld);
					$rowe = mysqli_fetch_array($queryd);
	
					if($rowe['debit_dinas_2'] != $rowe['debit_dinas_1']){
						echo '<p>Status : Aman</p>';
						echo '<p>Debit  : '.$rowe['debit_dinas_2'].' Liter/detik</p>';
						}
					else if ($rowe['debit_dinas_2'] < $rowe['debit_dinas_1']){
						echo '<p>Status : Bocor</p>';
						echo '<p>Debit  : '.$rowe['debit_dinas_2'].' Liter/detik</p>';
						}
					else if ($rowe['debit_dinas_2'] == 0){
						echo '<p>Tidak Ada Data !</p>';
						}	
				  ?>
              </div>
				

              <div class="icon">
                <i class="ion ion-waterdrop"></i>
              </div>
				<!--
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
				<p>Status Kebocoran</p>  
				<?php
					$sqle = "SELECT * FROM t_deteksi ORDER BY id_deteksi DESC";											
					$querye = mysqli_query($conn, $sqle);
					$rowf = mysqli_fetch_array($querye);
	
					if($rowf['keterangan'] == 'Retikulasi Bocor' OR $rowf['keterangan'] == 'Dinas Bocor'){
						echo '<p>Status : Pipa Bocor</p>';
						}
//					else if ($rowf['keterangan'] == 'Aman'){
//						echo '<p>Status : Tidak Bocor</p>';
//						}
					else if ($rowf['id_pdinas'] == 0 OR $rowf['id_ret'] == 0 OR $rowf['id_res'] == 0 ){
						echo '<p>Status : Sensor Tidak Diketahui !</p>';
						}	
					else if ($rowf['keterangan'] == 0){
						echo '<p>Tidak Ada Data !</p>';
						}	
					else {
						echo '<p>Status : Kesalahan Tidak Diketahui !</p>';
					}
				  ?>
              </div>

              <div class="icon">
                <i class="ion ion-alert-circled"></i>
              </div>
				<!--
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
-->
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
		<?php 
			include'cases.php';
		?>   
		<!-- /.content -->	  	
	    </div>
	    <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <!-- Content of the sidebar goes here -->
    </div>	  
  </aside>
  <!-- /.control-sidebar -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019-2020 UPT Air Minum Kota Cimahi.</strong>
    All rights reserved.
<!--
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-rc.1
    </div>
-->
  </footer>
</div>
<!-- ./wrapper -->  
<!--Library highcharts -->
<!--<script async src="dist/js/map.js"></script>	  -->
<!--
<script async src="dist/js/reservoir.js"></script>	
<script async src="dist/js/retikulasi.js"></script>
<script async src="dist/js/dinas.js"></script>	  
-->
<!-- jQuery -->
<script src="plugins/jquery/jquery.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!--<script src="plugins/sparklines/sparkline.js"></script>-->
<!-- JQVMap -->
<!--
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.world.js"></script>
-->
	  
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables JavaScript -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#dataTables-example1").DataTable();
	$("#dataTables-example2").DataTable();
	$("#dataTables-example3").DataTable();
	var table4 = $("#dataTables-example4").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>		
  <?php }
	else{
		echo '<script type="text/javascript">
				swal({ 
				  title: "Oops",
				   text: "Sesi Anda Telah Berakhir",
					type: "error"
				  });
				setTimeout(function(){
						window.location.href = "../index.php";
					}, 1000);											
		</script>'; 
	}

  ?> 	
</body>
</html>