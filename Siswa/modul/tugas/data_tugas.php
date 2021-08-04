<div class="content-wrapper">
  <h4> <b>Tugas</b> <small class="text-muted">/Informasi Tugas</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="text-heading"> DAFTAR TUGAS </h4>
          <p></p>
          <hr>
          <form action="" method="POST">
            <div class="row">
              <div class="col-4">
                <select name="mapel" id="mapel" class="form-control" required>
                  <option value="">Pilih Mata Pelajaran</option>
                  <?php
                    $mapel  = mysqli_query($con, "SELECT * FROM tb_master_mapel");
                    foreach ($mapel as $key) { ?>
                      <option value="<?= $key['id_mapel']; ?>"><?= $key['mapel']; ?></option>
                    <?php }
                  ?>
                </select>
              </div>
              <div class="col-2">
                <button type="submit" class="btn btn-primary" name="filterMapel">Filter</button>
                <?php 
                  if (isset($_POST['filterMapel'])) {
                    echo "
                      <script type='text/javascript'>
                        window.location='?page=tugas&mapel=$_POST[mapel]';
                      </script>";
                  }
                ?>
              </div>
            </div>
          </form>
          <br>
          <div class="row">
            <?php 
              $no = 0;
              while ($d = mysqli_fetch_array($kelas)) {
                $no++;
                if ($d['aktif']=='N') {
                  echo '
                    <div class="alert alert-danger">
                      <b>Tidak ada Tugas Untuk Kelas Kamu !</b>
                    </div>';
                } else { 
                  // tampilkan dat ujian
                  // if ($_GET['mapel']) {
                    $ujian  = mysqli_query($con, "SELECT *,DATE_ADD(tanggal,INTERVAL waktu DAY)AS jatuh_tempo, DATEDIFF(DATE_ADD(tanggal,INTERVAL waktu DAY),CURDATE()) AS selisih FROM tb_tugas
                      INNER JOIN tb_jenistugas ON tb_tugas.id_jenistugas=tb_jenistugas.id_jenistugas
                      INNER JOIN tb_guru ON tb_tugas.id_guru=tb_guru.id_guru
                      INNER JOIN tb_master_mapel ON tb_tugas.id_mapel=tb_master_mapel.id_mapel
                      INNER JOIN tb_master_semester ON tb_tugas.id_semester=tb_master_semester.id_semester
                      WHERE tb_tugas.id_tugas='$d[id_tugas]' 
                      ORDER BY tb_tugas.id_tugas DESC 
                    ");
                    foreach ($ujian as $t) { ?>
                      <div class="col-md-6 col-xs-12"> 
                        <div class="alert alert-dark alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          TUGAS <strong><?=$t['mapel'] ?> </strong>
                          <p>
                            <p>
                              OLEH : <b><?=$t['nama_guru'] ?></b>
                            </p>
                            <table class="table table-striped">
                              <tr>
                                <th>Jenis Tugas</th>
                                <th>:</th>
                                <th> <?=$t['jenis_tugas'] ?></th>
                              </tr>
                              <tr>
                                <th>Batas Pengumpulan Tugas</th>
                                <th>:</th>
                                <th> <?= date('d-F-Y',strtotime($t['jatuh_tempo'])) ?></th>
                              </tr>
                              <tr>
                                <th>Sisa Waktu</th>
                                <th>:</th>
                                <th><?= $t['selisih'] > 0 ? $t['selisih'] . ' Hari Lagi' : 'Selesai'; ?></th>
                              </tr>
                            </table>
                          </p>
                          <hr>
                          <p>
                            <?php 
                              if ($t['selisih'] > 0) {
                                $cektugas = mysqli_query($con,"SELECT * FROM tugas_siswa 
                                  WHERE id_tugas  = '$d[id_tugas]' 
                                  AND id_siswa  = '$_SESSION[Siswa]' 
                                ");
                                $jml  = mysqli_num_rows($cektugas);
                                if ($jml < 1) {
                                  echo "<b class='badge badge-pill badge-danger'>Belum dikerjakan</b> "; ?>
                                  <p></p>
                                  <a href="?page=tugas&act=upload&tugas=<?php echo $t['id_tugas'];?>&id=<?php echo $t['id_jenistugas'];?>&jenis=<?php echo $t['jenis_tugas'];?>" class="btn btn-light"><i class="fa fa-pencil"></i> Kerjakan</a>
                                <?php } else {
                                  echo "<b class='badge badge-pill badge-success'>Sudah dikerjakan</b>";
                                }
                              }
                            ?>
                          </p>
                        </div>
                      </div> 
                    <?php }
                  // }
                }
              }
            ?>
                  
    


                
                      
              </div>

              <div class="row">
                
              </div>


            </div>
          </div>                  
    </div>
  </div>
</div>

