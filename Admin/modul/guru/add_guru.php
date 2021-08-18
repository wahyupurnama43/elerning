<div class="content-wrapper">
  <h4> <b>User</b> <small class="text-muted">/ Tambah Guru</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-6 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Tambah Guru</h4>
              <p class="card-description"></p>
              <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>NIP</label>
                  <input name="nip" type="text" class="form-control" placeholder="Nomor Induk Pegawai" required>
                </div>
                <div class="form-group">
                  <label>Nama Lengkap & Gelar</label>
                  <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input name="username" type="text" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <label>Foto</label>
                  <input name="foto" type="file" class="form-control" required>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modalKonfirmasi">Tambah</button>

                <!-- Modal -->
                <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi tambah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Anda yakin akan menambah guru?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> 
                        <button name="saveGuru" type="submit" class="btn btn-success mr-2">Tambah</button>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="?page=guru" class="btn btn-light">Batal</a>
              </form>
              <?php 
                if (isset($_POST['saveGuru'])) {
                  $pass         = sha1($_POST['nip']);
                  $sumber       = @$_FILES['foto']['tmp_name'];
                  $target       = '../vendor/images/img_Guru/';
                  $nama_gambar  = @$_FILES['foto']['name'];
                  $pindah       = move_uploaded_file($sumber, $target.$nama_gambar);
                  $date         = date('Y-m-d');
                  if ($pindah) {
                    $save = mysqli_query($con, "INSERT INTO tb_guru VALUES(
                      NULL,
                      '$_POST[nip]',
                      '$_POST[nama]',
                      '$_POST[username]',
                      '$pass',
                      '$nama_gambar',
                      'Y',
                      '$date',
                      'Yes')
                    ");
                    if ($save) {
                      echo " 
                      <script type='text/javascript'>
                        setTimeout(function () {
                          swal({
                            title             : 'Sukses',
                            text              : 'AKUN BERHASIL DISIMPAN',
                            type              : 'success',
                            timer             : 3000,
                            showConfirmButton : true
                          });     
                        },10);  
                        window.setTimeout(function(){ 
                          window.location='?page=guru&alert=Data berhasil ditambah !';
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