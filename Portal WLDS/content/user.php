    <!-- Main content -->
    <section class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><strong>Data Pengguna</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
               <?php
				include'../lib/user/list_user.php';
			    ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->
    
  <!-- Modal Popup untuk Add--> 
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ModalAdd" class="modal fade">
	<div class="modal-dialog">
    	<div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Tambah Data User</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
        <div class="modal-body">
          <form action="../lib/user/add_user.php" name="modal_popup" enctype="multipart/form-data" method="POST">            
                <div class="form-group">
                	<label for="Modal Name">NIP</label>
     				<input type="text" name="NIP" class="form-control" required/>
                </div>             		
                <div class="form-group">
                	<label for="Modal Name">Nama</label>
     				<input type="text" name="namaus"  class="form-control" required/>
                </div>
                <div class="form-group">
                	<label for="Modal Name">Username</label>
     				<input type="text" name="username"  class="form-control" required/>
                </div>			  
                <div class="form-group">
                	<label for="Modal Name">Jabatan</label>
					  <select class="form-control" name="jabs">
						<option>--Pilih--</option>
						<?php
						  	$sqla = "SELECT id_jabatan,nama_jabatan FROM t_jabatan WHERE id_jabatan!= '$_SESSION[id_jabatan] '";
							$querya = mysqli_query($conn, $sqla);					  
							while ($rowa = mysqli_fetch_array($querya))

								{	
									if ($rowa["id_jabatan"] == $jabs){
										$cek = "checked";
									}
									else {
										$cek = "";
									}

							echo '<option value="'.$rowa["id_jabatan"].'" '.$cek.'> '.$rowa["nama_jabatan"].'</option>								

							'; }?>                                            
						</select>
                </div>			 
                <div class="form-group">
                	<label for="Modal Name">Foto User</label>
     				<input type="file" name="fotous">
                </div>
                <div class="form-group">
                	<label for="Modal Name">Email</label>
     				<input type="text" name="email"  class="form-control" required/>
                </div>
                <div class="form-group">
                	<label for="Modal Name">No. Telepon</label>
     				<input type="text" name="notel"  class="form-control" required/>
                </div> 
                <div class="form-group">
                	<label for="Modal Name">Password</label>
     				<input type="password" name="password"  class="form-control" required/>
                </div>
              	<div class="modal-footer">
                  <button class="btn btn-success" type="submit">Tambah</button>
                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Kembali</button>
              	</div>
          </form>

           

            </div>

           
        </div>
    </div>
</div>

<!-- Modal Popup untuk Edit--> 
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <h4 class="modal-title">Anda yakin ingin menghapus data ini ?</h4>
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
 
   
<!-- Javascript untuk popup modal Edit--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(document).on('click','.open_modal',function() {
      var m = $(this).attr("id");
		   $.ajax({
    			   url: "../lib/user/edit_user.php",
    			   type: "GET",
    			   data : {edit: m,},
    			   success: function (ajaxData){
      			   $("#ModalEdit").html(ajaxData);
      			   $("#ModalEdit").modal('show',{backdrop: 'true'});
      		   }
    		   });
        });
      });
</script>

<!-- Javascript untuk popup modal Delete--> 
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modal_delete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- DataTables JavaScript -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#dataTables-example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
	  "responsive":true,
      "autoWidth": true
    });
  });
</script>