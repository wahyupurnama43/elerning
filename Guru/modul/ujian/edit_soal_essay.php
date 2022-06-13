<?php
$edit = mysqli_query($con, "SELECT * FROM soal_essay WHERE id_soal='$_GET[ids]' ");
foreach ($edit as $d) ?>
<div class="content-wrapper">
  <h4>
    SOAL <small class="text-muted">/ Edit Soal</small>
  </h4>
  <hr>
  <div class="row">

    <div class="col-md-12 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Soal</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>
              <form class="forms-sample" action="?page=proses" method="post" enctype="multipart/form-data">
                <?php if (!empty($d['gambar'])) : ?>
                  <img src="../vendor/images/img_Soal/<?= $d['gambar'] ?>" alt="" width="200px" height="200px">
                  <br>
                  <br>
                <?php endif; ?>
                <input type="hidden" name="ids" value="<?= $_GET['ids']; ?>">
                <input type="hidden" name="id" value="<?= $_GET['ujian']; ?>">

                <div class="form-group">
                  <label for="ckeditor">Input Gambar <span class="text-danger">(Gambar Ukuran Rasio 1:1 )</span></label>
                  <input type="file" name="gambar_soal" class="form-control">
                </div>
                <div class="form-group">
                  <label for="ckeditor">Soal</label>
                  <textarea name="soal" id="ckeditor"><?= $d['soal']; ?></textarea>
                </div>

                <!-- <div class="form-group">
                  <label>Kunci Jawaban</label>
                  <input type="text" class="form-control" name="kunci" required id="kunci" placeholder="Kunci Jawaban" value="<?= $d['kunci']; ?>">
                </div> -->
                <button type="submit" name="objektifEditEssay" class="btn btn-info mr-2">Simpan</button>
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