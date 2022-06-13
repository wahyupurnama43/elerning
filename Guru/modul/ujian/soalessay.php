<?php
$soal       = mysqli_query($con, "SELECT * FROM soal_essay WHERE id_ujian='$_GET[id]'");
$ujian      = mysqli_query($con, "SELECT * FROM ujian WHERE id_ujian='$_GET[id]'");
$data_ujian = mysqli_fetch_assoc($ujian);
$jumlah     = mysqli_num_rows($soal);
?>
<div class="content-wrapper">
  <h4><b>SOAL ESSAY</b><small class="text-muted">/Data Soal</small></h4>
  <div class="row purchace-popup">
    <div class="col-md-12">
      <span class="d-flex alifn-items-center">
        <?= $jumlah == $data_ujian['jml_soal'] ? '' : "<a href='?page=ujian&act=soaladdessay&ID=$_GET[id]' class='btn btn-dark'> <i class='fa fa-plus text-white'></i> Add Soal</a>"; ?>
        <a href="?page=ujian" class="btn btn-success">Kembali</a>
      </span>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Daftar Soal Essay</h4>
          <div class="table-responsive">
            <table class='table table-striped'>
              <thead>
                <tr>
                  <th width="10">No</th>
                  <th>Soal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $nomor  = 1;
                $tampil = mysqli_query($con, "SELECT * FROM soal_essay 
                  WHERE id_ujian='$_GET[id]' 
                  ORDER BY id_soal ASC
                ");
                while ($r = mysqli_fetch_array($tampil)) { ?>
                  <tr>
                    <td><?= $nomor++; ?> .</td>
                    <td><?= $r['soal']; ?></td>
                    <td>
                      <a href="?page=ujian&act=soaleditessay&ids=<?= $r['id_soal']; ?>&ujian=<?= $_GET['id']; ?>" class='btn btn-dark btn-sm'><i class='fa fa-pencil'></i></a>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-dark btn-sm text-danger" data-toggle="modal" data-target="#hapus<?= $r['id_soal']; ?>"><i class='fa fa-trash'></i></button>

                      <!-- Modal -->
                      <div class="modal fade" id="hapus<?= $r['id_soal']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Yakin hapus data soal essay ini?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="?page=ujian&act=soaldelessay&ids=<?= $r['id_soal']; ?>&id=<?= $_GET['id']; ?>" class='btn btn-dark text-danger'><i class='fa fa-trash'></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
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
</div>