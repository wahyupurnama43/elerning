<?php
session_start();
include "../config/koneksi.php";
?>
<div class="content-wrapper">
  <h4>
    <b>MATERI PELAJARAN</b>
    <small class="text-muted">
      <b style="color: #00BCD4;"><?= $_SESSION['kelas']; ?></b>
    </small>
  </h4>
  <hr>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Daftar Materi Pelajaran</h4>
          <?php
          $sqlmtr = mysqli_query($con, "SELECT mapel FROM tb_materi
             INNER JOIN tb_roleguru ON tb_materi.id_roleguru = tb_roleguru.id_roleguru
             INNER JOIN tb_master_mapel ON tb_master_mapel.id_mapel = tb_roleguru.id_mapel
             WHERE tb_materi.public = 'Y'
           ");
          while ($mtr = mysqli_fetch_assoc($sqlmtr)) {
            $mapel[] = $mtr['mapel'];
          }
          $dataMapel = array_unique($mapel);
          ?>
          <div class="alert alert-danger" role="alert">
            Materi Tersedia Untuk Mata Pelajaran ( <strong><?php foreach ($dataMapel as $m) {
                                                              echo $m . ",";
                                                            } ?> </strong>)
          </div>
          <p class="card-description">
          <form action="" method="post">
            <div class="row">
              <div class="col-md-5">
                <select name="mapel" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                  <option value="SEMUA">- Pilih Mata Pelajaran -</option>
                  <?php
                  $jenis = mysqli_query($con, "SELECT * FROM tb_master_mapel");
                  foreach ($jenis as $j) {
                    if ($_POST['mapel'] == $j['id_mapel']) {
                      $selected = 'selected';
                    } else {
                      $selected = '';
                    }
                    echo "<option value='$j[id_mapel]' $selected>$j[mapel]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-5">
                <select name="semester" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                  <option value="SEMUA">- Pilih Semester -</option>
                  <?php $jenis = mysqli_query($con, "SELECT * FROM tb_master_semester ORDER BY id_semester ASC");
                  foreach ($jenis as $j) {
                    if ($_POST['semester'] == $j['id_semester']) {
                      $selected = 'selected';
                    } else {
                      $selected = '';
                    }
                    echo "<option value='$j[id_semester]' $selected>$j[semester]</option>";
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
          <?php
          if (isset($_POST['filter'])) {

            if ($_POST['mapel'] !== 'SEMUA') {
              $mapel_sql = " AND tb_roleguru.id_mapel  = '$_POST[mapel]' ";
            } else {
              $mapel_sql = '';
            }

            if ($_POST['semester'] !== 'SEMUA') {
              $semes_sql = " AND tb_roleguru.id_semester = '$_POST[semester]' ";
            } else {
              $semes_sql = '';
            }
            $sqlmtr = mysqli_query($con, "SELECT * FROM tb_materi
                INNER JOIN tb_roleguru ON tb_materi.id_roleguru=tb_roleguru.id_roleguru
                INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                WHERE tb_roleguru.id_kelas='$data[id_kelas]'
                AND tb_materi.public = 'Y'
                $mapel_sql
                $semes_sql
              "); ?>
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-hoverlight">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no     = 1;
                  $jml  = mysqli_num_rows($sqlmtr);
                  foreach ($sqlmtr as $row) { ?>
                    <tr style="border-top: 2px solid black;">
                      <td><b><?= $no++; ?>.</b></td>
                      <td><b><?= $row['mapel']; ?></b></td>
                      <td>
                        <a class="badge badge-pill badge-warning" data-toggle="modal" data-target="#<?= $row['id_materi']; ?>"> <em><?= $row['judul_materi']; ?></em></a>
                      </td>
                      <td><b><?= $row['semester']; ?></b></td>
                      <td>
                        <a data-toggle="modal" data-target="#<?= $row['id_materi']; ?>" class="btn btn-info btn-rounded btn-fw" style="color: #fff;"> <i class="fa fa-eye"></i>View</a>
                        <?php
                        if ($row['tipe_file'] == 'text') { ?>
                          <a href="../Report/materi/materi-words.php?ID=<?php echo $row['id_materi']; ?>" target="_blank" class="btn btn-light btn-rounded btn-fw text-info"><i class="fa fa-download"></i> Unduh.<?php echo $row['tipe_file']; ?> </a>
                        <?php } else { ?>
                          <a href="<?= $row['file']; ?>" target="_blank" class="btn btn-light btn-rounded btn-fw text-info"><i class="fa fa-download"></i> Unduh.<?php echo $row['tipe_file']; ?> </a>
                        <?php }
                        ?>

                        <!-- Modal Detail-->
                        <div class="modal fade bs-example-modal-lg" id="<?= $row['id_materi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header text-center>
                                  <h4 class=" modal-title">
                                MATERI PEMBELAJARAN
                                <br>
                                <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <b> <?= $row['judul_materi']; ?></b> | <?= $row['mapel']; ?> KELAS <?= $row['kelas']; ?>
                                </h4>
                                <hr>
                              </div>
                              <div class="modal-body" style="overflow:scroll;height:450px;">
                                <?php
                                if ($row['tipe_file'] == 'text') {
                                  echo "$row[materi]";
                                } else { ?>
                                  <br>
                                  <br>
                                  <div class="card">
                                    <div class="card-body">
                                      <center>
                                        <h1> <i class="fa fa-file-code-o"></i> </h1>
                                      </center>
                                      <table class="table">
                                        <thead>
                                          <tr>
                                            <td>
                                              <h4><b> Tipe File</b></h4>
                                            </td>
                                            <td>:</td>
                                            <td>
                                              <?php echo "<h4><b> <i class='fa fa-file-word-o'></i> $row[tipe_file] </b></h4> "; ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <h4><b> Ukuran File</b></h4>
                                            </td>
                                            <td>:</td>
                                            <td>
                                              <h4><b><?= $row['ukuran_file']; ?>.KB </b></h4>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" align="center"> <a href="<?= $row['file']; ?>" target="_blank" class="btn btn-danger btn-md text-white"><i class="fa fa-download"></i> Download</a></td>
                                          </tr>
                                        </thead>
                                      </table>
                                    </div>
                                  </div>
                                <?php }
                                ?>
                              </div>
                              <div class="modal-footer" style="float: left;">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php }
                  ?>
                  <tr style="background-color: #fff; font-weight: bold;height: 40px;border-top: 2px solid black;">
                    <td>Jumlah</td>
                    <td colspan="4">( <?= $jml; ?> )</td>
                  </tr>
                </tbody>
              </table>
            </div>
          <?php }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>