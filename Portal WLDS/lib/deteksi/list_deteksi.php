<?php 
	if($_SESSION["id_jabatan"]== 2){
?>							
							<a href="#" onclick="confirm_modal('../lib/deteksi/reset_deteksi.php?&del');" class="btn btn-danger" data-target="#ModalAdd" data-toggle="modal" style="float: right;" title="Hapus"><i class="fa fa-trash"></i> Reset</a>
							<pre>
                                <thead>
                                    <tr>
                                        <td align="center"><strong style="font-size: 12px;">No.</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Tekanan Air Reservoir</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Volume Air Reservoir</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Retikulasi Awal</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Retikulasi Akhir</strong></td>	
                                        <td align="center"><strong style="font-size: 12px;">Dinas Awal</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Dinas Akhir</strong></td>
										<td align="center"><strong style="font-size: 12px;">Lokasi</strong></td>
										<td align="center"><strong style="font-size: 12px;">Keterangan</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Waktu</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Tanggal</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
								$sql = "SELECT * FROM t_deteksi ORDER BY id_deteksi DESC";	
								$query = mysqli_query($conn, $sql);								
								$no=1;
							 	while ($row = mysqli_fetch_array($query))						
								{
								  $sqla = "SELECT * FROM t_reservoir WHERE id_res='$row[id_res]'";	
								  $querya = mysqli_query($conn, $sqla);
								  $rowa = mysqli_fetch_array($querya);
									
								  $sqlb = "SELECT * FROM t_p_retikulasi WHERE id_ret='$row[id_ret]'";
								  $queryb = mysqli_query($conn, $sqlb);
								  $rowb = mysqli_fetch_array($queryb);										
								  $sqlc = "SELECT * FROM t_p_dinas WHERE id_pdinas='$row[id_pdinas]'";	
								  $queryc = mysqli_query($conn, $sqlc);
								  $rowc = mysqli_fetch_array($queryc);									
								?>
                                    <tr>
										<td align="center"><?=$no;?></td>
                                        <td align="center"><?=$rowa['sens_tekanan']?> Psi</td>
                                        <td align="center"><?=$rowa['sens_ultrasonic']?> Liter</td>
                                        <td align="center"><?=$rowb['debit_retikulasi1']?> L/detik</td>
                                        <td align="center"><?=$rowb['debit_retikulasi2']?> L/detik</td>	
                                        <td align="center"><?=$rowc['debit_dinas_1']?> L/detik</td>
                                        <td align="center"><?=$rowc['debit_dinas_2']?> L/detik</td>		 
										<td align="center"><?=$row['latitude']?>,<?=$row['longitude']?></td>					
										<td align="center"><?=$row['keterangan']?></td>
                                        <td align="center"><?=$row['waktu']?></td>
										<td align="center"><?=$row['tanggal']?></td>
                                    </tr>
                                <?php $no++;
								}
//								$url =$_SERVER['REQUEST_URI'];
//								header ("Refresh: 5; URL=$url");
								?>
                                </tbody>
<?php }
	else if($_SESSION["id_jabatan"]== 3){
?>
<!--							<a href="../lib/deteksi/cetak_deteksi.php?filter=" class="btn btn-success"  style="float: right;"><i class="fa fa-print"></i> Cetak Seluruh Data</a>-->
<!--							<pre>-->
                                <thead>
                                    <tr>
                                        <td align="center"><strong style="font-size: 12px;">No.</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Tekanan Air Reservoir</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Volume Air Reservoir</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Retikulasi Awal</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Retikulasi Akhir</strong></td>	
                                        <td align="center"><strong style="font-size: 12px;">Dinas Awal</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Dinas Akhir</strong></td>
										<td align="center"><strong style="font-size: 12px;">Lokasi</strong></td>
										<td align="center"><strong style="font-size: 12px;">Keterangan</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Waktu</strong></td>
                                        <td align="center"><strong style="font-size: 12px;">Tanggal</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
								$sql = "SELECT * FROM t_deteksi ORDER BY id_deteksi DESC";	
								$query = mysqli_query($conn, $sql);	
								$no=1;	 
							 	while ($row = mysqli_fetch_array($query))						
								{
								  $sqla = "SELECT * FROM t_reservoir WHERE id_res='$row[id_res]'";	
								  $querya = mysqli_query($conn, $sqla);
								  $rowa = mysqli_fetch_array($querya);
									
								  $sqlb = "SELECT * FROM t_p_retikulasi WHERE id_ret='$row[id_ret]'";
								  $queryb = mysqli_query($conn, $sqlb);
								  $rowb = mysqli_fetch_array($queryb);										
								  $sqlc = "SELECT * FROM t_p_dinas WHERE id_pdinas='$row[id_pdinas]'";	
								  $queryc = mysqli_query($conn, $sqlc);
								  $rowc = mysqli_fetch_array($queryc);									
								?>
                                    <tr>
										<td align="center"><?=$no;?></td>
                                        <td align="center"><?=$rowa['sens_tekanan']?> Psi</td>
                                        <td align="center"><?=$rowa['sens_ultrasonic']?> Liter</td>
                                        <td align="center"><?=$rowb['debit_retikulasi1']?> L/detik</td>
                                        <td align="center"><?=$rowb['debit_retikulasi2']?> L/detik</td>	
                                        <td align="center"><?=$rowc['debit_dinas_1']?> L/detik</td>
                                        <td align="center"><?=$rowc['debit_dinas_2']?> L/detik</td>		 
										<td align="center"><?=$row['latitude']?>,<?=$row['longitude']?></td>					
										<td align="center"><?=$row['keterangan']?></td>
                                        <td align="center"><?=$row['waktu']?></td>
										<td align="center"><?=$row['tanggal']?></td>
                                    </tr>
                                <?php $no++;
								}
								?>
                                </tbody>							
<?php }
else{
    echo "Anda tidak mempunyai hak untuk mengakses halaman ini";
}
?> 