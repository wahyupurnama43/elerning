<div class="content-wrapper">
  <h4>Mata Pelajaran <small class="text-muted">/ Tambah</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-6 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Mata Pelajaran</h4>
              <p class="card-description"></p>
              <hr>
              <form class="forms-sample" action="?page=proses" method="post">
                <input type="hidden" name="id_guru" value="<?=$data['id_guru']; ?>">
                <div class="form-group">
                  <label for="mapel">Mata Pelajaran</label>
                  <div class="input-group">
                    <select class="form-control" id="mapel" name="mapel"style="font-weight: bold;background-color: #212121;color: #fff;" onchange="pilihJadwal()" required>
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
                  <select class="form-control" id="kelas" name="kelas"style="font-weight: bold;background-color: #212121;color: #fff;" onchange="pilihJadwal()" required>
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
                  <label for="semester">Semester Mata Pelajaran</label>
                  <select class="form-control" id="semester" name="semester" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option value="">-- Pilih --</option>
                    <?php
                      $sqlSemester  = mysqli_query($con, "SELECT * FROM tb_master_semester ORDER BY id_semester DESC");
                      while($smt=mysqli_fetch_array($sqlSemester)){
                        echo "<option value='$smt[id_semester]'>$smt[semester]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="semester">Jadwal</label>
                  <select name="jadwal" id="jadwal" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;" required></select>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#exampleModal">Simpan</button>

                <!-- Modal -->
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
                        Apakah anda yakin akan menambah data ini?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="mapelSave" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>