<div class="content-wrapper">
  <h4>Tugas <small class="text-muted">/ Tambah</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-10 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Input Tugas</h4>
              <p class="card-description">
                <!-- Basic form layout -->
              </p>
              <form class="forms-sample" action="?page=proses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_guru" value="<?=$sesi; ?>">
                <div class="form-group">
                  <label for="jenis">Jenis Tugas *</label>
                  <select class="form-control" id="jenis" name="id_jenis" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option>-- Pilih --</option>
                    <?php
                      $sqlJenis = mysqli_query($con, "SELECT * FROM tb_jenistugas ORDER BY id_jenistugas DESC");
                      while($jenis=mysqli_fetch_array($sqlJenis)){
                        echo "<option value='$jenis[id_jenistugas]'>$jenis[jenis_tugas]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="mapel">Mata Pelajaran *</label>
                  <select class="form-control" name="id_roleguru" onchange="cek_database()" id="id_roleguru" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option>-- Pilih --</option>
                    <?php
                      $sqlMapel = mysqli_query($con, "SELECT * FROM tb_roleguru
                        INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                        INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                        INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                        WHERE tb_roleguru.id_guru='$sesi'");
                      while($mapel=mysqli_fetch_array($sqlMapel)){
                        echo "<option value='$mapel[id_roleguru]'>$mapel[mapel]- $mapel[kelas] - $mapel[semester]</option>";
                      }
                    ?>
                  </select>
                  <input type="hidden" name="id_mapel" id="id_mapel">
                  <input type="hidden" name="id_semester" id="id_semester">
                </div>
                <div class="form-group">
                  <label>Judul Tugas</label>
                  <input type="text" name="judul" class="form-control" placeholder="Judul Tugas">
                </div>
                <div class="form-group">
                  <label>Tanggal Tugas</label>
                  <input type="date" name="tgl" class="form-control" value="<?php echo date('Y-m-d') ?>">
                </div>
                <div class="form-group">
                  <label>Waktu</label>
                  <p class="text-danger">Jangka waktu untuk pengerjaan tugas. Contoh: Masukkan angka (<b>3</b>) untuk <b>3 Hari</b></p>
                  <input type="number" name="waktu" class="form-control"placeholder='(1) Hari'maxlength="2" required style="width: 300px;" min="0">
                </div>
                <div class="form-group">
                  <label>Jumlah Anggota</label>
                  <p class="text-success">Isi jumlah anggota jika tugas ini berkelompok, kosongkan jika tidak.</p>
                  <input type="number" name="jumlahanggota" class="form-control" maxlength="2" style="width: 300px;background: #212121;color: #fff;font-weight: bold;" min="0">
                </div>
                <div class="form-group">
                  <label>Intruksi Tugas</label>
                  <textarea name="isi_tugas" class="form-control" id="ckeditor" cols="30" rows="10"></textarea>
                </div>
                <hr>
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
                        Apakah anda yakin akan menambahkan tugas?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tugasSave" class="btn btn-info">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="?page=tugas" class="btn btn-danger">Batal</a>
              </form>

         
                
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
