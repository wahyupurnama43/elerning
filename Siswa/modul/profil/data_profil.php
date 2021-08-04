<?php 
  $sqld = mysqli_query($con,"SELECT * FROM tb_siswa
    INNER JOIN tb_master_kelas ON tb_siswa.id_kelas = tb_master_kelas.id_kelas
    WHERE id_siswa = '$sesi' 
  ") or die(mysqli_error($con));
  $d = mysqli_fetch_array($sqld);
?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center">Profile</h4>
              <p class="card-description text-center">
                <img src="../vendor/images/img_Siswa/<?=$data['foto']; ?>" style="border:3px solid black;width: 100px;height: 100px;border-radius: 7px;"/>
              </p>
              <form class="forms-sample" method="post" action="?page=proses" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Nis</label>
                  <input type="hidden"  name="ID" value="<?=$data['id_siswa'] ?>">
                  <input type="text" class="form-control" name="nis" value="<?=$data['nis'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" value="<?=$data['nama_siswa'] ?>">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" required>                      
                </div>
                <div class="form-group">
                  <label>Foto</label>
                  <input id="file" type="file" name="foto" class="form-control">                      
                </div>
                <button type="submit" name="porifilUpdate" class="btn btn-info mr-2">Update</button>
                <a href="javascript:history.back()" class="btn btn-light">Batal</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>
          