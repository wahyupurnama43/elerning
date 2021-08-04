<div class="content-wrapper">
  <h4> <b>Tugas Siswa</b> <small class="text-muted">/</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Tugas</h4>
          <p class="card-description">
            <hr>
          </p>
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
                $perjenis = mysqli_query($con,"SELECT * FROM tb_jenistugas ORDER BY id_jenistugas ASC");
                foreach ($perjenis as $jt) { ?>
                  <tr>
                    <td><b><?php echo $jt['jenis_tugas']; ?></b></td>
                    <td>
                      <ul>
                        <?php 
                          $no   = 1;
                          $sql  = mysqli_query($con,"SELECT * FROM tb_tugas
                            INNER JOIN tb_master_mapel ON tb_tugas.id_mapel=tb_master_mapel.id_mapel
                            INNER JOIN tb_master_semester ON tb_tugas.id_semester=tb_master_semester.id_semester
                            INNER JOIN tb_roleguru ON tb_tugas.id_guru = tb_roleguru.id_guru
                            WHERE tb_roleguru.id_guru  = '$sesi' 
                            AND tb_tugas.id_jenistugas  = '$jt[id_jenistugas]' 
                            ORDER BY tb_tugas.id_semester ASC 
                          ");
                          foreach ($sql as $d) {?>
                            <li class="list-group-item">
                              <b><?=$d['mapel'] ?></b>   | <?=$d['semester'] ?>
                              <ul>
                                <?php 
                                  // tampilkan kelas tugas
                                  $kelasTugas = mysqli_query($con,"SELECT * FROM kelas_tugas
                                    INNER JOIN tb_master_kelas ON kelas_tugas.id_kelas=tb_master_kelas.id_kelas
                                    WHERE kelas_tugas.id_tugas='$d[id_tugas]'
                                  ");
                                  foreach ($kelasTugas as $kt) { ?>
                                    <li style="margin: 7px;"><a href="?page=tugas&act=viewkelas&tugas=<?=$d['id_tugas'] ?>&kelas=<?=$kt['id_kelas'] ?>" class="badge badge-pill badge-info">KELAS <?php echo $kt['kelas']; ?></a></li>           
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
        </div>
      </div>
    </div>
  </div>
</div>
