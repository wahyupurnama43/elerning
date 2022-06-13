<div class="content-wrapper">
  <h4> <b>Master</b> <small class="text-muted">/ Semester</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-10">
      <div class="card">
        <div class="card-body">
          <p class="card-description">
            <a data-toggle="modal" data-target="#add" class="btn btn-info text-white pull-right"><i class="fa fa-plus"></i> Tambah Semester</a> <br>
          </p>
          <h4 class="card-title">Data Semester</h4>
          <div class="table-responsive">
            <table class="table table-condensed table-striped table-hover" id="data">
              <thead class="bg-dark text-white">
                <tr>
                  <th class="text-center">No.</th>
                  <th class="text-center">Nama Semester</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no   = 1;
                $sql  = mysqli_query($con, "SELECT * FROM tb_master_semester ORDER BY id_semester ASC");
                foreach ($sql as $d) { ?>
                  <tr>
                    <td class="text-center"><b><?= $no++; ?>.</b> </td>
                    <td class="text-center"><?= $d['semester'] ?> </td>
                    <td class="text-center">
                      <a data-toggle="modal" data-target="#edit<?= $d['id_semester'] ?>" class="btn btn-dark btn-xs text-warning"><i class="fa fa-pencil"></i> Edit</a>

                      <!-- modal edit -->
                      <div class="modal fade" id="edit<?= $d['id_semester'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title"> Edit Semester </h4>
                            </div>
                            <form action="" method="post">
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="semester"> Nama Semester</label>
                                  <input type="hidden" name="id" value="<?= $d['id_semester'] ?>">
                                  <input type="text" id="semester" name="semester" class="form-control" value="<?= $d['semester'] ?>">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button name="edit" type="submit" class="btn btn-info"> Edit</button>
                              </div>
                            </form>
                            <?php
                            if (isset($_POST['edit'])) {
                              $qry = mysqli_query($con, "UPDATE tb_master_semester 
                                        SET semester  = '$_POST[semester]' 
                                        WHERE id_semester = '$_POST[id]' 
                                      ");
                              if ($sql) {
                                echo "
                                            <script type='text/javascript'>
                                              setTimeout(function () {
                                                swal({
                                                  title : 'SUKSES',
                                                  text  :  'SEMESTER BERHASIL DIUBAH',
                                                  type  : 'success',
                                                  showConfirmButton: false
                                                });     
                                              },10);  
                                              window.setTimeout(function(){ 
                                                window.location.replace('?page=semester');
                                              } ,1000);   
                                            </script>
                                          ";
                              }
                            }
                            ?>
                          </div>
                        </div>
                      </div>
          </div>

          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus<?= $d['id_semester'] ?>"><i class="fa fa-trash"></i> Hapus</button>

          <!-- Modal -->
          <div class="modal fade" id="hapus<?= $d['id_semester'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Apakah anda yakin akan menghapus semester ini?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <a href="?page=semester&act=del&id=<?= $d['id_semester'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                </div>
              </div>
            </div>
          </div>
          </td>
          </tr>
        <?php } ?>
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
        <h4 class="modal-title"> Tambah Semester </h4>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="semester"> Nama Semester</label>
            <input type="text" id="semester" name="semester" class="form-control" placeholder="Semester">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button name="save" type="submit" class="btn btn-info"> Simpan</button>
        </div>
      </form>
      <?php
      if (isset($_POST['save'])) {
        $qry = mysqli_query($con, "INSERT INTO tb_master_semester VALUES(NULL,'$_POST[semester]') ");
        if ($sql) {
          echo "
                        <script type='text/javascript'>
                        setTimeout(function () {
                        swal({
                        title: 'SUKSES',
                        text:  'SEMESTER BERHASIL DISIMPAN',
                        type: 'success',
                        timer: 1000,
                        showConfirmButton: false
                        });     
                        },10);  
                        window.setTimeout(function(){ 
                        window.location.replace('?page=semester');
                        } ,1000);   
                        </script>";
        }
      }

      ?>

    </div>
  </div>
</div>