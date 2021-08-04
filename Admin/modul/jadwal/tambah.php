<div class="content-wrapper">
  <h4>Jadwal <small class="text-muted">/ Tambah</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-6 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Jadwal</h4>
              <p class="card-description"></p>
              <hr>
              <form class="forms-sample" action="" method="post">
                <input type="hidden" name="id_guru" value="<?=$data['id_guru']; ?>">
                <div class="form-group">
                  <label for="mapel">Mata Pelajaran</label>
                  <div class="input-group">
                    <select class="form-control" id="mapel" name="mapel"style="font-weight: bold;background-color: #212121;color: #fff;" required>
                      <option value="">-- Pilih --</option>
                      <?php
                        $sqlMapel = mysqli_query($con, "SELECT * FROM tb_master_mapel ORDER BY id_mapel DESC");
                        while($mapel=mysqli_fetch_array($sqlMapel)){
                          echo "<option value='$mapel[id_mapel]'>$mapel[mapel]</option>";
                        }
                      ?>
                    </select>
                    <div class="input-group-append bg-success border-success"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="kelas">Kelas Mata Pelajaran</label>
                  <select class="form-control" id="kelas" name="kelas"style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option value="">-- Pilih --</option>
                    <?php
                      $sqlKelas = mysqli_query($con, "SELECT * FROM tb_master_kelas ORDER BY id_kelas DESC");
                      while($kelas=mysqli_fetch_array($sqlKelas)){
                        echo "<option value='$kelas[id_kelas]'>$kelas[kelas]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="semester">Hari</label>
                  <select name="hari" id="hari" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option value="">-- Pilih --</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                    <option value="sabtu">Sabtu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="semester">Jam Mulai</label>
                  <input type="time" class="form-control" name="jam_mulai" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                </div>
                <div class="form-group">
                  <label for="semester">Jam Selesai</label>
                  <input type="time" class="form-control" name="jam_selesai" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Simpan</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tambah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Apakah anda yakin akan menambahkan data jadwal ini?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="jadwalSave" class="btn btn-info">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="?page=jadwal" class="btn btn-danger">Batal</a>
              </form>
              <?php 
                if (isset($_POST['jadwalSave'])) {
                  $save = mysqli_query($con,"INSERT INTO jadwal 
                    VALUES(
                      NULL,
                      '$_POST[mapel]',
                      '$_POST[kelas]',
                      '$_POST[hari]',
                      '$_POST[jam_mulai]',
                      '$_POST[jam_selesai]',
                      'belum'
                    )
                  ");
                  echo " 
                    <script type='text/javascript'>
                      setTimeout(function () {
                        swal({
                          title             : 'Sukses',
                          text              : 'Jadwal berhasil ditambah',
                          type              : 'success',
                          timer             : 3000,
                          showConfirmButton : true
                        });     
                      },10);  
                      window.setTimeout(function(){ 
                        window.location='?page=jadwal&alert=Data Berhasil ditambah !';
                      } ,3000);   
                    </script>";
                }
              ?> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>