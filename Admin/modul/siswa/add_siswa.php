
<div class="content-wrapper">
  <h4> <b>User</b> <small class="text-muted">/ Tambah Siswa</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Tambah Siswa</h4>
              <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>NIS/NISN</label>
                  <input name="nis" type="text" class="form-control" placeholder="NIS/NISN" maxlength="15" onkeypress="return hanyaAngka(event)" required>
                </div>
                <div class="form-group">
                  <label>Nama Lengkap Siswa</label>
                  <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                  <div class="form-radio form-radio-flat">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="jk" id="lk" value="L" checked required>
                      Laki-laki
                    </label>
                  </div>
                </div>
                <div class="form-radio form-radio-flat">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jk" id="pr" value="P" required>
                    Perempuan
                  </label>
                </div>
                <div class="form-group">
                  <label for="kelas">Kelas Siswa</label>
                  <select class="form-control" required id="kelas" name="kelas">
                    <option value=''>-- Pilih --</option>
                    <?php
                      $sqlKelas = mysqli_query($con, "SELECT * FROM tb_master_kelas ORDER BY id_kelas DESC");
                      while($kelas=mysqli_fetch_array($sqlKelas)){
                        echo "<option value='$kelas[id_kelas]'>$kelas[kelas]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Foto</label>
                  <input name="foto" type="file" class="form-control" required>
                </div>
                <button name="saveGuru" type="submit" class="btn btn-success mr-2">Submit</button>
                <a href="?page=siswa" class="btn btn-light">Cancel</a>
              </form>
              <?php 
                if (isset($_POST['saveGuru'])) {
                  $pass         = sha1($_POST['nis']);
                  $sumber       = @$_FILES['foto']['tmp_name'];
                  $target       = '../vendor/images/img_Siswa/';
                  $nama_gambar  = @$_FILES['foto']['name'];
                  $pindah       = move_uploaded_file($sumber, $target.$nama_gambar);
                  $date         = date('Y-m-d');
                  if ($pindah) {
                    $save = mysqli_query($con,"INSERT INTO tb_siswa VALUES(NULL,'$_POST[nis]','$_POST[nama]','$_POST[jk]','$pass','off','Y','0','$nama_gambar','$_POST[kelas]','Yes')");
                    if ($save) {
                      echo " 
                        <script type='text/javascript'>
                          setTimeout(function () {
                            swal({
                              title             : 'Sukses',
                              text              : 'Data Berhasil ditambah',
                              type              : 'success',
                              timer             : 3000,
                              showConfirmButton : true
                            });     
                          },10);  
                          window.setTimeout(function(){ 
                            window.location='?page=siswa&alert=Data Berhasil disimpan!';
                          } ,3000);   
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
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
  }
  
  function goBack() {
    window.history.back();
  }
</script>