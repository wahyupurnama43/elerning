<div class="content-wrapper">
  <h4>Jadwal</h4>
  <hr>
  <?php 
    if (empty($role['id_guru'])) { ?>
      <div class="row purchace-popup">
        <div class="col-md-12">
          <span class="d-flex alifn-items-center">
          <p>Saat ini anda belum memilih jadwal, silahkan tambahkan jadwal.</p>
          <a href="?page=mapel&act=add" class="btn ml-auto purchase-button"> <i class="fa fa-plus"></i> Tambah Jadwal</a>
          <i class="mdi mdi-close popup-dismiss"></i>
          </span>
        </div>
      </div>
    <?php } else { ?>
      <div class="row purchace-popup">
        <div class="col-md-12">
          <span class="d-flex alifn-items-center">
          <a href="?page=mapel&act=add" class="btn btn-dark"> <i class="fa fa-plus"></i> Tambah Jadwal</a>
          </span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Daftar Jadwal</h4>
              <p class="card-description">
                <!-- Add class <code>.table</code> -->
              </p>
              <?= $_GET['alert'] ? "<div class='alert alert-success' role='alert'>$_GET[alert]</div>" : ''; ?>
              <div class="table-responsive">   
              <table class="table table-striped table-hover table-condensed">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Mata Pelajaran</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Semester</th>
                    <th class="text-center">Hari</th>
                    <th class="text-center">Jam</th>
                    <th class="text-center">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no       = 1;
                    $sqlrole  = mysqli_query($con,"SELECT * FROM tb_roleguru
                      INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                      INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                      INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                      INNER JOIN jadwal ON tb_roleguru.jadwal_id = jadwal.id_jadwal
                      WHERE tb_roleguru.id_guru='$sesi' 
                    ");
                    foreach ($sqlrole as $row) { ?>       
                      <tr>
                        <td class="text-center"><?= $no++; ?>.</td>
                        <td class="text-center"><?= $row['mapel']; ?></td>
                        <td class="text-center"><?= $row['kelas']; ?></td>
                        <td class="text-center"><?= $row['semester']; ?></td>
                        <td class="text-center"><?= $row['hari']; ?></td>
                        <td class="text-center"><?= $row['jam_mulai'] . ' - ' . $row['jam_selesai']; ?></td>
                        <td class="text-center">
                          <!-- <a href="?page=mapel&act=edit&ID=<?=$row['id_roleguru']; ?>" class="btn btn-dark btn-sm"><i class="fa fa-pencil"></i> Edit </a> -->

                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-dark btn-sm text-danger" data-toggle="modal" data-target="#hapus<?= $row['id_roleguru']; ?>">
                            <i class="fa fa-trash"></i> Hapus
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="hapus<?= $row['id_roleguru']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Anda yakin akan menghapus jadwal mapel ini <?= $d['id_roleguru']; ?>?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <a href="?page=mapel&act=del&id=<?= $row['id_roleguru']; ?>" class="btn btn-dark btn-sm text-danger"><i class="fa fa-trash"></i> Hapus </a>
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
      

            <?php
           
          }
          ?>

  </div>