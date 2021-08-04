<?php 
  $edit = mysqli_query($con,"SELECT * FROM tb_pengumuman WHERE id='$_GET[id]' ");
  foreach ($edit as $d) {
?>
<div class="content-wrapper">
  <h4> <b>Pengumuman</b> <small class="text-muted">/ Edit Pengumuman</small></h4>
  <hr>
  <div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Edit Pengumuman</h4>
              <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Kelas dan Mata Pelajaran</label>
                  <select class="form-control" name="id_roleguru" onchange="cek_database()" id="id_roleguru" required>
                    <?php
                      $sqlMapel = mysqli_query($con, "SELECT * FROM tb_roleguru
                        INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                        INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                        WHERE tb_roleguru.id_guru='$sesi'
                      ");
                      while($mapel=mysqli_fetch_array($sqlMapel)){
                        $selected = $d['roleguru'] == $mapel['id_roleguru'] ? 'selected' : '';
                        echo "<option value='$mapel[id_roleguru]' $selected>Kelas $mapel[kelas] - $mapel[mapel]</option>";
                      }
                    ?>
                  </select>
                </div>
                <input type="hidden" name="id" value="<?=$d['id'] ?>">
                <div class="form-group">
                  <label>Judul</label>
                  <input name="judul" type="text" class="form-control" placeholder="Judul Pengumuman" required value="<?=$d['judul'] ?>">
                </div>
                <div class="form-group">
                  <label>Isi</label>
                  <textarea class="form-control" name="isi" required="" placeholder="Isi Pengumuman"><?=$d['isi'] ?></textarea>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modalKonfirmasi">Edit</button>

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
                        Anda yakin akan mengedit pengumuman ini?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                        <button name="updatePengumuman" type="submit" class="btn btn-success">Edit</button>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="?page=pengumuman" class="btn btn-light">Cancel</a>
              </form>
              <?php 
                if (isset($_POST['updatePengumuman'])) {
                  $date = date('Y-m-d H:i:s');
                  $save = mysqli_query($con, "UPDATE tb_pengumuman 
                    SET judul     = '$_POST[judul]',
                        isi       = '$_POST[isi]',
                        roleguru  = '$_POST[id_roleguru]'
                    WHERE id = '$_GET[id]'
                  ");
                  if ($save) {
                    echo "
                      <script type='text/javascript'>
                        setTimeout(function () {
                          swal({
                            title             : 'Sukses',
                            text              :  'Data pengumuman berhasil diedit!',
                            type              : 'success',
                            timer             : 3000,
                            showConfirmButton : true
                          });     
                        },10);  
                        window.setTimeout(function(){ 
                          window.location.replace('?page=pengumuman&alert=Data pengumuman berhasil diedit');
                        } ,3000);   
                      </script>";
                  }
            }

                ?> 

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
		<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>
<script>
		function goBack() {
		  window.history.back();
		}
	</script>
  <?php } ?>