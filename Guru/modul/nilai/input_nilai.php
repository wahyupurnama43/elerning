<div class="content-wrapper">
  <h4><b>Ulangan</b><small class="text-muted"> / Nilai</small>
  <hr>
<div class="row purchace-popup">
    <div class="col-md-12 col-xs-12">
      <span class="d-flex alifn-items-center">
        <a href="?page=nilai&act=view&ujian=<?= $_GET['ujian']; ?>&kelas=<?= $_GET['kelas']; ?>" class="btn btn-success"><i class="fa fa-plus"></i> Kembali</a>
        </span>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Input Nilai</h4>
          <div class="table-responsive">
            <table id='data' class='table table-bordered table-striped'>
              <thead>
                <tr>
                  <th class="text-center">No</th> 
                  <th class="text-center">Soal</th>
                  <th class="text-center">Jawaban</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no       = 1;
                  $sqlrole  = mysqli_query($con,"SELECT * FROM nilai
                    WHERE id_siswa  = '$_GET[id_siswa]' 
                    AND id_ujian  = '$_GET[id_ujian]'
                  ");
                  foreach ($sqlrole as $row) { 
                    $soal     = explode(',', $row['acak_soal']);
                    $jawaban  = explode(',', $row['jawaban']);
                    if ($row['status']) $status   = explode(',', $row['status']);
                    for ($i=0; $i < count($soal); $i++) { 
                      $soal_essay = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM soal_essay
                        WHERE id_soal = '$soal[$i]'
                      ")); ?>
                      <tr>
                        <td class="text-center"><b><?=$no++ ?>.</b></td>
                        <td class="text-center"><?= $soal_essay['soal']; ?></td>
                        <td class="text-center"><?= $jawaban[$i]; ?></td>
                        <td class="text-center"><?= $row['status'] ? $status[$i] : ''; ?></td>
                        <td class="text-center">
                          <a href="?page=edit_nilai&id_siswa=<?= $_GET['id_siswa']; ?>&id_ujian=<?= $_GET['id_ujian']; ?>&index=<?= $i; ?>&status=benar" class="btn btn-success">Benar</a>
                          <a href="?page=edit_nilai&id_siswa=<?= $_GET['id_siswa']; ?>&id_ujian=<?= $_GET['id_ujian']; ?>&index=<?= $i; ?>&status=salah" class="btn btn-danger">Salah</a>
                        </td>
                      </tr>
                    <?php }
                  } 
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
