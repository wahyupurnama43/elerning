<?php
$edit = mysqli_query($con, "SELECT * FROM soal WHERE id_soal='$_GET[ids]' ");
foreach ($edit as $d) ?>
<div class="content-wrapper">
  <h4>SOAL <small class="text-muted">/ Edit Soal</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-10 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Soal</h4>
              <form class="forms-sample" action="?page=proses" method="post" enctype="multipart/form-data">

                <?php if (!empty($d['gambar']) || $d['gambar'] !== '') : ?>
                  <img src="../vendor/images/img_Soal/<?= $d['gambar'] ?>" alt="" width="200px" height="200px">
                  <br>
                  <br>
                <?php endif; ?>
                <input type="hidden" name="ids" value="<?= $_GET['ids']; ?>">
                <input type="hidden" name="id" value="<?= $_GET['ujian']; ?>">
                <div class="form-group">
                  <label for="ckeditor">Input Gambar <span class="text-danger">(Gambar Ukuran Rasio 1:1)</span></label>
                  <input type="file" name="gambar_soal" class="form-control">
                </div>
                <div class="form-group">
                  <label for="ckeditor">Soal</label>
                  <textarea name="soal" id="ckeditor"><?= $d['soal']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="p1">Pilihan A</label>
                  <div class="input-group">
                    <textarea name="p1" class="form-control"><?= $d['pilihan_1']; ?></textarea>
                    <div class="input-group-append bg-primary border-primary">
                      <a class="input-group-text bg-transparent" data-toggle="modal" data-target="#pilihanA"><i class="mdi mdi-menu text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="p2">Pilihan B</label>
                  <div class="input-group">
                    <textarea name="p2" class="form-control"><?= $d['pilihan_2']; ?></textarea>
                    <div class="input-group-append bg-primary border-primary">
                      <a class="input-group-text bg-transparent" data-toggle="modal" data-target="#pilihanB"><i class="mdi mdi-menu text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="p3">Pilihan C</label>
                  <div class="input-group">
                    <textarea name="p3" class="form-control"><?= $d['pilihan_3']; ?></textarea>
                    <div class="input-group-append bg-primary border-primary">
                      <a class="input-group-text bg-transparent" data-toggle="modal" data-target="#pilihanC"><i class="mdi mdi-menu text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="p4">Pilihan D</label>
                  <div class="input-group">
                    <textarea name="p4" class="form-control"><?= $d['pilihan_4']; ?></textarea>
                    <div class="input-group-append bg-primary border-primary">
                      <a class="input-group-text bg-transparent" data-toggle="modal" data-target="#pilihanD"><i class="mdi mdi-menu text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="p5">Pilihan E</label>
                  <div class="input-group">
                    <textarea name="p5" class="form-control"><?= $d['pilihan_5']; ?></textarea>
                    <div class="input-group-append bg-primary border-primary">
                      <a class="input-group-text bg-transparent" data-toggle="modal" data-target="#pilihanE"><i class="mdi mdi-menu text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Kunci Jawaban</label>
                  <select class="form-control" required name="kunci" style="font-weight: bold;background-color: #212121;color: #fff;">
                    <option value="1" <?= $d['kunci'] == '1' ? 'selected' : ''; ?>>A</option>
                    <option value="2" <?= $d['kunci'] == '2' ? 'selected' : ''; ?>>B</option>
                    <option value="3" <?= $d['kunci'] == '3' ? 'selected' : ''; ?>>C</option>
                    <option value="4" <?= $d['kunci'] == '4' ? 'selected' : ''; ?>>D</option>
                    <option value="5" <?= $d['kunci'] == '5' ? 'selected' : ''; ?>>E</option>
                  </select>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#modalKonfirmasi">Ubah</button>

                <!-- Modal -->
                <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Anda yakin akan mengedit data soal?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="objektifEdit" class="btn btn-info">Ubah</button>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>


                <?php include 'moudul/ujian/modalinput.php'; ?>













              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>