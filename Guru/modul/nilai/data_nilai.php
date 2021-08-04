<div class="content-wrapper">
  <h4><b>Ulangan</b><small class="text-muted">/Nilai</small>
  <br>
  <br>
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
                    <?php $jenis = mysqli_query($con,"SELECT * FROM tb_jenisujian ORDER BY id_jenis ASC"); 
                      foreach ($jenis as $j) {
                        echo "<option value='$j[id_jenis]'>$j[jenis_ujian]</option>"; 
                      }
                    ?> 
                  </select>
                </div>
                <div class="col-md-5">
                  <select name="mapel" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                    <option value="">- Pilih Mata Pelajaran -</option>
                    <?php $jenis = mysqli_query($con,"SELECT * FROM tb_master_mapel ORDER BY id_mapel ASC"); 
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
                if ($_POST['jenis']=='' && $_POST['semester']=='') {
                  echo "Tidak Ada data yg diplih";
                } else { ?>
                  <table id='data' class='table table-bordered table-striped'>
                    <thead>
                      <tr>
                        <th>No</th> 
                        <th>Jenis Ulangan</th>
                        <th>Judul</th>
                        <th>Mata Pelajaran</th>
                        <th>Tanggal Ulangan</th>
                        <th>NILAI KELAS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no       = 1;
                        $sqlrole  = mysqli_query($con,"SELECT * FROM ujian
                          INNER JOIN tb_jenisujian ON ujian.id_jenis=tb_jenisujian.id_jenis
                          INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
                          WHERE ujian.id_guru = '$sesi' 
                          AND ujian.id_jenis  = '$_POST[jenis]' 
                          AND ujian.id_mapel = '$_POST[mapel]' 
                          ORDER BY id_ujian DESC
                        ");
                        foreach ($sqlrole as $row) { ?>  
                          <tr>
                            <td><b><?=$no++ ?>.</b></td>
                            <td><label class="badge badge-info"><?=$row['jenis_ujian']; ?></label></td>
                            <td><?=$row['judul']; ?> </td>
                            <td><?=$row['mapel']; ?> </td>
                            <td><b><?=date('d-F-Y',strtotime($row['tanggal'])); ?></b></td>
                            <td>
                              <?php 
                                $nokelas  = 1;
                                $nilai    = mysqli_query($con, "SELECT * FROM kelas_ujian
                                  INNER JOIN tb_master_kelas ON kelas_ujian.id_kelas=tb_master_kelas.id_kelas
                                  WHERE kelas_ujian.id_ujian='$row[id_ujian]'
                                ");
                                while($l=mysqli_fetch_array($nilai)){                               
                                  $siswa    = mysqli_query($con, "SELECT * FROM tb_siswa WHERE id_kelas='$l[id_kelas]'");
                                  $jmlsiswa = mysqli_num_rows($siswa); ?>
                                  <b><?=$nokelas++;?> .</b> 
                                  <a href="?page=nilai&act=view&ujian=<?=$l['id_ujian']; ?>&kelas=<?=$l['id_kelas']; ?>" class='btn btn-info text-white'><i class='fa fa-server'></i> <?php echo $l['kelas']; ?> (<?php echo $jmlsiswa; ?>)</a> 
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
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
