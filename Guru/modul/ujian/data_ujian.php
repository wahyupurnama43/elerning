<div class="content-wrapper">
  <h4>
    <b>Ulangan</b><small class="text-muted">/UJIAN</small>
  </h4>
  <div class="row purchace-popup">
    <div class="col-md-12 col-xs-12">
      <span class="d-flex alifn-items-center">
        <a class="btn btn-dark" href="?page=ujian&act=add"> <i class="fa fa-plus"></i> Tambah Ulangan</a>
      </span>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Petunjuk Langkah</strong> <br> 
        <ul>
          <li> Klik <b>Tambah Ulangan</b> untuk menambahkan ulangan.</li>
          <li> Klik <b>Pilih Kelas Ulangan</b> untuk menambahkan kelas yang akan ulangan.</li>
          <li> Klik <b>Pilih Status Ulangan</b> untuk Membuka dan Menutup ulangan</li>
          <li> Ulangan akan aktif di halaman Siswa, apabila anda telah mengatur <b>tanggal dan jam</b> pada ulangan tersebut dilaksanakan dan juga status ulangan telah <b>Aktif</b></li>
          <li>Untuk memantau siswa yang sedang mengikuti ulangan, anda bisa memilih tombol berwarna kuning pada kolom status langan</li>
        </ul>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Ulangan</h4>
          <p class="card-description"></p>
          <?= $_GET['alert'] ? '<div class="alert alert-success" role="alert">'.@$_GET['alert'].'</div>' : ''; ?>
          <div class="table-responsive">
            <table class="table table-striped table-hover table-condensed" id="data">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Mata Pelajaran</th>
                  <th>Kategori Soal</th>
                  <!-- <th>Jenis Soal</th> -->
                  <th>Type Soal</th>
                  <th>Tgl Ulangan</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
                  <th>Soal</th>
                  <th>Status Ulangan</th>
                  <th>Pilih Kelas Ulangan</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no       = 1;
                  $sqlrole  = mysqli_query($con,"SELECT * FROM ujian
                    INNER JOIN tb_jenisujian ON ujian.id_jenis=tb_jenisujian.id_jenis
                    INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
                    INNER JOIN tb_master_semester ON ujian.id_semester=tb_master_semester.id_semester
                    INNER JOIN tb_roleguru ON ujian.id_mapel = tb_roleguru.id_mapel
                    WHERE tb_roleguru.id_guru  = '$sesi'
                    ORDER BY id_ujian DESC");
                  foreach ($sqlrole as $row) { ?>       
                  <tr>
                    <td><?=$no++; ?>.</td>
                    <td><?=$row['mapel']; ?> </td>
                    <?php if($row['kategori'] == 'pilgan') { ?>
                      <td>
                        <a href="?page=ujian&act=soal&id=<?=$row['id_ujian']; ?>">
                          <b class="text-primary"><?= $row['kategori'] == 'pilgan' ? 'Pilihan Ganda' : 'Essay' ?></b>
                        </a>
                      </td>
                    <?php } else { ?>
                      <td>
                        <a href="?page=ujian&act=soalessay&id=<?=$row['id_ujian']; ?>">
                          <b class="text-primary"><?= $row['kategori'] == 'pilgan' ? 'Pilihan Ganda' : 'Essay' ?></b>
                        </a>
                      </td>
                    <?php } ?>
                    <td><?=$row['acak']; ?></td>
                    <td><b><?=date('d-F-Y',strtotime($row['tanggal'])); ?></b></td>
                    <td><?= $row['jam_mulai']; ?></td>
                    <td><?= $row['jam_selesai']; ?></td>
                    <td> 
                      <?php 
                        if($row['kategori'] == 'pilgan') {
                          $jmlSoal = mysqli_num_rows(mysqli_query($con,"SELECT * FROM soal WHERE id_ujian='$row[id_ujian]' ")) ?>
                          <a href="?page=ujian&act=soal&id=<?=$row['id_ujian']; ?>" class="btn btn-primary btn-sm text-white">Buat Soal  ( <b><?=$jmlSoal; ?></b> )</a>
                      <?php } else {
                        $jmlSoal = mysqli_num_rows(mysqli_query($con,"SELECT * FROM soal_essay WHERE id_ujian='$row[id_ujian]' ")) ?>
                        <a href="?page=ujian&act=soalessay&id=<?=$row['id_ujian']; ?>" class="btn btn-primary btn-sm text-white">Buat Soal  ( <b><?=$jmlSoal; ?></b> )</a>
                      <?php } ?>
                    </td>
                    <td>
                      <!-- cek ujian ini di kelas ujian -->
                      <?php 
                        $klsu = mysqli_query($con,"SELECT * FROM kelas_ujian WHERE id_ujian='$row[id_ujian]' AND aktif='Y' ");
                        $jml  = mysqli_num_rows($klsu);
                          // foreach ($klsu as $u)
                        if ($jml >0) { ?>
                          <!-- <a class="badge badge-pill badge-primary"> Aktif</a> -->
                          <a data-toggle="modal" data-target="#tutup<?=$row['id_ujian']; ?>" class="btn btn-success btn-sm text-white"><i class="fa fa-check-square-o"></i> Buka </a>
                          <a href="?page=ujian&act=status&id=<?=$row['id_ujian'] ?>" class="btn btn-warning btn-sm text-black"><i class="fa fa-eye text-black"></i></a>
                          <!-- MODAL TUTUP UJIAN -->
                          <div class="modal fade" id="tutup<?=$row['id_ujian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">
                                    <center>
                                      Apakah Anda Ingin <b>Non Aktifkan</b> Ujian Ini <br> Sekarang ?
                                    </center>
                                  </h4>
                                </div>
                                <div class="modal-body">                                    
                                  <center>
                                    <a href="?page=ujian&act=close&ujian=<?php echo $row['id_ujian']; ?>" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Ya</a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close-o"></i> Tidak</button>
                                  </center>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } else { ?>
                          <!-- <a class="badge badge-pill badge-warning">Tidak Aktif</a> -->
                          <a data-toggle="modal" data-target="#Aktif<?=$row['id_ujian']; ?>" class="btn btn-danger btn-sm text-white"><i class="fa fa-window-close-o"></i> Tutup </a> 
                          <!-- Modal Aktifkan ujian -->
                          <div class="modal fade" id="Aktif<?=$row['id_ujian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">
                                    <center>
                                      Apakah Anda Ingin <b>Mengaktifkan</b> Ulangan Ini Sekarang ?
                                    </center>
                                  </h4>
                                </div>
                                <div class="modal-body">                                    
                                  <center>
                                    <a href="?page=ujian&act=active&ujian=<?php echo $row['id_ujian']; ?>" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Ya</a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close-o"></i> Tidak</button>
                                  </center>
                                </div>
                              
                              </div>
                            </div>
                          </div>
                        <?php }
                      ?> 
                    </td>
                    <td>
                      <a data-toggle="modal" data-target="#kelasUjian<?=$row['id_ujian']; ?>" class="btn btn-dark btn-sm text-warning"><i class="fa fa-graduation-cap"></i> Pilih Kelas </a>
                    </td>
                    <td>
                      <!-- Modal -->
                      <div class="modal fade" id="kelasUjian<?=$row['id_ujian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content" style="overflow:scroll;height=600px;">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">PENGATURAN KELAS UJIAN</h4>
                            </div>
                            <form  method=POST enctype='multipart/form-data' action=?page=proses>
                              <div class="modal-body">                                       
                                <input type="hidden" name="id" value="<?=$row['id_ujian']; ?>">
                                <p>
                                  <h4><b>KELAS TERSEDIA</b></h4>
                                </p>
                                <table class='table'>
                                  <thead>
                                    <tr>
                                      <th>Nama Kelas</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      // kelas yg dimiliki oleh guru
                                      $kelasguru  = mysqli_query($con,"SELECT * FROM tb_roleguru
                                        INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                                        WHERE tb_roleguru.id_guru = '$sesi' 
                                        GROUP BY tb_roleguru.id_kelas
                                      ");
                                      foreach ($kelasguru as $kg) { ?>
                                        <tr>
                                          <td>
                                            <label class="form-check-label">
                                              <input type="checkbox" value="<?=$kg['id_kelas']; ?>" name="kelas[]">
                                              KELAS <?=$kg['kelas']; ?>
                                            </label>
                                          </td>
                                        </tr>
                                      <?php } 
                                    ?>
                                    <tr>
                                      <td colspan="2">
                                        <button name="kelasujianSave" type="submit" class="btn btn-primary btn-xs">Save</button>
                                      </td>
                                    </tr> 
                                  </tbody>
                                </table>
                                <p><h4><b>KELAS TERPILIH</b></h4></p>
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Nama Kelas</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      // tampilkan kelas yg telah terpilih
                                      $klsujian = mysqli_query($con,"SELECT * FROM kelas_ujian
                                        INNER JOIN tb_master_kelas ON kelas_ujian.id_kelas=tb_master_kelas.id_kelas
                                        WHERE id_ujian='$row[id_ujian]' 
                                      ");
                                      foreach ($klsujian as $ku) { ?>
                                        <tr>
                                          <td><?=$ku['kelas']; ?></td>
                                          <td> 
                                            <a href="?page=ujian&act=delkelas&id=<?=$ku['id_klsujian']; ?>" class="btn btn-danger btn-xs">Hapus</a>
                                          </td>
                                        </tr>
                                      <?php }
                                    ?>
                                  </tbody>
                                </table>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                        <a href="?page=ujian&act=ujianedit&id=<?=$row['id_ujian']; ?>" class="btn btn-dark btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark btn-sm text-danger" data-toggle="modal" data-target="#modalKonfirmasi<?= $row['id_ujian']; ?>"><i class="fa fa-trash"></i> Hapus </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalKonfirmasi<?= $row['id_ujian']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Anda yakin akan menghapus data ulangan ini?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> 
                                <a href="?page=ujian&act=ujiandel&id=<?=$row['id_ujian']; ?>" class="btn btn-dark"><i class="fa fa-trash text-danger"></i> Hapus</a>
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



<!-- Modal -->
<div class="modal fade" id="addUjian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <center>
            Silahkan Pilih Jenis Soal Berikut ini !
          </center>
        </h4>
      </div>
      <div class="modal-body">
       <center>
         <a href="?page=ujian&act=add" class="btn btn-dark btn-lg"><i class="fa fa-check-square-o"></i> OBJEKTIF</a>
       <!-- <a href="?page=ujian&act=addessay" class="btn btn-primary btn-lg"><i class="fa fa-pencil"></i> ESSAY</a> -->
       </center>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>