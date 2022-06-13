<div class="content-wrapper">
  <h4> <b>Master</b> <small class="text-muted">/ Jadwal</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <p class="card-description">
            <a href="?page=jadwal&act=add" class="btn btn-info text-white pull-right"><i class="fa fa-plus"></i> Tambah Jadwal</a> <br>
          </p>
          <?= $_GET['alert'] ? "<div class='alert alert-success' role='alert'>$_GET[alert]</div>" : ''; ?>
          <h4 class="card-title">Data Jadwal</h4>
          <div class="table-responsive">
            <table class="table table-condensed table-striped table-hover" id="data">
              <thead class="bg-dark text-white">
                <tr>
                  <th class="text-center">No.</th>
                  <th class="text-center">Mata Pelajaran</th>
                  <th class="text-center">Kelas</th>
                  <th class="text-center">Hari</th>
                  <th class="text-center">Jam</th>
                  <th class="text-center">Nama Guru</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no   = 1;
                $sql  = mysqli_query($con, "SELECT * FROM jadwal 
                    JOIN tb_master_mapel ON jadwal.mata_pelajaran_id = tb_master_mapel.id_mapel
                    JOIN tb_master_kelas ON jadwal.kelas_id = tb_master_kelas.id_kelas
                    LEFT JOIN tb_roleguru ON jadwal.id_jadwal = tb_roleguru.jadwal_id
                    LEFT JOIN tb_guru ON tb_roleguru.id_guru = tb_guru.id_guru
                  ");
                foreach ($sql as $d) { ?>
                  <tr>
                    <td class="text-center"><b><?= $no++; ?>.</b> </td>
                    <td class="text-center"><?= $d['mapel'] ?> </td>
                    <td class="text-center"><?= $d['kelas'] ?> </td>
                    <td class="text-center"><?= $d['hari']; ?></td>
                    <td class="text-center"><?= $d['jam_mulai'] . ' - ' . $d['jam_selesai']; ?></td>
                    <td class="text-center"><?= $d['nama_guru']; ?></td>
                    <td class="text-center">
                      <a href="?page=jadwal&act=edit&id=<?= $d['id_jadwal']; ?>" class="btn btn-dark text-warning"><i class="fa fa-pencil"></i> Edit</a>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#exampleModal<?= $d['id_mapel']; ?>"><i class="fa fa-trash"></i> Hapus</button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal<?= $d['id_mapel']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Apakah anda yakin akan menghapus data jadwal ini?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              <a href="?page=jadwal&act=delete&id=<?= $d['id_jadwal']; ?>" class="btn btn-danger text-white"><i class="fa fa-trash"></i> Hapus</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>