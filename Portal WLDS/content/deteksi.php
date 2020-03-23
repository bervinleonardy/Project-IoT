<?php 
	if($_SESSION["id_jabatan"]== 2){
?>
<!-- Left col -->
          <section class="col-lg-12 ">
            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Geografis Pipa
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button"
                          class="btn btn-primary btn-sm"
                          data-card-widget="collapse"
                          data-toggle="tooltip"
                          title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
				
              <div class="card-body">
				  <div id="mapwlds" style="height:400px; width:100%; "></div>
<!--
				  <div id="info">
					<h3>Mohon Tunggu...</h3>
				  </div>
-->
				  <?php include_once "map_deteksi.php"; ?>
              </div>
            </div>
            <!-- /.card -->			  
          </section>

<!-- Main content -->
    <section class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><strong>Data Deteksi Kebocoran Pipa</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="dataTables-example4" class="table table-bordered table-striped">
               <?php
				include'../lib/deteksi/list_deteksi.php';
			    ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->
    
<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <h4 class="modal-title">Anda yakin ingin reset data ini ?</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>		  
      </div>
                
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Hapus</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>

<!-- Javascript untuk popup modal Delete--> 
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modal_delete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>
<!-- jQuery 2.2.3 -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
<?php }
	else if($_SESSION["id_jabatan"]== 3){
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">	
<!-- Main content -->
    <section class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><strong>Data Deteksi Kebocoran Pipa</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
			<form action="../lib/deteksi/cetak_deteksi.php" method="post" enctype="multipart/form-data"> 
              <table id="dataTables-example4" class="table table-bordered table-striped">
				  <label>Cetak Berdasarkan Periode</label><br>
					<div class="row">
					 <div class="col-lg-6">
					  <div class="form-group">
					   <label>Tanggal</label>
					   <div class="input-group date">
						<div class="input-group-addon">
							   <span class="glyphicon glyphicon-th"></span>
						   </div>
						   <input id="tgl_mulai" placeholder="Masukkan Tanggal Awal" type="text" class="form-control datepicker" name="tgl_awal" readonly>
					   </div>
					  </div>
					  <div class="form-group">
					   <label>Sampai Tanggal</label>
					   <div class="input-group date">
						<div class="input-group-addon">
							   <span class="glyphicon glyphicon-th"></span>
						   </div>
						   <input id="tgl_akhir" placeholder="Masukkan Tanggal Akhir" type="text" class="form-control datepicker" name="tgl_akhir" readonly>
					   </div>
					  </div>
						 <button type="submit" class="btn btn-success"  style="float: right;">
							<i class="fa fa-print"></i> Cetak Filter Data
						</button> 
					 </div>
					</div>		
               <?php
				include'../lib/deteksi/list_deteksi.php';
			    ?>
              </table>
			</form>	
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->	
<!-- jQuery datepicker -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script type="text/javascript">
//    $(document).ready(function(){ // Ketika halaman selesai di load
//        $('.input-tanggal').datepicker({
//		    changeMonth: true,
//		    changeYear: true,			
//            dateFormat: 'yy-mm-dd', // Set format tanggalnya jadi yyyy-mm-dd
//			onSelect: function(dateText, inst) { 
//        window.location = '../lib/deteksi/cetak_deteksi.php?filter=' + dateText;
//    }
//    });
//    })
$(function () {
    $("#tgl_mulai, #tgl_akhir").datepicker({dateFormat: 'yy-mm-dd'});
    $("#tgl_mulai").on('changeDate', function(selected) {
		
        var date1 = new Date(selected.date.valueOf());
      	var date2 = new Date(date1.getTime());
        date2.setDate(date2.getDate());
        $("#tgl_akhir").datepicker("setStartDate", date2);
		
        if($("#tgl_mulai").val() > $("#tgl_akhir").val()){
          $("#tgl_akhir").val($("#tgl_mulai").val());
        }		
		console.log(date1,date2);
    });
});
    </script>		
<?php }
else{
    echo "Anda tidak mempunyai hak untuk mengakses halaman ini";
}
?> 	