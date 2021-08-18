<div class="content-wrapper">
  <div class="row">
    <div class="col-md-4 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center">PROFIL</h4>
              <p class="card-description text-center">
                <img src="../vendor/images/img_Guru/<?=$data['foto']; ?>" style="width: 100px;height: 100px;"/>
              </p>
              <form class="forms-sample" method="post" action="" enctype="multipart/form-data">
                <input type="hidden"  name="ID" value="<?=$data['id_admin'] ?>">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" value="<?=$data['nama_lengkap'] ?>" required>
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="username" value="<?=$data['username'] ?>" required>
                </div>
                <div class="form-group">
                  <label>Password Lama</label>
                  <input type="password" name="pass1" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Password Baru</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Foto</label>
                  <input id="file" type="file" name="foto" class="form-control">                      
                </div>
                <button type="submit" name="update" class="btn btn-info mr-2">Update</button>
                <a href="javascript:history.back()" class="btn btn-light">Batal</a>
              </form>
              <?php 
                if (isset($_POST['update'])) {
                  $pass       = $data['password'];
                  $password   = sha1($_POST['pass1']);
                  $password2  = sha1($_POST['password']); 
                  if ($pass == $password) {
                    $gambar = @$_FILES['foto']['name'];
                    if (!empty($gambar)) {
                      move_uploaded_file($_FILES['foto']['tmp_name'],"../vendor/images/img_Guru/$gambar");
                      $ganti = mysqli_query($con, "UPDATE tb_admin 
                        SET foto = '$gambar' 
                        WHERE id_admin = '$_POST[ID]' 
                      ");
                    }  	
                    $sql  = mysqli_query($con, "UPDATE tb_admin 
                      SET nama_lengkap  = '$_POST[nama]',
                          username      = '$_POST[username]',
                          password      = '$password2' 
                      WHERE id_admin = '$_POST[ID]' 
                    ") or die(mysqli_error($con));
                    if ($sql) {
                      echo "
                        <script type='text/javascript'>
                          setTimeout(function () {
                            swal({
                              title : 'SUKSES',
                              text  : 'PROFIL BERHASIL DIPERBAHARUI',
                              type  : 'success',
                              timer : 3000
                            });     
                          },10);  
                          window.setTimeout(function(){ 
                            window.location='?page=setting&act=user';
                          } ,3000);   
                        </script>";
                    }
                  } else {
                    echo "
                      <script type='text/javascript'>
                        setTimeout(function () {
                          swal({
                            title : 'GAGAL',
                            text  : 'PASSWORD LAMA TIDAK COCOK',
                            type  : 'error',
                            timer : 3000
                          });     
                        },10);  
                        window.setTimeout(function(){ 
                          window.location='?page=setting&act=user';
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
