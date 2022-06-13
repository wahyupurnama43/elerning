<div class="content-wrapper">
  <h4> <b>Master</b> <small class="text-muted">/ Kelas</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-10">
      <div class="card">
        <div class="card-body">
          <p class="card-description">
            <a data-toggle="modal" data-target="#add" class="btn btn-info text-white pull-right"><i class="fa fa-plus"></i> Tambah Kelas</a> <br>
          </p>
          <h4 class="card-title">Data Kelas</h4>
          <div class="table-responsive">
            <?= $_GET['alert'] ? "<div class='alert alert-success' role='alert'>$_GET[alert]</div>" : ''; ?>
            <table class="table table-condensed table-striped table-hover" id="data">
              <thead class="bg-dark text-white">
                <tr>
                  <th class="text-center">No.</th>
                  <th class="text-center">Nama Kelas</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no   = 1;
                $sql  = mysqli_query($con, "SELECT * FROM tb_master_kelas ORDER BY id_kelas ASC");
                foreach ($sql as $d) { ?>
                  <tr>
                    <td class="text-center"><b><?= $no++; ?>.</b> </td>
                    <td class="text-center"><?= $d['kelas'] ?> </td>
                    <td class="text-center">
                      <a data-toggle="modal" data-target="#edit<?= $d['id_kelas'] ?>" class="btn btn-dark btn-xs text-warning"><i class="fa fa-pencil"></i> Edit</a>
                      <!-- modal edit -->
                      <div class="modal fade" id="edit<?= $d['id_kelas'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title"> Edit Kelas </h4>
                            </div>
                            <form action="" method="post">
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="kelas"> Nama Kelas</label>
                                  <input type="hidden" name="id" value="<?= $d['id_kelas'] ?>">
                                  <input type="text" id="kelas" name="kelas" class="form-control" value="<?= $d['kelas'] ?>" required>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button name="edit" type="submit" class="btn btn-info"> Simpan</button>
                              </div>
                            </form>
                            <?php
                            if (isset($_POST['edit'])) {
                              $qry  = mysqli_query($con, "UPDATE tb_master_kelas SET kelas = '$_POST[kelas]' WHERE id_kelas='$_POST[id]'");
                              if ($sql) {
                                echo "
                                        <script type='text/javascript'>
                                          setTimeout(function () {
                                            swal({
                                              title             : 'SUKSES',
                                              text              :  'KELAS BERHASIL DIUBAH',
                                              type              : 'success',
                                              timer             : 1000,
                                              showConfirmButton : false
                                            });     
                                          },10);  
                                          window.setTimeout(function(){ 
                                            window.location.replace('?page=kelas');
                                          } ,1000);   
                                        </script>";
                              }
                            }
                            ?>
                          </div>
                        </div>
                      </div>
          </div>

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus<?= $d['id_kelas'] ?>"><i class="fa fa-trash"></i> Hapus</button>

          <!-- Modal -->
          <div class="modal fade" id="hapus<?= $d['id_kelas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Anda yakin akan menghapus data kelas ini?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <a href="?page=kelas&act=del&id=<?= $d['id_kelas'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
<!-- Modal Detail-->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> Tambah Kelas </h4>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="kelas"> Nama Kelas</label>
            <input type="text" id="kelas" name="kelas" class="form-control" placeholder="Kelas" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button name="save" type="submit" class="btn btn-info"> Simpan</button>
        </div>
      </form>
      <?php
      if (isset($_POST['save'])) {
        $qry  = mysqli_query($con, "INSERT INTO tb_master_kelas VALUES(NULL,'$_POST[kelas]')");
        if ($sql) {
          echo "
                <script type='text/javascript'>
                  setTimeout(function () {
                    swal({
                      title : 'SUKSES',
                      text  :  'KELAS BERHASIL DISIMPAN',
                      type  : 'success',
                      timer : 1000,
                      showConfirmButton : false
                    });     
                  },10);  
                  window.setTimeout(function(){ 
                    window.location.replace('?page=kelas');
                  } ,1000);   
                </script>";
        }
      }
      ?>
    </div>
  </div>
</div>