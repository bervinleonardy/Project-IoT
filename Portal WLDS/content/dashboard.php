         <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Geografis
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
				  <div id="mapwlds" style="height:300px; width:100%; "></div>
				  <?php include_once "map_monitoring.php"; ?>
              </div>
            </div>
            <!-- /.card -->			  
			  
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Monitoring Debit Pipa 
                </h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item">
                    <a class="nav-link active" href="#containerRetikulasi" data-toggle="tab">Retikulasi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#containerDinas" data-toggle="tab">Dinas</a>
                  </li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
					
          		<div class="chart tab-pane active" id="containerRetikulasi" style="min-width: 310px; max-width: 600px; height: 300px; margin: 0 auto"></div>	
          		<div class="chart tab-pane" id="containerDinas" style="min-width: 310px; max-width: 600px; height: 300px; margin: 0 auto"></div>					
					
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->			  
          </section>



          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
					<i class="fas fa-tachometer-alt"></i>
                   Reservoir
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button"
                          class="btn btn-secondary btn-sm"
                          data-card-widget="collapse"
                          data-toggle="tooltip"
                          title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
			  </div>  
                <!-- /.card-tools -->				  
 		 		 <!-- interactive chart -->
				<div class="card-body pt-0">
          		<div id="containerReservoir" style="min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto"></div>
				</div>
			</div>
			  
            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Kalender
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-bars"></i></button>
                    <div class="dropdown-menu float-right" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->