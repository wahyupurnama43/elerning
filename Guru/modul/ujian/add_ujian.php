<div class="content-wrapper">
  <h4>Ulangan <small class="text-muted">/ Tambah</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-12 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Pengaturan Ulangan</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>
              <form class="forms-sample" action="?page=proses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_guru" value="<?=$sesi; ?>">
                <div class="form-group">
                  <label for="jenis">Kategori Ulangan *</label>
                  <select class="form-control" id="kategori" name="kategori" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option value=''>-- Pilih --</option>
                    <option value='pilgan'>Pilihan Ganda</option>
                    <option value='essay'>Essay</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="jenis">Jenis Ulangan *</label>
                  <select class="form-control" id="jenis" name="id_jenis" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option value=''>-- Pilih --</option>
                    <?php
                      $sqlJenis = mysqli_query($con, "SELECT * FROM tb_jenisujian ORDER BY id_jenis DESC");
                      while($jenis = mysqli_fetch_array($sqlJenis)){
                        echo "<option value='$jenis[id_jenis]'>$jenis[jenis_ujian]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="mapel">Mata Pelajaran *</label>
                  <select class="form-control" name="id_roleguru" onchange="cek_database()" id="id_roleguru" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option value=''>-- Pilih --</option>
                    <?php
                      $sqlMapel = mysqli_query($con, "SELECT * FROM tb_roleguru
                        INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                        INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                        INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                        WHERE tb_roleguru.id_guru='$sesi'
                      ");
                      while($mapel = mysqli_fetch_array($sqlMapel)){
                        echo "<option value='$mapel[id_roleguru]'>$mapel[mapel]- $mapel[kelas] - $mapel[semester]</option>";
                      }
                    ?>
                  </select>
                  <input type="hidden" name="id_kelas" id="id_kelas">
                  <input type="hidden" name="id_mapel" id="id_mapel">
                  <input type="hidden" name="id_semester" id="id_semester">
                </div>
                  <div class="form-group">
                  <label>Judul Ulangan *</label>
                  <input type="text" name="judul" class="form-control" placeholder="Judul Ulangan">
                </div>
                  <div class="form-group">
                  <label>Tanggal Ulangan *</label>
                  <input type="date" name="tgl" class="form-control" value="<?php echo date('Y-m-d') ?>">
                </div>
                <div class="form-group">
                  <label>Jam Mulai *</label>
                  <input type="time" name="jamMulai" class="form-control" placeholder='Masukan Jam Mulai Ujian' maxlength="2" required>
                </div>
                <div class="form-group">
                  <label>Jam Selesai *</label>
                  <input type="time" name="jam_selesai" class="form-control"placeholder='Masukan Jam Selesai Ujian' maxlength="2" required>
                </div>
                <div class="form-group">
                  <label>Jumlah Soal*</label>
                  <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Soal ..">
                </div>
                <div class="form-group">
                  <!-- <label for="mapel">Mata Pelajaran *</label> -->
                  <select class="form-control" name="acak" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option value="acak">Acak Soal</option>
                    <option value="tidak">Tidak Acak</option>
                  </select>
                </div>
                <div class="form-group">
                  <div class="form-radio form-radio-flat">
                    <label class="form-check-label" for="Y">
                      <input type="radio" class="form-check-input" name="aktif" id="Y" value="Y">
                      Aktif
                    </label>
                  </div>
                </div>
              <div class="form-group">
                <div class="form-radio form-radio-flat">
                  <label class="form-check-label" for="N">
                    <input type="radio" class="form-check-input" name="aktif" id="N" value="N">
                    Tidak
                  </label>
                </div>
              </div>
              <hr>
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
                      Anda yakin akan menambah data ulangan?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                      <button type="submit" name="ujianSave" class="btn btn-info">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
              <a href="?page=ujian" class="btn btn-danger">Batal</a>
            </form>
          </div>
				</div>
      </div>
    </div>
  </div>
</div>
</div>
