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
              <form class="forms-sample" action="?page=proses" method="post">
                <input type="hidden" name="id" value="<?=$_GET['ID']; ?>">
                <div class="form-group">
                  <label for="ckeditor">Soal</label>
                  <textarea name="soal" id="ckeditor"></textarea>
                </div>
                <div class="form-group">
                  <label for="p1">Pilihan A</label>
                  <div class="input-group">                          
                  <textarea name="p1" class="form-control"></textarea>
                    <div class="input-group-append bg-primary border-primary">
                      <a class="input-group-text bg-transparent" data-toggle="modal" data-target="#pilihanA"><i class="mdi mdi-menu text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="p2">Pilihan B</label>
                  <div class="input-group">                          
                  <textarea name="p2" class="form-control"></textarea>
                    <div class="input-group-append bg-primary border-primary">
                      <a class="input-group-text bg-transparent" data-toggle="modal" data-target="#pilihanB"><i class="mdi mdi-menu text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="p3">Pilihan C</label>
                  <div class="input-group">                          
                  <textarea name="p3" class="form-control"></textarea>
                    <div class="input-group-append bg-primary border-primary">
                      <a class="input-group-text bg-transparent" data-toggle="modal" data-target="#pilihanC"><i class="mdi mdi-menu text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="p4">Pilihan D</label>
                  <div class="input-group">                          
                  <textarea name="p4" class="form-control"></textarea>
                    <div class="input-group-append bg-primary border-primary">
                      <a class="input-group-text bg-transparent" data-toggle="modal" data-target="#pilihanD"><i class="mdi mdi-menu text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="p5">Pilihan E</label>
                  <div class="input-group">                          
                  <textarea name="p5" class="form-control"></textarea>
                    <div class="input-group-append bg-primary border-primary">
                      <a class="input-group-text bg-transparent" data-toggle="modal" data-target="#pilihanE"><i class="mdi mdi-menu text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Kunci Jawaban</label>
                  <select class="form-control" required name="kunci" style="font-weight: bold;background-color: #212121;color: #fff;">
                    <option value=''>-- kunci jawaban --</option>
                    <option value="1">A</option>
                    <option value="2">B</option>
                    <option value="3">C</option>
                    <option value="4">D</option>
                    <option value="5">E</option>
                  </select>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#modalKonfirmasi">Tambah</button>

                <!-- Modal -->
                <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tambah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Anda yakin akan menambah data soal?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                        <button type="submit" name="objektifSave" class="btn btn-info">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
