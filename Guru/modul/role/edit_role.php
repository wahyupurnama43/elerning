
<div class="content-wrapper">
  <h4>Mata Pelajaran <small class="text-muted">/ Ubah</small></h4>
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
                <?php
                  $edit = mysqli_query($con,"SELECT * FROM tb_roleguru WHERE id_roleguru='$_GET[ID]' ") or die(mysqli_error($con));
                  $d    = mysqli_fetch_array($edit);
                ?>
                <input type="hidden" name="ID" value="<?=$d['id_roleguru']; ?>">
                <div class="form-group">
                  <label for="mapel">Mata Pelajaran</label>
                  <select class="form-control" id="mapel" name="mapel"style="font-weight: bold;background-color: #212121;color: #fff;">
                    <?php
                      $sqlMapel = mysqli_query($con, "SELECT * FROM tb_master_mapel ORDER BY id_mapel ASC");
                      while($mapel=mysqli_fetch_array($sqlMapel)){
                        if($mapel['id_mapel'] == $d['id_mapel']){
                          $selected = "selected";
                        } else {
                          $selected = "";
                        }
                        echo "<option value='$mapel[id_mapel]' $selected>$mapel[mapel]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="kelas">Kelas Mata Pelajaran</label>
                  <select class="form-control" id="kelas" name="kelas"style="font-weight: bold;background-color: #212121;color: #fff;">
                    <?php
                      $sqlKelas = mysqli_query($con, "SELECT * FROM tb_master_kelas ORDER BY id_kelas DESC");
                      while($kelas=mysqli_fetch_array($sqlKelas)){
                        if($kelas['id_kelas'] == $d['id_kelas']){
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
                  <label for="semester">Semester Mata Pelajaran</label>
                  <select class="form-control" id="semester" name="semester"style="font-weight: bold;background-color: #212121;color: #fff;">
                    <?php
                      $sqlSemester  = mysqli_query($con, "SELECT * FROM tb_master_semester ORDER BY id_semester DESC");
                      while($smt=mysqli_fetch_array($sqlSemester)){
                        if($smt['id_semester'] == $d['id_semester']){
                          $selected = "selected";
                        } else {
                          $selected = "";
                        }
                        echo "<option value='$smt[id_semester]' $selected>$smt[semester]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="semester">Hari</label>
                  <select name="hari" id="hari" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                    <option value="senin" <?= $hari == 'senin' ? 'selected' : '' ; ?>>Senin</option>
                    <option value="selasa" <?= $hari == 'selasa' ? 'selected' : '' ; ?>>Selasa</option>
                    <option value="rabu" <?= $hari == 'rabu' ? 'selected' : '' ; ?>>Rabu</option>
                    <option value="kamis" <?= $hari == 'kamis' ? 'selected' : '' ; ?>>Kamis</option>
                    <option value="jumat" <?= $hari == 'jumat' ? 'selected' : '' ; ?>>Jumat</option>
                    <option value="sabtu" <?= $hari == 'sabtu' ? 'selected' : '' ; ?>>Sabtu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="semester">Jam</label>
                  <input type="time" class="form-control" name="jam" style="font-weight: bold;background-color: #212121;color: #fff;" <?= $d['jam']; ?>>
                </div>
                <button type="submit" name="mapelUpdate" class="btn btn-info mr-2">Update</button>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
