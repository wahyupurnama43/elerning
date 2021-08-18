<div class="content-wrapper">
  <h4> <b>Pengguna</b> <small class="text-muted">/ Guru</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <p class="card-description">
            <a href="?page=guru&act=add" class="btn btn-info text-white pull-right"><i class="fa fa-plus"></i> Tambahkan Guru</a> <br>
          </p>
          <?= $_GET['alert'] ? '<div class="alert alert-success" role="alert">'.@$_GET['alert'].'</div>' : ''; ?>
          <h4 class="card-title">Data Guru</h4>
          <div class="table-responsive">
            <table class="table table-condensed table-striped table-hover" id="data">
              <thead class="bg-dark text-white">
                <tr>
                  <th class="text-center">No.</th> 
                  <th class="text-center">NIP</th> 
                  <th class="text-center">Nama Guru</th> 
                  <th class="text-center">Username</th>
                  <th class="text-center">Foto</th>
                  <th class="text-center">Opsi</th>                     
                </tr>                        
              </thead>  
              <tbody>
                <?php 
                  $no   = 1;
                  $sql  = mysqli_query($con,"SELECT * FROM tb_guru ORDER BY id_guru ASC");
                  foreach ($sql as $d) { ?>
                  <tr>
                    <td class="text-center"><b><?=$no++; ?>.</b> </td>
                    <td class="text-center"><?=$d['nik']?> </td>
                    <td class="text-center"><?=$d['nama_guru']?> </td>
                    <td class="text-center"><?=$d['username']?> </td>
                    <td class="text-center"><img src="../vendor/images/img_Guru/<?=$d['foto']?>" class="img-thumbnail" style="width:50px;height:50px;"> </td>
                    <td class="text-center">
                      <a href="?page=guru&act=edit&id=<?=$d['id_guru']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>

                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal<?= $d['id_guru']; ?>">
                        <i class="fa fa-trash"></i> Hapus
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal<?= $d['id_guru']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Anda yakin akan menghapus guru ini?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <a href="?page=guru&act=del&id=<?=$d['id_guru']?>" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</a>
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
