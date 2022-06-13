<?php
$soal       = mysqli_query($con, "SELECT * FROM soal WHERE id_ujian='$_GET[id]'");
$ujian      = mysqli_query($con, "SELECT * FROM ujian WHERE id_ujian='$_GET[id]'");
$data_ujian = mysqli_fetch_assoc($ujian);
$jumlah     = mysqli_num_rows($soal);
?>
<div class="content-wrapper">
  <h4>
    <b>SOAL PILIHAN GANDA</b>
    <small class="text-muted">/
      Data Soal
    </small>
  </h4>
  <div class="row purchace-popup">
    <div class="col-md-12">
      <span class="d-flex alifn-items-center">
        <?= $jumlah == $data_ujian['jml_soal'] ? '' : '<a href="?page=ujian&act=soaladd&ID=' . $_GET["id"] . '" class="btn btn-dark" > <i class="fa fa-plus text-white"></i> Add Soal</a>'; ?>
        <a href="?page=ujian" class="btn btn-success">Kembali</a>
      </span>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Daftar Soal Pilihan Ganda</h4>
          <div class="table-responsive">
            <?= $_GET['alert'] ? '<div class="alert alert-success" role="alert">' . @$_GET['alert'] . '</div>' : ''; ?>
            <table class='table table-striped'>
              <thead>
                <tr>
                  <th width="10">No</th>
                  <th>Soal</th>
                  <th>Pilihan Ganda</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $nomor  = 1;
                $tampil = mysqli_query($con, "SELECT * FROM soal WHERE id_ujian='$_GET[id]' ORDER BY id_soal ASC");
                while ($r = mysqli_fetch_array($tampil)) { ?>
                  <tr>
                    <td><?= $nomor++; ?> .</td>
                    <td><b><?= $r['soal']; ?></b></td>
                    <td>
                      <ol type='A'>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                          $kolom  = "pilihan_$i";
                          if ($r['kunci'] == $i) {
                            echo "<li style='font-weight: bold'>$r[$kolom]</li>";
                          } else {
                            echo "<li>$r[$kolom]</li>";
                          }
                        }
                        ?>
                      </ol>
                    </td>
                    <td>
                      <a href="?page=ujian&act=soaledit&ids=<?= $r['id_soal']; ?>&ujian=<?= $_GET['id']; ?>" class='btn btn-dark btn-sm'><i class='fa fa-pencil'></i></a>

                      <!-- Button trigger modal -->
                      <button type="button" class='btn btn-dark btn-sm text-danger' data-toggle="modal" data-target="#exampleModal<?= $r['id_soal']; ?>"><i class='fa fa-trash'></i></button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal<?= $r['id_soal']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Anda yakin akan menghapus soal ini?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="?page=ujian&act=soaldel&ids=<?= $r['id_soal']; ?>&id=<?= $_GET['id']; ?>" class='btn btn-danger'><i class='fa fa-trash'></i>Hapus</a>
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

<!-- Modal uploa xls -->
<div class='modal modal-info fade' id="modal_upload">
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title'>Upload EXCEL</h4>
      </div>
      <form action="?page=ujian&act=upSoal" enctype="multipart/form-data" method="post">
        <input type="hidden" name="ujian" value="<?= $_GET['id']; ?>">
        <div class='modal-body'>
          <div class='form-group has-feedback'>
            <input type="file" class="file" id="file" name="excel" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <a href="../download/soal_template.xlsx" class="btn btn-success pull-left"><i class="fa fa-file-excel-o"></i> contoh excel</a>
          <button name="uploadSoal" type="submit" class="btn btn-primary btn-save"><i class="fa fa-upload"></i> Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>