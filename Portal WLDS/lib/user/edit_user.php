<?php
	include'../../include/lib_inc.php';
    $edit      = $_GET["edit"];
	$us        = mysqli_query($conn,"SELECT NIP, nama_user, foto_user, email, no_telp, username, password, id_jabatan
									FROM t_user  WHERE NIP='$edit'");
	while($row = mysqli_fetch_array($us)){
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data User</h4>
        </div>

        <div class="modal-body">
        	<form action="../lib/user/update_user.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        		
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Modal Name">Nama</label> />
     				<input type="text" name="namaus"  class="form-control" value="<?=$row['nama_user']; ?>"/>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Modal Name">Foto Profil</label>
     				<input type="file" name="fotous" width="50%" >
                    <?php 
						if ($edit!=''){
							echo '<input type="text" name="fotous" value="'. $row['foto_user'] .'">';
						}
					?>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Modal Name">Email</label>
     				<input type="text" name="email"  class="form-control" value="<?=$row['email']; ?>"/>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Modal Name">No. Telepon</label>
     				<input type="text" name="notel"  class="form-control" value="<?=$row['no_telp']; ?>"/>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Modal Name">Username</label>
     				<input type="text" name="username"  class="form-control" value="<?=$row['username']; ?>"/>
                    <input type="hidden" name="password"  class="form-control" value="<?=$row['password']; ?>" />
                    <input type="hidden" name="tipeuser"  class="form-control" value="<?=$row['tipe_user']; ?>" />  
                </div>                
	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit">Simpan</button>
					<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Kembali</button>
	            </div>
            </form>
            <?php } ?>

        </div>           
    </div>
</div>