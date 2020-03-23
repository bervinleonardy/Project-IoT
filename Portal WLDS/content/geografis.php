         <!-- Left col -->
          <section class="col-lg-12 ">
            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Geografis Wilayah
                </h3>
                <!-- card tools -->
                <div class="card-tools">
				<a href="#" class="btn btn-info pull-right" data-target="#ModalPipa" data-toggle="modal"><i class="fa fa-check"></i> Setel Ulang Lokasi Pipa</a>					
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
				
				 <!-- Modal Popup untuk Add--> 
				<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ModalPipa" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">

						<div class="modal-header">
<!--							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
							<h4 class="modal-title" id="myModalLabel"><font color="#000000">Setel Ulang Manual Lokasi Sensor di Pipa</h4>
						</div>

						<div class="modal-body">
						  <form action="../lib/deteksi/setel_ulang_lokasi.php" name="modal_popup" enctype="multipart/form-data" method="POST">            
							
								<div class="form-group" style="padding-bottom: 20px;">					
									<label for="Modal Name">Lokasi</label>
										<input type="text" name="lat" id="lat" class="form-control" readonly/>
										<input type="text" name="lng" id="lng" class="form-control" readonly/>
										<script src="dist/js/lokasi.js"></script>
										<div id="mappipa" style="height: 300px; width:auto;" ></div>
										<span class="help-block"><font color="#FB0307">Geser marker (Penanda Lokasi) sesuai lokasi sensor pipa!</font></span>
								</div>			  
								<div class="modal-footer">
								  <button class="btn btn-success" type="submit">Simpan</button>
								  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Kembali</button>
								</div>
						  </form>
							</div>
						</div>
					</div>
				</div> 				
				
              <div class="card-body">
				  <div id="mapwlds" style="height:600px; width:auto; "></div>
<!--
				  <div id="info">
					<h3>Mohon Tunggu...</h3>
				  </div>
-->
				  <?php include_once "map.php"; ?>
              </div>
            </div>
            <!-- /.card -->			  
          </section>

<!--        </div>-->
        <!-- /.row (main row) -->
<!--      </div> /.container-fluid -->
<!--    </section>-->
    <!-- /.content -->