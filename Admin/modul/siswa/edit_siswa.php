<?php
$edit = mysqli_query($con, "SELECT * FROM tb_siswa WHERE id_siswa='$_GET[id]' ");
foreach ($edit as $d)
?>
<div class="content-wrapper">
  <h4> <b>User</b> <small class="text-muted">/ Edit Siswa</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Edit Siswa</h4>
              <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>NIS</label>
                  <input name="nis" type="text" class="form-control" value="<?= $d['nis'] ?>" required>
                  <input type="hidden" name="ID" value="<?= $d['id_siswa'] ?>">
                </div>
                <div class="form-group">
                  <label>Nama Lengkap Siswa</label>
                  <input name="nama" type="text" class="form-control" value="<?= $d['nama_siswa'] ?>" required>
                </div>
                <div class="form-group">
                  <div class="form-radio form-radio-flat">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="jk" id="lk" value="L" <?php if ($d['jk'] == 'L') {
                                                                                                  echo "checked";
                                                                                                } ?>>
                      Laki-laki
                    </label>
                  </div>
                  <div class="form-radio form-radio-flat">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="jk" id="pr" value="P" <?php if ($d['jk'] == 'P') {
                                                                                                  echo "checked";
                                                                                                } ?>>
                      Perempuan
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="kelas">Kelas Siswa</label>
                  <select class="form-control" id="kelas" name="kelas" required>
                    <option>-- Pilih --</option>
                    <?php
                    $sqlKelas = mysqli_query($con, "SELECT * FROM tb_master_kelas ORDER BY id_kelas DESC");
                    while ($kelas = mysqli_fetch_array($sqlKelas)) {
                      if ($kelas['id_kelas'] == $d['id_kelas']) {
                        $selected = "selected";
                      } else {
                        $selected = "";
                      }
                      echo "<option value='$kelas[id_kelas]' $selected>$kelas[kelas]</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Reset Password</label>
                  <input name="password" type="password" class="form-control" placeholder="Password" value="<?= $d['nis']; ?>" disabled>
                </div>
                <div class="form-group">
                  <label>Foto</label>
                  <input name="foto" type="file" class="form-control">
                </div>
                <button name="updateSiswa" type="submit" class="btn btn-success mr-2">Simpan</button>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#exampleModal">
                  Reset Password
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="?page=siswa" class="btn btn-light">Batal</a>
              </form>
              <?php
              if (isset($_POST['updateSiswa'])) {
                $gambar = @$_FILES['foto']['name'];
                if (!empty($gambar)) {
                  move_uploaded_file($_FILES['foto']['tmp_name'], "../vendor/images/img_Siswa/$gambar");
                  $ganti  = mysqli_query($con, "UPDATE tb_siswa SET foto='$gambar' WHERE id_siswa='$_POST[ID]' ");
                }
                $updateSiswa  = mysqli_query($con, "UPDATE tb_siswa SET nama_siswa='$_POST[nama]',jk='$_POST[jk]',id_kelas='$_POST[kelas]' WHERE id_siswa='$_POST[ID]' ");
                if ($updateSiswa) {
                  echo " 
                      <script type='text/javascript'>
                        setTimeout(function () {
                          swal({
                            title : 'Sukses',
                            text  : 'AKUN BERHASIL DIUBAH',
                            type  : 'success',
                            timer : 1000,
                            showConfirmButton: false
                          });     
                        },10);  
                        window.setTimeout(function(){ 
                          window.location='?page=siswa';
                        } ,1000);   
                      </script>";
                }
              }

              if (isset($_POST['resetPassword'])) {
                $pass         = sha1($_POST['nis']);
                $updateSiswa  = mysqli_query($con, "UPDATE tb_siswa SET password='$pass' WHERE id_siswa='$_POST[ID]'");
                if ($updateSiswa) {
                  if ($updateSiswa) {
                    echo " 
                        <script type='text/javascript'>
                          setTimeout(function () {
                            swal({
                              title             : 'Sukses',
                              text              : 'PASSWORD BERHASIL DIUBAH',
                              type              : 'success',
                              timer             : 1000,
                              showConfirmButton: false
                            });     
                          },10);  
                          window.setTimeout(function(){ 
                            window.location='?page=siswa';
                          } ,1000);   
                        </script>";
                  }
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
<script>
  function goBack() {
    window.history.back();
  }
</script>