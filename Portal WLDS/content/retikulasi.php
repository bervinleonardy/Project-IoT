    <!-- Main content -->
    <section class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><strong>Data Sensor di Pipa Retikulasi</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="dataTables-example2" class="table table-bordered table-striped">
               <?php
				include'../lib/retikulasi/list_retikulasi.php';
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
<script  type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
