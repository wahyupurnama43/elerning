<div class="content-wrapper">
  <h4>Materi</h4>
  <hr>
  <?php 
    if (empty($materi['id_guru'])) { ?>
      <div class="row purchace-popup">
        <div class="col-md-12 col-xs-12">
          <span class="d-flex alifn-items-center">
          <p>Saat ini Anda belum mempunyai Materi Apapun. Tambah Untuk Membuat Materi</p>
          <a data-toggle="modal" data-target="#addMateri" href="?page=materi&act=add" class="btn ml-auto purchase-button"> <i class="fa fa-plus"></i> Tambah Materi</a>
          <i class="mdi mdi-close popup-dismiss"></i>
          </span>
        </div>
      </div>
      <?php } else { ?>
        <div class="row purchace-popup">
          <div class="col-md-12 col-xs-12">
            <span class="d-flex alifn-items-center">
            <!-- <h4><b>Home</b> > Perangkat Pembelajaran</h4> -->

            <a data-toggle="modal" data-target="#addMateri" href="?page=materi&act=add" class="btn btn-dark"> <i class="fa fa-plus"></i> Add Materi</a>
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Materi Pembelajaran</h4>
                <?= $_GET['alert'] ? "<div class='alert alert-success' role='alert'>$_GET[alert]</div>" : ''; ?>
                <p class="card-description">
                  <form action="" method="post">
                    <div class="row">
                      <div class="col-md-5">
                        <select name="mapel" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                          <option value="">- Pilih Mata Pelajaran -</option>
                          <?php 
                            $jenis = mysqli_query($con,"SELECT * FROM tb_roleguru
                              INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                              INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                              INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                              INNER JOIN jadwal ON tb_roleguru.jadwal_id = jadwal.id_jadwal
                              WHERE tb_roleguru.id_guru = '$sesi' 
                            ");
                            foreach ($jenis as $j) {
                              echo "<option value='$j[id_mapel]'>$j[mapel]</option>"; 
                            }
                          ?> 
                        </select>
                      </div>
                      <div class="col-md-5">
                        <select name="semester" class="form-control" style="font-weight: bold;background-color: #212121;color: #fff;">
                          <option value="">- Pilih Semester -</option>
                          <?php $jenis = mysqli_query($con,"SELECT * FROM tb_master_semester ORDER BY id_semester ASC"); 
                            foreach ($jenis as $j) {
                              echo "<option value='$j[id_semester]'>$j[semester]</option>"; 
                            }
                          ?> 
                        </select>
                      </div>
                      <div class="col-md-2">
                        <button type="submit" name="filter" class="btn btn-info"><i class="fa fa-search"></i> Filter</button>
                      </div>
                    </div>
                  </form>
                </p>
                <div class="table-responsive">                 
                  <table class="table table-condensed table-hover" id="data">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Judul Materi</th>
                        <th class="text-center">Materi</th>
                        <th class="text-center">Mata Pelajaran</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Publik</th>
                        <th class="text-center"></th>
                        <th class="text-center">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no       = 1;
                        if (isset($_POST['filter'])) {
                          $sqlrole  = mysqli_query($con,"SELECT * FROM tb_materi
                            INNER JOIN tb_roleguru ON tb_materi.id_roleguru=tb_roleguru.id_roleguru
                            INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                            INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                            INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
                            WHERE tb_roleguru.id_guru = '$sesi' 
                            AND tb_roleguru.id_semester = '$_POST[semester]' 
                            AND tb_roleguru.id_mapel  = '$_POST[mapel]' 
                            ORDER BY id_materi DESC 
                          ");
                        }
                        foreach ($sqlrole as $row) { ?>       
                          <tr>
                            <td class="text-center"><?=$no++; ?>.</td>
                            <td class="text-center"><b class="text-info"><?=$row['judul_materi']; ?></b></td>
                            <td class="text-center">
                              <a data-toggle="modal" data-target="#<?=$row['id_materi']; ?>" class="btn btn-light"> <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> View Materi</a>
                              <!-- Modal Detail-->
                              <div class="modal fade bs-example-modal-lg" id="<?=$row['id_materi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="">
                                      <h4 class="modal-title">
                                        MATERI PEMBELAJARAN <br>
                                        <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <b> <?=$row['judul_materi']; ?></b> | <?=$row['mapel']; ?> KELAS <?=$row['kelas']; ?> 
                                      </h4>
                                      <hr>
                                    </div>
                                    <div class="modal-body" style="overflow:scroll;height:450px;">
                                      <?php 
                                        if ($row['tipe_file']=='text') {
                                            echo "$row[materi]";
                                        } else { ?>
                                        <br>
                                        <br>
                                        <div class="card">
                                          <div class="card-body">
                                            <center><h1> <i class="fa fa-file-code-o"></i> </h1></center>
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                  <td><h4><b> Tipe File</b></h4></td>
                                                  <td>:</td>
                                                  <td> 
                                                    <?php echo "<h4><b> <i class='fa fa-file-word-o'></i> $row[tipe_file] </b></h4> "; ?></td>
                                                </tr>
                                                <tr>
                                                  <td><h4><b> Ukuran File</b></h4></td>
                                                  <td>:</td>
                                                  <td> <h4><b><?=$row['ukuran_file']; ?>.KB </b></h4></td>
                                                </tr>
                                                <tr>
                                                  <td colspan="3" align="center"> <a href="<?=$row['file']; ?>" target="_blank" class="btn btn-danger btn-md text-white"><i class="fa fa-download"></i> Download</a></td>
                                                </tr>
                                              <thead>
                                            </table>                                 
                                          </div>
                                        </div>   
                                        <?php }
                                      ?>
                                    </div>
                                    <div class="modal-footer" style="float: left;">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div> 
                            </td>
                            <td class="text-center"><?=$row['mapel']; ?>  <em><b><?=$row['semester']; ?></b></em> </td>
                            <td class="text-center"><b><?=$row['kelas']; ?></b> </td>
                            <td class="text-center">
                              <?php
                                if ($row['public']=='Y') {
                                  echo "<b class='badge badge-success'>Yes</b>";
                                }else{
                                  echo "<b class='badge badge-danger'>No</b>";
                                }
                              ?>
                            </td>
                            <td>
                              <?php
                                if ($row['public']=='Y') {
                                  echo "<a href='?page=materi&act=activate&id=$row[id_materi]&status=$row[public]' class='btn btn-danger btn-xs text-white'><i class='fa fa-spin fa-lock'></i></a>";
                                }else{
                                  echo "<a href='?page=materi&act=activate&id=$row[id_materi]&status=$row[public]' class='btn btn-success btn-xs text-white'><i class='fa fa-spin fa-unlock'></i></a>";
                                }
                              ?>
                            </td>
                            <td class="text-center">
                              <a href="?page=materi&act=edit&ID=<?=$row['id_materi'] ?>" class="btn btn-dark btn-xs"><i class="fa fa-edit"></i> </a>
                              
                              <!-- Button trigger modal -->
                              <button type="button" class="btn btn-dark text-danger btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash"></i> </button>

                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body text-left">
                                      Yakin hapus data materi?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                      <a href="?page=materi&act=del&ID=<?=$row['id_materi'] ?>" class="btn btn-dark text-danger"><i class="fa fa-trash"></i> Hapus </a>
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

      
<!-- Modal -->
<div class="modal fade" id="addMateri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title" id="myModalLabel">Model Perangkat</h4> -->
      </div>
      <div class="modal-body">
        <center>

           <a href="?page=materi&act=add&TYPE=Manual" class="btn btn-dark btn-lg">
            <!-- <img src="../vendor/images/ck.png" width="300"> -->
            <i class="fa fa-file-text-o"></i>BY CKEDITOR</a>
         <a href="?page=materi&act=add&TYPE=Upload" class="btn btn-success btn-lg"><i class="fa fa-upload"></i>UPLOAD FILE</a>
        </center>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->

      </div>
    </div>
  </div>
</div>