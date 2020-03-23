<?php
function kodeAcak($panjang)
{
 $karakter = '';
 $karakter .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; // karakter alfabet
 $karakter .= '1234567890'; // karakter numerik
 $karakter .= '@#$^*()_+=/?'; // karakter simbol
 
 $string = '';
 for ($i=0; $i < $panjang; $i++) { 
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
 }
 return $string; // pengulangan secara acak 
}
$panjang = 999 ;
$string = kodeAcak($panjang);
?>

<?php 
	if($_SESSION["id_jabatan"]== 1){
?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
<!--    	<li class="header">MENU</li>                   -->
          <li class="nav-item">
            <a href="?halaman=<?=md5('dash')?>" class="nav-link">
              <i class="fa fa-chart-line"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
		
          <li class="nav-item">
            <a href="?halaman=<?=md5('pengguna')?>" class="nav-link">
              <i class="fa fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>			

		</ul>
	 </section> 
<?php } 
	else if($_SESSION["id_jabatan"]== 2){
?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                
          <li class="nav-item">
            <a href="?halaman=<?=md5('reservoir')?>" class="nav-link">
              <i class="fa fa-flask"></i>
              <p>
                Reservoir
              </p>
            </a>
          </li>				
          <li class="nav-item">
            <a href="?halaman=<?=md5('retikulasi')?>" class="nav-link">
              <i class="fa fa-water"></i>
              <p>
                Pipa Retikulasi
              </p>
            </a>
          </li>	
          <li class="nav-item">
            <a href="?halaman=<?=md5('pdinas')?>" class="nav-link">
              <i class="fa fa-water"></i>
              <p>
                Pipa Dinas
              </p>
            </a>
          </li>	
          <li class="nav-item">
            <a href="?halaman=<?=md5('deteksi')?>" class="nav-link">
              <i class="fa fa-tint"></i>
              <p>
                Deteksi
              </p>
            </a>
          </li>	
          <li class="nav-item">
            <a href="?halaman=<?=md5('geografis')?>" class="nav-link">
              <i class="fa fa-globe"></i>
              <p>
                Geografis
              </p>
            </a>
          </li>	
		</ul>
	 </section>		
<?php } 
	else if($_SESSION["id_jabatan"]== 3){
?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                
          <li class="nav-item">
            <a href="?halaman=<?=md5('reservoir')?>" class="nav-link">
              <i class="fa fa-flask"></i>
              <p>
                Reservoir
              </p>
            </a>
          </li>				
          <li class="nav-item">
            <a href="?halaman=<?=md5('retikulasi')?>" class="nav-link">
              <i class="fa fa-water"></i>
              <p>
                Pipa Retikulasi
              </p>
            </a>
          </li>	
          <li class="nav-item">
            <a href="?halaman=<?=md5('pdinas')?>" class="nav-link">
              <i class="fa fa-water"></i>
              <p>
                Pipa Dinas
              </p>
            </a>
          </li>	
          <li class="nav-item">
            <a href="?halaman=<?=md5('deteksi')?>" class="nav-link">
              <i class="fa fa-tint"></i>
              <p>
                Deteksi
              </p>
            </a>
          </li>	
          <li class="nav-item">
            <a href="?halaman=<?=md5('pengguna')?>" class="nav-link">
              <i class="fa fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>				
		</ul>
	 </section>			
<?php }
else{
    echo "Anda tidak mempunyai hak untuk mengakses halaman ini";
}
?> 