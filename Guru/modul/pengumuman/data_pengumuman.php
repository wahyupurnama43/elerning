<div class="content-wrapper">
  <h4><b>Pengumuman</b> <small class="text-muted">/</small></h4>
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
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <p class="card-description">
            <a href="?page=pengumuman&act=add" class="btn btn-info text-white pull-right"><i class="fa fa-plus"></i> Tambah Pengumuman </a> <br>
          </p>
          <?= @$_GET['alert'] ? '<div class="alert alert-success" role="alert">'.@$_GET['alert'].'</div>' : ''; ?>
          <h4 class="card-title">Data Pengumuman</h4>
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-hover" id="data">
                <thead>
                  <tr>
                    <th>No.</th> 
                    <th>Kelas</th> 
                    <th>Mapel</th> 
                    <th>Judul</th> 
                    <th>Isi</th> 
                    <th>Tanggal</th>
                    <th>Opsi</th>                     
                  </tr>                        
                </thead>  
                <tbody>
                  <?php 
                    function tgl_indo($tanggal){
                      $bulan = array (
                        1 =>   'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                      );
                      $pecahkan = explode('-', $tanggal);
                      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $no   = 1;
                    $sql  = mysqli_query($con,"SELECT * FROM tb_pengumuman 
                      JOIN tb_roleguru ON tb_pengumuman.roleguru = tb_roleguru.id_roleguru
                      JOIN tb_master_kelas ON tb_roleguru.id_kelas = tb_master_kelas.id_kelas
                      JOIN tb_master_mapel ON tb_roleguru.id_mapel = tb_master_mapel.id_mapel
                      ORDER BY id ASC
                    ");
                    foreach ($sql as $d) { ?>
                      <tr>
                        <td width="50"><b><?=$no++; ?>.</b> </td>
                        <td><?= $d['kelas']; ?> </td>
                        <td><?= $d['mapel']; ?> </td>
                        <td><?= $d['judul']; ?> </td>
                        <td><?=$d['isi']?> </td>
                        <td><?= tgl_indo(substr($d['tgl'], 0, 10)); ?></td>
                        <td>
                          <a href="?page=pengumuman&act=edit&id=<?=$d['id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal<?= $r['id_soal']; ?>"><i class="fa fa-trash"></i> Hapus</button>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal<?= $r['id_soal']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Anda yakin akan menghapus pengumuman?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> 
                                  <a href="?page=pengumuman&act=del&id=<?=$d['id']?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>                        
                      </tr>  
                    <?php }

                  } 
                  ?>                      
                </tbody>                      
              </table>                    
            </div>
          </div>
        </div>                  
      </div>
    </div>
  </div>
