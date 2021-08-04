<div class="content-wrapper">
  <h4>Materi <small class="text-muted">/ Tambah</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-10 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Materi Pembelajaran</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>
              <?php
                $sqlMapel = mysqli_query($con, "SELECT * FROM tb_roleguru
                  INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                  INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                  INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                  WHERE tb_roleguru.id_guru='$sesi'
                ");
                if (mysqli_num_rows($sqlMapel) > 0) { ?>
                  <form class="forms-sample" action="?page=proses" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_guru" value="<?=$sesi; ?>">
                    <div class="form-group">
                      <label for="mapel">Mata Pelajaran</label>
                      <select class="form-control" name="id_roleguru" onchange="cek_database()" id="id_roleguru" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                        <option value="">-- Pilih --</option>
                        <?php
                          while($mapel  = mysqli_fetch_array($sqlMapel)){
                            echo "<option value='$mapel[id_roleguru]'>$mapel[mapel] - $mapel[kelas]-$mapel[semester]</option>";
                          }
                        ?>
                      </select>
                      <input type="hidden" name="id_kelas" id="id_kelas">
                      <input type="hidden" name="id_mapel" id="id_mapel">
                      <input type="hidden" name="id_semester" id="id_semester">
                    </div>
                    <div class="form-group">
                      <label for="judul">Judul Materi</label>
                      <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul Materi .." required>
                    </div>
                    <?php 
                      if ($_GET['TYPE']=='Manual') { ?>
                        <!-- manual -->
                        <div class="form-group">
                          <label for="ckeditor">Materi</label>
                          <textarea name="materi" id="ckeditor" required></textarea>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#exampleModal">Simpan</button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tambah</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Apakah anda yakin akan menambah materi?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="materiSave" class="btn btn-info mr-2">Simpan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
                      <?php } else { ?>
                        <div class="form-group">
                          <label>File Perangkat</label>
                          <p>
                            File yang bisa di Upload hanya file dengan ekstensi .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .rar, .exe, .zip dan besar file (file size) maksimal hanya <b>2 MB</b>.
                          </p>
                          <input type="file" name="file" class="form-control" style="background-color: #212121;color: #fff;font-weight: bold;">
                        </div>
                        <hr>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#exampleModal">Simpan</button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tambah</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Apakah anda yakin akan menambah materi?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="materiFile" class="btn btn-info mr-2">Simpan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a href="?page=materi" class="btn btn-danger">Batal</a>
                      <?php }
                    ?>
                  </form>
                <?php } else { ?>
                  <div class="alert alert-warning">Anda belum mempunyai mata pelajaran, silahkan pilih terlebih dahulu <a href="?page=mapel&act=add" class="btn btn-primary">Disini</a></div>
                <?php }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

