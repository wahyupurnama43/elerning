<?php 
  $edit = mysqli_query($con,"SELECT * FROM tb_guru WHERE id_guru='$_GET[id]' ");
  foreach ($edit as $d) ?>
    <div class="content-wrapper">
      <h4> <b>User</b> <small class="text-muted">/ Edit Guru</small></h4>
      <hr>
      <div class="row">
        <div class="col-md-6 d-flex align-items-stretch grid-margin">
          <div class="row flex-grow">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Edit Guru</h4>
                    <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>NIP</label>
                        <input type="hidden" name="ID" value="<?=$d['id_guru'] ?>">
                        <input name="nip" type="text" class="form-control" value="<?=$d['nik'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Nama Lengkap & Gelar</label>
                        <input name="nama" type="text" class="form-control" value="<?=$d['nama_guru'] ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Username</label>
                        <input name="username" type="text" class="form-control" value="<?=$d['username'] ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Reset Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password" value="<?= $d['nik']; ?>" disabled>
                      </div>
                      <div class="form-group">
                        <label>Foto</label>
                        <input name="foto" type="file" class="form-control">
                      </div>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#edit">Edit</button>

                      <!-- Modal -->
                      <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Edit</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Anda yakin akan mengedit guru?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <button name="updateGuru" type="submit" class="btn btn-success">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#resetPassword">
                        Reset Password
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="resetPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Reset Password</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Anda mereset password dari akun ini?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <button name="resetPassword" type="submit" class="btn btn-danger mr-2">Reset Password</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a href="?page=guru" class="btn btn-light">Batal</a>
                    </form>
                    <?php 
                      if (isset($_POST['updateGuru'])) {
                        $date   = date('Y-m-d');
                        $gambar = @$_FILES['foto']['name'];
                        if (!empty($gambar)) {
                          move_uploaded_file($_FILES['foto']['tmp_name'],"../vendor/images/img_Guru/$gambar");
                          $ganti = mysqli_query($con,"UPDATE tb_guru SET foto='$gambar' WHERE id_guru='$_POST[ID]' ");
                        } 
                        $edit = mysqli_query($con, "UPDATE tb_guru SET nama_guru='$_POST[nama]', username='$_POST[username]' WHERE id_guru='$_POST[ID]' ");
                        if ($edit) {
                          echo " 
                          <script type='text/javascript'>
                            setTimeout(function () {
                              swal({
                                title             : 'Sukses',
                                text              : 'AKUN BERHASIL DIUBAH',
                                type              : 'success',
                                timer             : 3000,
                                showConfirmButton : true
                              });     
                            },10);  
                            window.setTimeout(function(){ 
                              window.location='?page=guru&alert=Berhasil edit guru';
                            } ,3000);   
                          </script>";
                        }
                      }

                      if (isset($_POST['resetPassword'])) {
                        $pass         = sha1($_POST['nip']);
                        $editPassword = mysqli_query($con, "UPDATE tb_guru SET password='$pass' WHERE id_guru='$_POST[ID]' ");
                        if ($edit) {
                          echo " 
                          <script type='text/javascript'>
                            setTimeout(function () {
                              swal({
                                title             : 'Sukses',
                                text              : 'PASSWORD BERHASIL DIUBAH',
                                type              : 'success',
                                timer             : 3000,
                                showConfirmButton : true
                              });     
                            },10);  
                            window.setTimeout(function(){ 
                              window.location='?page=guru';
                            } ,3000);   
                          </script>";
                        }
                      }
                    ?> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
