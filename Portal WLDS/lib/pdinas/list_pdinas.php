<?php 
	if($_SESSION["id_jabatan"]== 2){
?>								
							<a href="#" onclick="confirm_modal('../lib/pdinas/reset_sensor.php?&del');" class="btn btn-danger" data-target="#ModalAdd" data-toggle="modal" style="float: right;" title="Hapus"><i class="fa fa-trash"></i> Reset</a>
							<pre>
                                <thead>
                                    <tr>
                                        <td align="center"><strong>No.</strong></td>
                                        <td align="center"><strong>Debit Pipa Dinas Awal</strong></td>
                                        <td align="center"><strong>Debit Pipa Dinas Akhir</strong></td>
                                        <td align="center"><strong>Waktu</strong></td>
                                        <td align="center"><strong>Tanggal</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
								$sql = "SELECT * FROM t_p_dinas ORDER BY id_pdinas DESC";	
								$query = mysqli_query($conn, $sql);								
								$no=1;
							 	while ($row = mysqli_fetch_array($query))						
								{
								?>
                                    <tr>
										<td align="center"><?=$no;?></td>
                                        <td align="center"><?=$row['debit_dinas_1']?> L/detik</td>
                                        <td align="center"><?=$row['debit_dinas_2']?> L/detik</td>
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
							<a href="../lib/pdinas/cetak_pdinas.php" class="btn btn-success"  style="float: left;"><i class="fa fa-print"></i> Cetak Data</a>
							<pre>
                                <thead>
                                    <tr>
                                        <td align="center"><strong>No.</strong></td>
                                        <td align="center"><strong>Debit Pipa Dinas Awal</strong></td>
                                        <td align="center"><strong>Debit Pipa Dinas Akhir</strong></td>
                                        <td align="center"><strong>Waktu</strong></td>
                                        <td align="center"><strong>Tanggal</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
								$sql = "SELECT * FROM t_p_dinas ORDER BY id_pdinas DESC";	
								$query = mysqli_query($conn, $sql);								
								$no=1;
							 	while ($row = mysqli_fetch_array($query))						
								{
								?>
                                    <tr>
										<td align="center"><?=$no;?></td>
                                        <td align="center"><?=$row['debit_dinas_1']?> L/detik</td>
                                        <td align="center"><?=$row['debit_dinas_2']?> L/detik</td>
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
else{
    echo "Anda tidak mempunyai hak untuk mengakses halaman ini";
}
?> 