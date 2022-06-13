<div class="content-wrapper">
  <h4>Tugas Siswa<small class="text-muted">/ Data Tugas</small></h4>
  <hr>
  <?php
  if (empty($role['id_guru'])) : ?>
    <div class="row purchace-popup">
      <div class="col-md-12">
        <span class="d-flex alifn-items-center">
          <p>Saat ini anda belum memilih jadwal, silahkan tambahkan jadwal.</p>
          <a href="?page=mapel&act=add" class="btn ml-auto purchase-button"> <i class="fa fa-plus"></i> Tambah Jadwal</a>
          <i class="mdi mdi-close popup-dismiss"></i>
        </span>
      </div>
    </div>
  <?php else : ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Data Tugas</h4>
            <p class="card-description">
            <form action="" method="post">
              <div class="row">
                <div class="col-md-5">
                  <select name="mapel" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                    <option value="SEMUA">- Pilih Mata Pelajaran -</option>
                    <option value="SEMUA">SEMUA</option>
                    <?php
                    $jenis  = mysqli_query($con, "SELECT * FROM tb_roleguru 
                        JOIN tb_master_mapel ON tb_roleguru.id_mapel = tb_master_mapel.id_mapel
                        WHERE tb_roleguru.id_guru = '$sesi'
                      ");
                    foreach ($jenis as $j) {
                      if ($_POST['mapel'] == $j['id_mapel']) {
                        $selected = 'selected';
                      } else {
                        $selected = '';
                      }
                      echo "<option value='$j[id_mapel]' $selected >$j[mapel]</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-5">
                  <select name="jenis_tugas" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                    <option value="SEMUA">- Pilih Jenis Tugas -</option>
                    <option value="SEMUA">SEMUA</option>
                    <?php
                    $perjenis = mysqli_query($con, "SELECT * FROM tb_jenistugas ORDER BY id_jenistugas ASC");
                    foreach ($perjenis as $jenis) :
                      if ($_POST['jenis_tugas'] == $jenis['jenis_tugas']) {
                        $selected = 'selected';
                      } else {
                        $selected = '';
                      }
                    ?>
                      <option value="<?= $jenis['jenis_tugas'] ?>" <?= $selected ?>><?= $jenis['jenis_tugas'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <button type="submit" name="filter" class="btn btn-info"><i class="fa fa-search"></i> Filter</button>
                </div>
              </div>
            </form>
            <hr>
            </p>
            <?php if ($_POST['mapel']) : ?>
              <table class="table" id="data">
                <thead>
                  <tr>
                    <th width="150">JENIS TUGAS</th>
                    <th>MATA PELAJARAN</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // tampilkan jenis tugas
                  if ($_POST['jenis_tugas'] == 'SEMUA' || $_POST['jenis_tugas'] == '') {
                    $tambahan = '';
                  } else {
                    $tambahan = "WHERE jenis_tugas = '" . $_POST['jenis_tugas'] . "'";
                  }

                  // tampil berdasarkan mapel
                  if ($_POST['mapel'] == 'SEMUA' || $_POST['mapel'] == '') {
                    $tambahan_mapel = '';
                  } else {
                    $tambahan_mapel = "AND tb_tugas.id_mapel = '" . $_POST['mapel'] . "'";
                  }

                  $perjenis = mysqli_query($con, "SELECT * FROM tb_jenistugas $tambahan ORDER BY id_jenistugas ASC");
                  foreach ($perjenis as $jt) { ?>

                    <tr>
                      <td><b><?php echo $jt['jenis_tugas']; ?></b></td>
                      <td>

                        <ul>
                          <?php
                          $no   = 1;
                          $sql  = mysqli_query($con, "SELECT * FROM tb_tugas
                            INNER JOIN tb_master_mapel ON tb_tugas.id_mapel=tb_master_mapel.id_mapel
                            INNER JOIN tb_master_semester ON tb_tugas.id_semester=tb_master_semester.id_semester
                            WHERE id_guru  = '$sesi' 
                            AND tb_tugas.id_jenistugas  = '$jt[id_jenistugas]' 
                            $tambahan_mapel
                            ORDER BY tb_tugas.id_semester ASC
                          ");
                          foreach ($sql as $d) { ?>
                            <li class="list-group-item">
                              <b><?= $d['mapel'] ?></b> | <?= $d['semester'] ?>
                              <ul>
                                <?php
                                // tampilkan kelas tugas
                                $kelasTugas = mysqli_query($con, "SELECT * FROM kelas_tugas
                                    INNER JOIN tb_master_kelas ON kelas_tugas.id_kelas=tb_master_kelas.id_kelas
                                    WHERE kelas_tugas.id_tugas='$d[id_tugas]'
                                  ");
                                foreach ($kelasTugas as $kt) { ?>
                                  <li style="margin: 7px;"><a href="?page=tugas&act=viewkelas&tugas=<?= $d['id_tugas'] ?>&kelas=<?= $kt['id_kelas'] ?>" class="badge badge-pill badge-info">KELAS <?php echo $kt['kelas']; ?></a></li>
                                <?php }
                                ?>
                              </ul>
                            </li>
                          <?php }
                          ?>
                        </ul>
                      </td>
                    </tr>
                  <?php }
                  ?>
                </tbody>
              </table>
            <?php endif; ?>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
</div>