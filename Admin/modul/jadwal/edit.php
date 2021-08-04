<div class="content-wrapper">
  <h4>Jadwal <small class="text-muted">/ Edit</small></h4>
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
                <?php
                  $edit = mysqli_query($con, "SELECT * FROM jadwal 
                    WHERE id_jadwal = '$_GET[id]' 
                  ") or die(mysqli_error($con));
                  $d  = mysqli_fetch_array($edit);
                ?>
                <input type="hidden" name="id_guru" value="<?=$data['id_guru']; ?>">
                <div class="form-group">
                  <label for="mapel">Mata Pelajaran</label>
                  <div class="input-group">
                    <select class="form-control" id="mapel" name="mapel"style="font-weight: bold;background-color: #212121;color: #fff;" required>
                      <option value="">-- Pilih --</option>
                      <?php
                        $sqlMapel = mysqli_query($con, "SELECT * FROM tb_master_mapel ORDER BY id_mapel DESC");
                        while($mapel=mysqli_fetch_array($sqlMapel)){
                          $selected = $mapel['id_mapel'] == $d['mata_pelajaran_id'] ? 'selected' : '';
                          echo "<option value='$mapel[id_mapel]' $selected>$mapel[mapel]</option>";
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
                        $selected = $kelas['id_kelas'] == $d['kelas_id'] ? 'selected' : '';
                        echo "<option value='$kelas[id_kelas]' $selected>$kelas[kelas]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="semester">Hari</label>
                  <select name="hari" id="hari" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option value="">-- Pilih --</option>
                    <option value="senin" <?= $d['hari'] == 'senin' ? 'selected' : ''; ?>>Senin</option>
                    <option value="selasa" <?= $d['hari'] == 'selasa' ? 'selected' : ''; ?>>Selasa</option>
                    <option value="rabu" <?= $d['hari'] == 'rabu' ? 'selected' : ''; ?>>Rabu</option>
                    <option value="kamis" <?= $d['hari'] == 'kamis' ? 'selected' : ''; ?>>Kamis</option>
                    <option value="jumat" <?= $d['hari'] == 'jumat' ? 'selected' : ''; ?>>Jumat</option>
                    <option value="sabtu" <?= $d['hari'] == 'sabtu' ? 'selected' : ''; ?>>Sabtu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="semester">Jam Mulai</label>
                  <input type="time" class="form-control" name="jam_mulai" style="font-weight: bold;background-color: #212121;color: #fff;" value="<?= $d['jam_mulai']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="semester">Jam Selesai</label>
                  <input type="time" class="form-control" name="jam_selesai" style="font-weight: bold;background-color: #212121;color: #fff;" value="<?= $d['jam_selesai']; ?>" required>
                </div>
                <input type="hidden" name="status" value="<?= $status; ?>">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#modalKonfirmasi">Edit</button>

                <!-- Modal -->
                <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Anda yakin akan mengedit data jadwal ini?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                        <button type="submit" name="jadwalEdit" class="btn btn-info">Edit</button>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="?page=jadwal" class="btn btn-danger">Batal</a>
              </form>
              <?php 
                if (isset($_POST['jadwalEdit'])) {
                  $save = mysqli_query($con,"UPDATE JADWAL 
                    set mata_pelajaran_id = '$_POST[mapel]',
                        kelas_id          = '$_POST[kelas]',
                        hari              = '$_POST[hari]',
                        jam_mulai         = '$_POST[jam_mulai]',
                        jam_selesai       = '$_POST[jam_selesai]',
                        status            = '$_POST[status]'
                    WHERE id_jadwal       = '$_GET[id]'
                  ");
                  if ($save) {
                    echo "  
                    <script type='text/javascript'>
                      setTimeout(function () {
                        swal({
                          title             : 'Sukses',
                          text              : 'Jadwal berhasil diedit',
                          type              : 'success',
                          timer             : 3000,
                          showConfirmButton : true
                        });     
                      },10);  
                      window.setTimeout(function(){ 
                        window.location='?page=jadwal&alert=Data Berhasil diedit !';
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