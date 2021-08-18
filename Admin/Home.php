<?php 
include 'config/db.php';
$oke = mysqli_query($con,"select * from tb_sekolah where id_sekolah='1'");
$oke1 = mysqli_fetch_array($oke);
 ?>
<div class="content-wrapper">
  <h3> <b>Dashboard</b> <small class="text-muted"></small>
  </h3>
  <hr>
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <center>
              <h2>
               Selamat datang di <strong><?php echo $oke1['textlogo'];?></strong> <br>
              <?php echo $oke1['nama_sekolah'];?></h2>
            </center>

         </div>

      </div> 
    </div>
  </div>
  </div>