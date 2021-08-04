<?php
  session_start();
  include "../config/koneksi.php";
?>
<div class="content-wrapper">
  <h4>
    <b>INFORMASI</b>
    <small class="text-muted">
      <b style="color: #00BCD4;"><?= $_SESSION['kelas']; ?></b>
    </small>
  </h4>
  <hr>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Daftar Informasi</h4>
          <div class="table-responsive">
            <table class="table table-condensed table-striped table-hoverlight" id="data">
              <thead>
                <tr>
                  <th class="text-center">No.</th>
                  <th class="text-center">Mata Pelajaran</th>
                  <th class="text-center">Nama Guru</th>
                  <th class="text-center">Hari</th>
                  <th class="text-center">Jam</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no     = 1;
                  $sqlmtr = mysqli_query($con,"SELECT * FROM tb_roleguru
                    INNER JOIN tb_guru ON tb_roleguru.id_guru = tb_guru.id_guru
                    INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel = tb_master_mapel.id_mapel
                    INNER JOIN jadwal ON tb_roleguru.jadwal_id = jadwal.id_jadwal
                  ");
                  $jml  = mysqli_num_rows($sqlmtr);
                  foreach ($sqlmtr as $row) { ?> 
                    <tr style="border-top: 2px solid black;">
                      <td class="text-center"><b><?=$no++; ?>.</b></td>
                      <td class="text-center"><b><?=$row['mapel']; ?></b></td>
                      <td class="text-center"><?=$row['nama_guru']; ?></td>
                      <td class="text-center"><?= $row['hari']; ?></td>
                      <td class="text-center"><?= $row['jam_mulai'] . ' - ' . $row['jam_selesai']; ?></td>
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
</div>