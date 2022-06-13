<?php
session_start();
include 'config/db.php';
$oke  = mysqli_query($con, "select * from tb_sekolah where id_sekolah='1'");
$oke1 = mysqli_fetch_array($oke);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>E-Learning</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="shortcut icon" type="image/png" href="vendor/images/smpdw.png" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/login/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/login/fonts/iconic/css/material-design-iconic-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/login/vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/login/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/login/vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/login/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/login/vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="vendor/login/css/main.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" href="vendor/node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendor/node_modules/simple-line-icons/css/simple-line-icons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="vendor/css/style.css">
  <!-- endinject -->
  <link href="vendor/sweetalert/sweetalert.css" rel="stylesheet" />
</head>

<body>
  <div class="limiter">
    <div class="container-login100" style="background-color: #4d96f1;">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
        <center><img src="vendor/images/smpdw.png" alt="" height="100" width="100"></center><br>
        <form method="post" action="" class="login100-form validate-form">
          <span class="login100-form-title p-b-49">
            E-LEARNING
          </span>
          <div class="wrap-input100 validate-input m-b-23" data-validate="Username/NIS belum diisi">
            <span for="nis" class="label-input100">Username/NIS</span>
            <input class="input100" type="text" name="username" placeholder="Masukkan Username/NIS">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
          </div>
          <div class="wrap-input100 validate-input m-b-23" data-validate="Password belum diisi">
            <span for="Password" class="label-input100">Password</span>
            <input class="input100" type="password" name="password" placeholder="Masukkan Password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
          </div>

          <!-- 					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">User</span>
						 <select name="level" class="form-control" required style="background-color: #212121;border-radius: 7px;color: #fff;font-weight: bold;">
                              <option value="">-- Pilih Level --</option>
                              <option value="1"> Guru </option>
                              <option value="2"> Siswa </option>
                               <option value="3"> Admin </option>
                            </select>
					</div> -->

          <div class="container-login100-form-btn m-b-23">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button value="LOGIN" name="Login" type="submit" class="login100-form-btn">
                Login
              </button>
            </div>
          </div>

        </form>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $email = trim(mysqli_real_escape_string($con, $_POST['username']));
          $pass = sha1($_POST['password']);

          $sql = mysqli_query($con, "SELECT * FROM tb_guru WHERE username='$email' AND password='$pass' AND status='Y' ") or die(mysqli_error($con));
          $data = mysqli_fetch_array($sql);
          $id = $data[0];
          $cek = mysqli_num_rows($sql);
          if ($cek > 0) {
            $_SESSION['Guru'] = $id;
            $_SESSION['upload_gambar'] = TRUE;
            $_SESSION['foto'] = $data['foto'];

            echo "
              <script type='text/javascript'>
                setTimeout(function () {
                  swal({
                    title             : 'SUKSES',
                    text              : 'LOGIN BERHASIL',
                    type              : 'success',
                    timer             : 1000,
                    showConfirmButton : false
                  });     
                },10);  
                window.setTimeout(function(){ 
                  window.location.replace('Guru/index.php');
                } ,1000);   
              </script>";
          } else {
            $sql = mysqli_query($con, "SELECT * FROM tb_siswa JOIN tb_master_kelas ON tb_siswa.id_kelas=tb_master_kelas.id_kelas WHERE nis='$email' AND password='$pass' AND aktif='Y' ") or die(mysqli_error($con));
            $data = mysqli_fetch_array($sql);
            $id = $data[0];
            $cek = mysqli_num_rows($sql);

            if ($cek > 0) {

              $_SESSION['Siswa']        = $id;
              $_SESSION['username']     = $data['nis'];
              $_SESSION['namalengkap']  = $data['nama_siswa'];
              $_SESSION['password']     = $data['password'];
              $_SESSION['nis']          = $data['nis'];
              $_SESSION['id_siswa']     = $data['id_siswa'];
              $_SESSION['kelas']        = $data['kelas'];
              $_SESSION['id_kelas']     = $data['id_kelas'];
              $_SESSION['tingkat']      = $data['tingkat'];
              $_SESSION['foto']         = $data['foto'];
              mysqli_query($con, "UPDATE tb_siswa SET status='Online' WHERE id_siswa='$data[id_siswa]'");
              echo "
                <script type='text/javascript'>
                setTimeout(function () {
                swal({
                title: 'SUKSES',
                text:  'LOGIN BERHASIL',
                type: 'success',
                timer: 1000,
                showConfirmButton : false
                });     
                },10);  
                window.setTimeout(function(){ 
                window.location.replace('Siswa/index.php');
                } ,1000);   
                </script>";
            } else {
              $sql = mysqli_query($con, "SELECT * FROM tb_admin WHERE username='$email' AND password='$pass' AND aktif='Y' ") or die(mysqli_error($con));
              $data = mysqli_fetch_array($sql);
              $id = $data[0];
              $cek = mysqli_num_rows($sql);

              if ($cek > 0) {
                $_SESSION['Admin'] = $id;
                $_SESSION['upload_gambar'] = TRUE;

                echo "
                  <script type='text/javascript'>
                  setTimeout(function () {
                  swal({
                  title: 'ADMIN',
                  text:  'LOGIN BERHASIL',
                  type: 'success',
                  timer: 1000,
                  showConfirmButton : false
                  });     
                  },10);  
                  window.setTimeout(function(){ 
                  window.location.replace('Admin/index.php');
                  } ,1000);   
                  </script>";
              } else {
                echo "
              <script type='text/javascript'>
              setTimeout(function () {
              swal({
              title: 'GAGAL',
               text:  'USERNAME/NIS ATAU PASSWORD SALAH',
              type: 'error',
              timer: 1000,
              showConfirmButton : false
              });     
              },10);  
              window.setTimeout(function(){ 
              window.location.replace('?pages=login');
              } ,1000);   
              </script>";
              }
            }
          }
        }
        ?>
      </div>
    </div>
  </div>


  <div id="dropDownSelect1"></div>

  <!--===============================================================================================-->
  <script src="vendor/login/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/login/vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/login/vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/login/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/login/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/login/vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/login/vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/login/vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/login/js/main.js"></script>
  <script src="vendor/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="vendor/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="vendor/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="vendor/sweetalert/sweetalert.min.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../vendor/js/off-canvas.js"></script>
  <script src="../vendor/js/misc.js"></script>

</body>

</html>