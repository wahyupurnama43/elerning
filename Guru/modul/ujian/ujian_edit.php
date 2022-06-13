<?php
$edit = mysqli_query($con, "SELECT * FROM ujian WHERE id_ujian='$_GET[id]' ");
foreach ($edit as $d) ?>
<div class="content-wrapper">
  <h4>Ulangan <small class="text-muted">/ Edit</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-5 col-xs-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12 col-xs-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Pengaturan Ulangan</h4>
              <form class="forms-sample" action="?page=proses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $d['id_ujian']; ?>">
                <div class="form-group">
                  <label for="jenis">Kategori Ulangan *</label>
                  <select class="form-control" id="kategori" name="kategori" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option value=''>-- Pilih --</option>
                    <option value='pilgan' <?php if ($d['kategori'] == 'pilgan') {
                                              echo 'selected';
                                            } ?>>Pilihan Ganda</option>
                    <option value='essay' <?php if ($d['kategori'] == 'essay') {
                                            echo 'selected';
                                          } ?>>Essay</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="jenis">Jenis Ulangan *</label>
                  <select class="form-control" id="jenis" name="id_jenis" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option>-- Pilih --</option>
                    <?php
                    $sqlJenis = mysqli_query($con, "SELECT * FROM tb_jenisujian ORDER BY id_jenis DESC");
                    while ($jenis = mysqli_fetch_array($sqlJenis)) {
                      $selected = $jenis['id_jenis'] == $d['id_jenis'] ? "selected" : "";
                      echo "<option value='$jenis[id_jenis]' $selected>$jenis[jenis_ujian]</option>";
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
                          WHERE tb_roleguru.id_guru = '$sesi'
                        ");
                    while ($mapel = mysqli_fetch_array($sqlMapel)) {
                      $selected = $mapel['id_mapel'] == $d['id_mapel'] ? "selected" : "";
                      echo "<option value='$mapel[id_roleguru]' $selected>$mapel[mapel]- $mapel[kelas]- $mapel[semester]</option>";
                    }
                    ?>
                  </select>
                  <input type="hidden" name="id_kelas" id="id_kelas" value="<?= $d['id_kelas'] ?>">
                  <input type="hidden" name="id_mapel" id="id_mapel" value="<?= $d['id_mapel'] ?>">
                  <input type="hidden" name="id_semester" id="id_semester" value="<?= $d['id_semester'] ?>">
                </div>
                <div class="form-group">
                  <label>Judul Ulangan *</label>
                  <input type="text" name="judul" class="form-control" value="<?= $d['judul'] ?>">
                </div>
                <div class="form-group">
                  <label>Tanggal Ulangan *</label>
                  <input type="date" name="tgl" class="form-control" value="<?= $d['tanggal'] ?>">
                </div>
                <div class="form-group">
                  <label>Jam Mulai *</label>
                  <input type="time" name="jamMulai" class="form-control" placeholder='Masukan Jam Mulai Ulangan' maxlength="2" required value="<?= $d['jam_mulai'] ?>">
                </div>
                <div class="form-group">
                  <label>Jam Selesai *</label>
                  <input type="time" name="jam_selesai" class="form-control" placeholder='Masukan Jam Selesai Ujian' maxlength="2" required value="<?= $d['jam_selesai']; ?>">
                </div>
                <div class="form-group">
                  <label>Jumlah Soal*</label>
                  <input type="number" name="jumlah" class="form-control" value="<?= $d['jml_soal'] ?>" required>
                </div>
                <div class="form-group">
                  <select class="form-control" name="acak" style="font-weight: bold;background-color: #212121;color: #fff;" required>
                    <option value="">--pilih tipe soal--</option>
                    <option value="acak" <?php if ($d['acak'] == 'acak') {
                                            echo 'selected';
                                          } ?>>Acak Soal</option>
                    <option value="tidak" <?php if ($d['acak'] == 'tidak') {
                                            echo 'selected';
                                          } ?>>Tidak Acak</option>
                  </select>
                </div>
                <hr>
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
                        Anda yakin akan mengubah data ulangan?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="ujianEdit" class="btn btn-info">Ubah</button>
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