<?php 
	if($_SESSION["id_jabatan"]== 1){
?>
							<a href="#" class="btn btn-info" data-target="#ModalAdd" data-toggle="modal" style="float: right;"><i class="fa fa-plus"></i> Tambah Data</a>
							<pre>
<!--							<table id="dataTables-example1" class="table table-bordered table-striped">-->
                                <thead>
                                    <tr>
                                        <td align="center"><strong>No.</strong></td>
                                        <td align="center"><strong>NAMA</strong></td>
                                        <td align="center"><strong>FOTO</strong></td>
                                        <td align="center"><strong>EMAIL</strong></td>
                                        <td align="center"><strong>TELP</strong></td>
                                        <td align="center"><strong>JABATAN</strong></td>
                                        <td align="center"><strong><i class="fa fa-cog"></i></strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
								$sql = "SELECT * FROM t_user";										
								$query = mysqli_query($conn, $sql);								
								$no=1;
							 	while ($row = mysqli_fetch_array($query))						
								{
									$sqla = "SELECT * FROM t_jabatan WHERE id_jabatan='$row[id_jabatan]'";										
									$querya = mysqli_query($conn, $sqla);	
									$rowa = mysqli_fetch_array($querya);
								?>
                                    <tr>
										<td align="center"><?=$no;?></td>
                                        <td align="center"><?=$row['nama_user']?></td>
                                        <td align="center"><img src="dist/img/user/<?=$row['foto_user']?>" style="width:50px; height:40px;"></td>
                                        <td align="center"><?=$row['email']?></td>
                                        <td align="center"><?=$row['no_telp']?></td>
                                        <td align="center"><?=$rowa['nama_jabatan']?></td>                                        
                                        <td align="center">
										<a href="#" class="open_modal" id="<?=$row['NIP'];?>"><button type="button" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-pencil-alt"></i></button></a>
                                        <a href="#" onclick="confirm_modal('../lib/user/delete_user.php?&del=<?= md5($row['NIP']);?>');"><button type="button" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></button></a></td>
                                    </tr>
                                <?php $no++;
								}?>
                                </tbody>
<?php }
	else if($_SESSION["id_jabatan"]== 3){
?>
							<a href="../lib/user/cetak_user.php" class="btn btn-success" style="float: left;"><i class="fa fa-print"></i> Cetak Data</a>
							<pre>
<!--							<table id="dataTables-example1" class="table table-bordered table-striped">-->
                                <thead>
                                    <tr>
                                        <td align="center"><strong>No.</strong></td>
                                        <td align="center"><strong>NAMA</strong></td>
                                        <td align="center"><strong>FOTO</strong></td>
                                        <td align="center"><strong>EMAIL</strong></td>
                                        <td align="center"><strong>TELP</strong></td>
                                        <td align="center"><strong>JABATAN</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
								$sql = "SELECT * FROM t_user";										
								$query = mysqli_query($conn, $sql);								
								$no=1;
							 	while ($row = mysqli_fetch_array($query))						
								{
									$sqla = "SELECT * FROM t_jabatan WHERE id_jabatan='$row[id_jabatan]'";										
									$querya = mysqli_query($conn, $sqla);	
									$rowa = mysqli_fetch_array($querya);
								?>
                                    <tr>
										<td align="center"><?=$no;?></td>
                                        <td align="center"><?=$row['nama_user']?></td>
                                        <td align="center"><img src="dist/img/user/<?=$row['foto_user']?>" style="width:50px; height:40px;"></td>
                                        <td align="center"><?=$row['email']?></td>
                                        <td align="center"><?=$row['no_telp']?></td>
                                        <td align="center"><?=$rowa['nama_jabatan']?></td> 
                                    </tr>
                                <?php $no++;
								}?>
                                </tbody>
<?php }
else{
    echo "Anda tidak mempunyai hak untuk mengakses halaman ini";
}
?> 
