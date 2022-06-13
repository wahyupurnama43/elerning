<?php
session_start();
include '../config/db.php';
if (@$_SESSION['Admin']) {
  if (@$_SESSION['Admin']) {
    $sesi = @$_SESSION['Admin'];
  }
  $sql  = mysqli_query($con, "SELECT * FROM tb_admin WHERE id_admin = '$sesi'") or die(mysqli_error($con));
  $data = mysqli_fetch_array($sql);

  // data seklah.apl
  $sekolah  = mysqli_query($con, "SELECT * FROM tb_sekolah WHERE id_sekolah=1 ");
  $apl      = mysqli_fetch_array($sekolah);
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-learning | <?= $data['nama_lengkap']; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../vendor/node_modules/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendor/node_modules/simple-line-icons/css/simple-line-icons.css">
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="../vendor/node_modules/font-awesome/css/font-awesome.min.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../vendor/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../vendor/images/smpdw.png" />
    <link href="../vendor/sweetalert/sweetalert.css" rel="stylesheet" />
    <script type="text/javascript" src="../vendor/ckeditor/ckeditor.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="../vendor/css/jquery.dataTables.css"> -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  </head>

  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background: #4d9be6;">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background-color: #4d9be6;">
          <a class="navbar-brand brand-logo" href="index.php" style="font-family:Aegyptus;font-weight: bold;font-size: 30px;">
            <img src="../vendor/images/<?= $apl['logo']; ?>" alt="logo" style="height: 45px;width: 45px;border-radius: 10px;">
            <!-- <i class="fa fa-graduation-cap"></i> --><b><?= $apl['textlogo']; ?></b>
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.php">
            <!-- <img src="../vendor/images/logo.png" alt="logo"/> -->
          </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center" style="background-color: #4d9be6;">
          <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
            <li class="nav-item" style="width: 400px;">
              <a href="#" style="color: #fff;text-decoration: none;">
                <!-- <img src="../vendor/images/smk.png" style="height: 40px;border-radius:10px;"> &nbsp; -->
                <b><?= $apl['nama_sekolah']; ?></b>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <div class="nav-link">
                <div class="profile-image"> <img src="../vendor/images/img_Guru/<?= $data['foto']; ?>" alt="image" style="border-radius: 0px;" /> <span class="online-status online"></span> </div>
                <div class="profile-name">
                  <p class="name"><?= $data['nama_lengkap']; ?></p>
                  <p class="designation">Admin</p>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php"><img class="menu-icon" src="../vendor/images/menu_icons/027-tutorial.png" alt="menu icon" style="width:30px;height:30px;"><span class="menu-title">DASHBOARD</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#masterData" aria-expanded="false" aria-controls="general-pages"><img class="menu-icon" src="../vendor/images/menu_icons/108-folder1.png" alt="menu icon" style="width:30px;height:30px;"><span class="menu-title"> DATA MASTER </span><i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="masterData" style="background-color:#c7dcd0;">
                <ul class="nav flex-column sub-menu" style="margin-left:-34px;">
                  <p></p>
                  <li class="nav-item">
                    <a class="nav-link" href="?page=kelas" style="color:#000;">
                      <img class="menu-icon" src="../vendor/images/menu_icons/tag.png" alt="menu icon" style="width:15px;height:15px;">
                      <span class="menu-title">Master Kelas</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="?page=semester" style="color:#000;">
                      <img class="menu-icon" src="../vendor/images/menu_icons/tag.png" alt="menu icon" style="width:15px;height:15px;"><span class="menu-title">Master Semester</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="?page=mapel" style="color:#000;">
                      <img class="menu-icon" src="../vendor/images/menu_icons/tag.png" alt="menu icon" style="width:15px;height:15px;"><span class="menu-title">Master Mata Pelajaran</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="?page=jenisujian" style="color:#000;">
                      <img class="menu-icon" src="../vendor/images/menu_icons/tag.png" alt="menu icon" style="width:15px;height:15px;"><span class="menu-title">Master Jenis Ulangan</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?page=jadwal" style="color:#000;">
                      <img class="menu-icon" src="../vendor/images/menu_icons/tag.png" alt="menu icon" style="width:15px;height:15px;"><span class="menu-title">Master Jadwal</span>
                    </a>
                  </li>
                  <p></p>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#evaluasi" aria-expanded="false" aria-controls="general-pages"><img class="menu-icon" src="../vendor/images/menu_icons/108-folder.png" alt="menu icon" style="width:30px;height:30px;"><span class="menu-title">DATA PENGGUNA</span><i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="evaluasi" style="background-color:#c7dcd0;">
                <ul class="nav flex-column sub-menu" style="margin-left:-34px;">
                  <p></p>
                  <li class="nav-item">
                    <a class="nav-link" href="?page=guru" style="color:#000;">
                      <img class="menu-icon" src="../vendor/images/menu_icons/115-professor1.png" alt="menu icon" style="width:25px;height:25px;">
                      <span class="menu-title">GURU</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?page=siswa" style="color:#000;">
                      <img class="menu-icon" src="../vendor/images/menu_icons/155-student.png" alt="menu icon" style="width:25px;height:25px;"><span class="menu-title">SISWA</span>
                    </a>
                  </li>
                  <p></p>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=setting">
                <img class="menu-icon" src="../vendor/images/menu_icons/170-technology.png" alt="menu icon" style="width:30px;height:30px;"><span class="menu-title">UBAH APLIKASI</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=setting&act=user">
                <img class="menu-icon" src="../vendor/images/menu_icons/094-online education.png" alt="menu icon" style="width:30px;height:30px;"></i><span class="menu-title">UBAH PROFILE ADMIN</span>
              </a>
            </li>
            <hr>
            <li class="nav-item purchase-button">
              <form name="logoutform" method="post" action="logout.php" id="logoutform">
                <input type="hidden" name="form_name" value="logoutform">
                <button class="nav-link w-100 border-0 cursor-pointer" type="button" name="logout" value="KELUAR" id="logout">Keluar</button>
              </form>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <!-- Konten -->
          <?php
          error_reporting();
          $page = @$_GET['page'];
          $act  = @$_GET['act'];
          if ($page == 'kelas') {
            if ($act == '') include 'modul/kelas/data_kelas.php';
            elseif ($act == 'del') include 'modul/kelas/del_kelas.php';
          } elseif ($page == 'semester') {
            if ($act == '') include 'modul/semester/data_semester.php';
            elseif ($act == 'del') include 'modul/semester/del_semester.php';
          } elseif ($page == 'mapel') {
            if ($act == '') include 'modul/mapel/data_mapel.php';
            elseif ($act == 'del') include 'modul/mapel/del_mapel.php';
          } elseif ($page == 'jenisujian') {
            if ($act == '') include 'modul/jenisujian/data_jenisujian.php';
            elseif ($act == 'del') include 'modul/jenisujian/del_jenisujian.php';
          } elseif ($page == 'jenisperangkat') {
            if ($act == '') include 'modul/jenisperangkat/data_perangkat.php';
            elseif ($act == 'del') include 'modul/jenisperangkat/del_perangkat.php';
          } elseif ($page == 'guru') {
            if ($act == '') include 'modul/guru/data_guru.php';
            elseif ($act == 'del') include 'modul/guru/del_guru.php';
            elseif ($act == 'confirm') include 'modul/guru/confir_guru.php';
            elseif ($act == 'unconfirm') include 'modul/guru/unconfir_guru.php';
            elseif ($act == 'add') include 'modul/guru/add_guru.php';
            elseif ($act == 'edit') include 'modul/guru/edit_guru.php';
          } elseif ($page == 'siswa') {
            if ($act == '') include 'modul/siswa/data_siswa.php';
            elseif ($act == 'del') include 'modul/siswa/del_siswa.php';
            elseif ($act == 'confirm') include 'modul/siswa/confir_siswa.php';
            elseif ($act == 'unconfirm') include 'modul/siswa/unconfir_siswa.php';
            elseif ($act == 'add') include 'modul/siswa/add_siswa.php';
            elseif ($act == 'edit') include 'modul/siswa/edit_siswa.php';
          } elseif ($page == 'setting') {
            if ($act == '') include 'modul/setting/setting.php';
            elseif ($act == 'user') include 'modul/setting/setting_user.php';
          } elseif ($page == 'jadwal') {
            if ($act == '') include 'modul/jadwal/data.php';
            elseif ($act == 'add') include 'modul/jadwal/tambah.php';
            elseif ($act == 'edit') include 'modul/jadwal/edit.php';
            elseif ($act == 'delete') include 'modul/jadwal/delete.php';
          } elseif ($page == 'proses') {
            include 'modul/procces.php';
          } elseif ($page == '') {
            include 'Home.php';
          } else {
            echo "<b>4014!</b> Tidak ada halaman !";
          }
          ?>
          <!-- End-kontent -->

          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer p-fixed">
            <div class="container-fluid clearfix">
              <span class="text-info d-block text-center text-sm-left d-sm-inline-block">
                <?= $apl['copyright']; ?>
              </span>

              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><?php echo $apl['nama_sekolah']; ?> <i class="fa fa-graduation-cap text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>


    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../vendor/js/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->


    <!-- <script src="../vendor/js/jquery.dataTables.js"></script> -->
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendor/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../vendor/sweetalert/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="../vendor/js/off-canvas.js"></script>
    <script src="../vendor/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->

    <!-- End custom js for this page-->
    <script>
      $(document).ready(function() {
        $('#data').DataTable();

        CKEDITOR.replace('ckeditor', {
          filebrowserImageBrowseUrl: '../vendor/kcfinder',
          // uiColor:'#1991eb'
        });
      });

      $("#logout").on("click", function() {
        swal({
          title: 'Yakin Keluar ?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'OK',
          closeOnConfirm: true,
          closeOnCancel: true
        }, function(result) {
          console.log(result);
          if (result === true) {
            $('#logoutform').submit() // this submits the form 
          }
        })
      })
    </script>







  </body>

  </html>


<?php
} else {

  include 'modul/500.html';

  // echo "<script>
  // window.location='../index.php';</script>";

}
