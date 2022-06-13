<div class="content-wrapper">
  <h4><b>Ulangan</b><small class="text-muted">/Nilai</small>
    <hr>
    <?php
    if (empty($role['id_guru'])) { ?>
      <div class="row purchace-popup">
        <div class="col-md-12">
          <span class="d-flex alifn-items-center">
            <p>Saat ini anda belum memilih jadwal, silahkan tambahkan jadwal.</p>
            <a href="?page=mapel&act=add" class="btn ml-auto purchase-button"> <i class="fa fa-plus"></i> Tambah Jadwal</a>
            <i class="mdi mdi-close popup-dismiss"></i>
          </span>
        </div>
      </div>
    <?php } else { ?>
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Daftar Nilai</h4>
              <p class="card-description">
              <form action="" method="post">
                <div class="row">
                  <div class="col-md-5">
                    <select name="jenis" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                      <option value="">- Pilih Jenis Ulangan -</option>
                      <?php $jenis = mysqli_query($con, "SELECT * FROM tb_jenisujian ORDER BY id_jenis ASC");
                      foreach ($jenis as $j) {
                        echo "<option value='$j[id_jenis]'>$j[jenis_ujian]</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-5">
                    <select name="mapel" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                      <option value="">- Pilih Mata Pelajaran -</option>
                      <?php
                      $jenis  = mysqli_query($con, "SELECT * FROM tb_roleguru 
                        JOIN tb_master_mapel ON tb_roleguru.id_mapel = tb_master_mapel.id_mapel
                        WHERE tb_roleguru.id_guru = '$sesi'
                      ");
                      foreach ($jenis as $j) {
                        echo "<option value='$j[id_mapel]'>$j[mapel]</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <button type="submit" name="filter" class="btn btn-info"><i class="fa fa-search"></i> Filter</button>
                  </div>
                </div>
              </form>
              </p>
              <div class="table-responsive">
                <?php
                if (isset($_POST['filter'])) {
                  // TAMPILKAN DATA
                  if ($_POST['jenis'] == '' && $_POST['semester'] == '') {
                    echo "Tidak Ada data yg diplih";
                  } else { ?>
                    <table id='data' class='table table-bordered table-striped'>
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Jenis Ulangan</th>
                          <th class="text-center">Judul</th>
                          <th class="text-center">Mata Pelajaran</th>
                          <th class="text-center">Tanggal Ulangan</th>
                          <th class="text-center">Nilai Kelas</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no       = 1;
                        $sqlrole  = mysqli_query($con, "SELECT * FROM ujian
                          INNER JOIN tb_jenisujian ON ujian.id_jenis=tb_jenisujian.id_jenis
                          INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
                          WHERE ujian.id_guru = '$sesi' 
                          AND ujian.id_jenis  = '$_POST[jenis]' 
                          AND ujian.id_mapel = '$_POST[mapel]' 
                          ORDER BY id_ujian DESC
                        ");
                        foreach ($sqlrole as $row) { ?>
                          <tr>
                            <td class="text-center"><b><?= $no++ ?>.</b></td>
                            <td class="text-center"><label class="badge badge-info"><?= $row['jenis_ujian']; ?></label></td>
                            <td class="text-center"><?= $row['judul']; ?> </td>
                            <td class="text-center"><?= $row['mapel']; ?> </td>
                            <td class="text-center"><b><?= date('d-F-Y', strtotime($row['tanggal'])); ?></b></td>
                            <td>
                              <?php
                              $nokelas  = 1;
                              $nilai    = mysqli_query($con, "SELECT * FROM kelas_ujian
                                  INNER JOIN tb_master_kelas ON kelas_ujian.id_kelas=tb_master_kelas.id_kelas
                                  WHERE kelas_ujian.id_ujian='$row[id_ujian]'
                                ");
                              while ($l = mysqli_fetch_array($nilai)) {
                                $siswa    = mysqli_query($con, "SELECT * FROM tb_siswa WHERE id_kelas='$l[id_kelas]'");
                                $jmlsiswa = mysqli_num_rows($siswa); ?>
                                <b><?= $nokelas++; ?> .</b>
                                <a href="?page=nilai&act=view&ujian=<?= $l['id_ujian']; ?>&kelas=<?= $l['id_kelas']; ?>" class='btn btn-info text-white'><i class='fa fa-server'></i> <?php echo $l['kelas']; ?> (<?php echo $jmlsiswa; ?>)</a>
                                <br>
                                <br>
                              <?php }
                              ?>
                            </td>
                          </tr>
                        <?php }
                        ?>
                      </tbody>
                    </table>
              <?php }
                } else {
                }
              }
              ?>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>