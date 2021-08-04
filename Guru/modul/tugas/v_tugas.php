<div class="content-wrapper">
  <h4><b>Tugas Siswa</b> <small class="text-muted">/</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Tugas</h4>
          <p class="card-description">
            <a href="?page=tugas&act=add" class="btn btn-dark text-white"><i class="fa fa-plus"></i>Tambah Tugas</a>
          </p> 
          <?= $_GET['alert'] ? '<div class="alert alert-success" role="alert">'.@$_GET['alert'].'</div>' : ''; ?>
          <div class="table-responsive"> 
            <table class="table" id="data">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Mata Pelajaran</th>
                  <th class="text-center">Jenis Tugas</th>
                  <th class="text-center">Kelas</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody style="color: black;">
                <?php 
                  $no   = 1;
                  $sql  = mysqli_query($con,"SELECT * FROM tb_tugas
                    INNER JOIN tb_jenistugas ON tb_tugas.id_jenistugas=tb_jenistugas.id_jenistugas
                    INNER JOIN tb_master_mapel ON tb_tugas.id_mapel=tb_master_mapel.id_mapel
                    INNER JOIN tb_master_semester ON tb_tugas.id_semester=tb_master_semester.id_semester
                    INNER JOIN tb_roleguru ON tb_tugas.id_mapel = tb_roleguru.id_mapel
                    WHERE tb_roleguru.id_guru  = '$sesi' 
                  ");
                  foreach ($sql as $d) { ?>
                    <tr>
                      <td class="text-center"><?=$no++; ?>. </td>
                      <td class="text-center"> <?=$d['mapel'] ?></td>
                      <td class="text-center"><?=$d['jenis_tugas'] ?></td>
                      <td class="text-center">
                        <a data-toggle="modal" data-target="#kelasTugas<?=$d['id_tugas']; ?>" class="btn btn-dark btn-sm text-warning"><i class="fa fa-graduation-cap"></i> Kelas </a>
                        <!-- Modal -->
                        <div class="modal fade" id="kelasTugas<?=$d['id_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">PENGATURAN KELAS TUGAS</h4>
                              </div>
                              <form  method=POST enctype='multipart/form-data' action=?page=proses>
                                <div class="modal-body">                                       
                                  <input type="hidden" name="id" value="<?=$d['id_tugas']; ?>">
                                  <p>
                                    <h4><b>KELAS TERSEDIA</b></h4>
                                  </p>
                                  <table class='table'>
                                    <thead>
                                      <tr>
                                        <th class="text-left">Nama Kelas</th>
                                        <th class="text-left"></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        // kelas yg dimiliki oleh guru
                                        $kelasguru  = mysqli_query($con,"SELECT * FROM tb_roleguru
                                          INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                                          WHERE tb_roleguru.id_guru = '$sesi'
                                          AND tb_roleguru.id_mapel = '$d[id_mapel]' 
                                          GROUP BY tb_roleguru.id_kelas");
                                        foreach ($kelasguru as $kg) { ?>
                                          <tr>
                                            <td class="text-left">
                                              <label class="form-check-label">
                                                <input type="checkbox" value="<?=$kg['id_kelas']; ?>" name="kelas[]">
                                                KELAS <?=$kg['kelas']; ?>
                                              </label>
                                            </td>
                                            <td class="text-left"></td>
                                          </tr>
                                        <?php } 
                                      ?>
                                    </tbody>
                                    <tr>
                                      <td colspan="2">
                                        <button name="kelastugasSave" type="submit" class="btn btn-primary btn-xs">Save</button>
                                      </td>
                                    </tr> 
                                  </table>
                                  <p>
                                    <h4><b>KELAS TERPILIH</b></h4>
                                  </p>
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th class="text-left">Nama Kelas</th>
                                        <th class="text-left"></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        // tampilkan kelas yg telah terpilih
                                        $klsujian = mysqli_query($con,"SELECT * FROM kelas_tugas
                                          INNER JOIN tb_master_kelas ON kelas_tugas.id_kelas=tb_master_kelas.id_kelas
                                          WHERE id_tugas='$d[id_tugas]' 
                                        ");
                                        foreach ($klsujian as $ku) { ?>
                                          <tr>
                                            <td class="text-left"> Kelas <?=$ku['kelas']; ?> </td>
                                            <td class="text-left"> 
                                              <a href="?page=tugas&act=delkelas&id=<?=$ku['id_klstugas']; ?>" class="btn btn-danger btn-xs">Batal</a>
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
                      </td>
                      <td class="text-center">
                        <!-- cek ujian ini di kelas tugas -->
                        <?php 
                          $klsu = mysqli_query($con,"SELECT * FROM kelas_tugas WHERE id_tugas='$d[id_tugas]' AND aktif='Y' ");
                          $jml  = mysqli_num_rows($klsu);
                          // foreach ($klsu as $u)
                          if ($jml >0) { ?>
                            <!-- <a class="badge badge-pill badge-primary"> Aktif</a> -->
                            <a data-toggle="modal" data-target="#tutup<?=$d['id_tugas']; ?>" class="btn btn-success btn-sm text-white"><i class="fa fa-check-square-o"></i> Aktif </a>
                            <!-- MODAL TUTUP UJIAN -->
                            <div class="modal fade" id="tutup<?=$d['id_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">
                                      <center>
                                        Apakah Anda Ingin <b>Non Aktifkan</b> TUGAS Ini <br> Sekarang ?
                                      </center>
                                    </h4>
                                  </div>
                                  <div class="modal-body">                                    
                                    <center>
                                      <a href="?page=tugas&act=close&tugas=<?php echo $d['id_tugas']; ?>" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Ya</a>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close-o"></i> Tidak</button>
                                    </center>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php } else { ?>
                              <!-- <a class="badge badge-pill badge-warning">Tidak Aktif</a> -->
                              <a data-toggle="modal" data-target="#Aktif<?=$d['id_tugas']; ?>" class="btn btn-danger btn-sm text-white"><i class="fa fa-window-close-o"></i> Tutup </a> 
                              <!-- Modal Aktifkan ujian -->
                              <div class="modal fade" id="Aktif<?=$d['id_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">
                                        <center>
                                          Apakah Anda Ingin <b>Mengaktifkan</b> TUGAS Ini Sekarang ?
                                        </center>
                                      </h4>
                                    </div>
                                    <div class="modal-body">                                    
                                      <center>
                                        <a href="?page=tugas&act=active&tugas=<?php echo $d['id_tugas']; ?>" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Ya</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close-o"></i> Tidak</button>
                                      </center>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <?php 
                          }
                        ?>
                      </td>
                      <td class="text-center">
                        <a href="?page=tugas&act=edit&ID=<?=$d['id_tugas']; ?>" class="btn btn-dark text-warning btn-xs"><i class="fa fa-pencil"></i> </a>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark text-danger btn-xs" data-toggle="modal" data-target="#hapus<?= $d['id_tugas']; ?>"><i class="fa fa-trash"></i> </button>

                        <!-- Modal -->
                        <div class="modal fade" id="hapus<?= $d['id_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Apakah anda yakin akan menghapus data tugas?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="?page=tugas&act=del&idt=<?=$d['id_tugas']; ?>" class="btn btn-dark text-danger"><i class="fa fa-trash"></i> </a>
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
