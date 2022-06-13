<div class="content-wrapper">
  <h4>SOAL <small class="text-muted">/ Tambah Soal</small></h4>
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
                <input type="hidden" name="id" value="<?= $_GET['ID']; ?>">
                <div class="form-group">
                  <label for="ckeditor">Input Gambar <span class="text-danger">(Gambar Ukuran Rasio 1:1)</span></label>
                  <input type="file" name="gambar_soal" class="form-control">
                </div>
                <div class="form-group">
                  <label for="ckeditor">Soal</label>
                  <textarea name="soal" id="ckeditor"></textarea>
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
                        Yakin menambah data soal essay?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="objektifSaveEssay" class="btn btn-info">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="?page=ujian&act=soalessay&id=<?= $_GET['ID']; ?>" class="btn btn-danger">Batal</a>
                <?php include 'moudul/ujian/modalinput.php'; ?>













              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>