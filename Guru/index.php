<?php
error_reporting(0);
session_start();
include '../config/db.php';
// memanggil class PHPExcel
include '../assets/PHPExcel/Classes/PHPExcel.php';
include '../assets/PHPExcel/Classes/PHPExcel/IOFactory.php';
if (@$_SESSION['Guru']) {
  if (@$_SESSION['Guru']) {
    $sesi = @$_SESSION['Guru'];
  }

  $sql  = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru = '$sesi'") or die(mysqli_error($con));
  $data = mysqli_fetch_array($sql);

  // Tampilkan Role Guru
  $roleGuru = mysqli_query($con, "SELECT * FROM tb_roleguru WHERE id_guru = '$sesi'") or die(mysqli_error($con));
  $role     = mysqli_fetch_array($roleGuru);

  // Tampilkan Perangkat Pembelajaran
  $sqlPerangkat = mysqli_query($con, "SELECT * FROM tb_perangkat
      INNER JOIN tb_roleguru ON tb_perangkat.id_roleguru=tb_roleguru.id_roleguru
      WHERE tb_roleguru.id_guru='$sesi' ");
  $prkt = mysqli_fetch_array($sqlPerangkat);

  // Tampilkan Materi
  $sqlMateri  = mysqli_query($con, "SELECT * FROM tb_materi
      INNER JOIN tb_roleguru ON tb_materi.id_roleguru=tb_materi.id_roleguru
      WHERE tb_roleguru.id_guru='$sesi' ");
  $materi = mysqli_fetch_array($sqlMateri);

  // data seklah.apl
  $sekolah  = mysqli_query($con, "SELECT * FROM tb_sekolah WHERE id_sekolah=1 ");
  $apl      = mysqli_fetch_array($sekolah); ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Learning | <?= $data['nama_guru']; ?></title>
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
    <link rel="stylesheet" type="text/css" href="../vendor/css/jquery.dataTables.css">
    <style>
      .wrap {
        margin: 10px auto;
        color: #212121;
        /*background: #35a9db;*/
        text-align: justify;
      }

      ::-webkit-scrollbar {
        width: 12px;
        object-position: left;
      }

      ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0, 3);
        background: #666;
      }

      ::-webkit-scrollbar-thumb {
        background: #232323;
      }

      .container {
        margin-top: 5rem;
        text-align: center;
      }

      .spinner {
        color: rgb(229, 231, 235);
        height: 50px;
        width: 50px;
        fill: #1c64f2;
      }

      .animation-spin {
        -webkit-animation: spin 2s infinite linear;
        animation: spin 2s infinite linear;
      }

      @keyframes spin {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }

        100% {
          -webkit-transform: rotate(359deg);
          transform: rotate(359deg);
        }
      }
    </style>
  </head>

  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background: #4d9be6" ;>
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background: #4d9be6" ;>
          <a class="navbar-brand brand-logo" href="index.php" style="font-family:Aegyptus;font-weight: bold;font-size: 30px;">
            <img src="../vendor/images/<?= $apl['logo']; ?>" alt="logo" style="height: 45px;width: 45px;border-radius: 10px;"> <b><?= $apl['textlogo']; ?></b>
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.php">
            <!-- <img src="../vendor/images/logo.png" alt="logo"/> -->
          </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
            <li class="nav-item" style="width: 400px;">
              <a href="#" style="color: #fff;text-decoration: none;">
                <!-- <img src="../vendor/images/smk.png" style="height: 40px;border-radius:10px;"> &nbsp; -->
                <b><?= $apl['nama_sekolah']; ?></b>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right" style="border-top-left-radius:50px;color: black;border-bottom-left-radius:50px;color: #fff;border:1px dashed #00BCD4; ">
            <?php          // tampilakan notifikasi ujian 
            $ujian  = mysqli_query($con, "SELECT * FROM ujian
                  INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
                  INNER JOIN tb_jenisujian ON ujian.id_jenis=tb_jenisujian.id_jenis
                  INNER JOIN kelas_ujian ON ujian.id_ujian=kelas_ujian.id_ujian
                  WHERE ujian.id_guru='$data[id_guru]' AND kelas_ujian.aktif='Y' GROUP BY kelas_ujian.id_ujian    ");
            $jm = mysqli_num_rows($ujian);
            ?>
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link" href="?page=profil">
                <img class="img-xs rounded-circle" src="../vendor/images/img_Guru/<?= $data['foto']; ?>" alt="">
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
                <div class="profile-image">
                  <a href="?page=profil">
                    <img src="../vendor/images/img_Guru/<?= $data['foto']; ?>" alt="image" style="border-radius: 0px;" />
                  </a>
                  <span class="online-status online"></span>
                </div>
                <div class="profile-name">
                  <p class="name"><?= $data['nama_guru']; ?></p>
                  <p class="designation">Guru</p>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php"><img class="menu-icon" src="../vendor/images/menu_icons/081-online education.png" alt="menu icon" style="width:30px;height:30px;"><span class="menu-title">DASHBOARD</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=chat"><img class="menu-icon" src="../vendor/images/menu_icons/176-thoughts.png" alt="menu icon" style="width:30px;height:30px;"><span class="menu-title"> CHAT BOX</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=mapel"><img class="menu-icon" src="../vendor/images/menu_icons/118-calendar.png" alt="menu icon" style="width:30px;height:30px;"><span class="menu-title">JADWAL</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=materi">
                <img class="menu-icon" src="../vendor/images/menu_icons/097-open book.png" alt="menu icon" style="width:30px;height:30px;">
                <span class="menu-title">MATERI</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#tugas" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="../vendor/images/menu_icons/157-study.png" alt="menu icon" style="width:30px;height:30px;"> <span class="menu-title">TUGAS SISWA</span><i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="tugas" style="background-color:#c7dcd0;">
                <ul class="nav flex-column sub-menu" style="margin-left:-40px;">
                  <li class="nav-item">
                    <a class="nav-link" href="?page=tugas"><img class="menu-icon" src="../vendor/images/menu_icons/111-calendar.png" alt="menu icon" style="width:30px;height:30px;"> ATUR TUGAS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?page=tugas&act=view"><img class="menu-icon" src="../vendor/images/menu_icons/085-folder.png" alt="menu icon" style="width:30px;height:30px;"> DATA TUGAS</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#evaluasi" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="../vendor/images/menu_icons/142-signing.png" alt="menu icon" style="width:30px;height:30px;"> <span class="menu-title">ULANGAN</span><i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="evaluasi" style="background-color:#c7dcd0;">
                <ul class="nav flex-column sub-menu" style="margin-left:-34px;">
                  <li class="nav-item">
                    <a class="nav-link" href="?page=ujian"><img class="menu-icon" src="../vendor/images/menu_icons/163-task.png" alt="menu icon" style="width:25px;height:25px;"> <span class="menu-title">ULANGAN</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?page=nilai"><img class="menu-icon" src="../vendor/images/menu_icons/164-task.png" alt="menu icon" style="width:25px;height:25px;"> <span class="menu-title">NILAI</span></a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="?page=pengumuman"><img class="menu-icon" src="../vendor/images/menu_icons/165-teacher.png" alt="menu icon" style="width:30px;height:30px;"> <span class="menu-title">PENGUMUMAN</span></a>
            </li>

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
          $page   = @$_GET['page'];
          $act    = @$_GET['act'];
          $tunggu = @$_GET['tunggu'];

          if ($tunggu == true || $tunggu !== null) {
            echo '
              <div class="container">
                <svg role="status" class="spinner animation-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"></path>
                </svg>
                <p>Mohon Menunggu Sejenak</p>
            </div>
          ';
          }
          if ($page == 'perangkat') {
            if ($act == '') include 'modul/perangkat/data_perangkat.php';
            elseif ($act == 'add') include 'modul/perangkat/add_perangkat.php';
            elseif ($act == 'edit') include 'modul/perangkat/edit_perangkat.php';
            elseif ($act == 'del') include 'modul/perangkat/del_perangkat.php';
            elseif ($act == 'view') include 'modul/perangkat/view.php';
          } elseif ($page == 'mapel') {
            if ($act == '') include 'modul/role/data_role.php';
            elseif ($act == 'add') include 'modul/role/add_role.php';
            elseif ($act == 'edit') include 'modul/role/edit_role.php';
            elseif ($act == 'del') include 'modul/role/del_role.php';
          } elseif ($page == 'materi') {
            if ($act == '') include 'modul/materi/data_materi.php';
            elseif ($act == 'add') include 'modul/materi/add_materi.php';
            elseif ($act == 'edit') include 'modul/materi/edit_materi.php';
            elseif ($act == 'del') include 'modul/materi/del_materi.php';
            elseif ($act == 'view') include 'modul/materi/view_materi.php';
            elseif ($act == 'activate') include 'modul/materi/activate.php';
          } elseif ($page == 'ujian') {
            if ($act == '') include 'modul/ujian/data_ujian.php';
            elseif ($act == 'add') include 'modul/ujian/add_ujian.php';
            elseif ($act == 'addkelas') include 'modul/ujian/add_kelas.php';
            elseif ($act == 'soal') include 'modul/ujian/soal.php';
            elseif ($act == 'soalessay') include 'modul/ujian/soalessay.php';
            elseif ($act == 'soaladd') include 'modul/ujian/add_soal.php';
            elseif ($act == 'soaladdessay') include 'modul/ujian/add_soal_essay.php';
            elseif ($act == 'soaledit') include 'modul/ujian/edit_soal.php';
            elseif ($act == 'soaleditessay') include 'modul/ujian/edit_soal_essay.php';
            elseif ($act == 'soaldel') include 'modul/ujian/del_soal.php';
            elseif ($act == 'soaldelessay') include 'modul/ujian/del_soal_essay.php';
            elseif ($act == 'upSoal') include 'modul/ujian/upload.php';
            elseif ($act == 'addessay') include 'modul/ujian/add_essay.php';
            elseif ($act == 'active') include 'modul/ujian/active.php';
            elseif ($act == 'close') include 'modul/ujian/close.php';
            elseif ($act == 'ujianedit') include 'modul/ujian/ujian_edit.php';
            elseif ($act == 'ujiandel') include 'modul/ujian/ujian_del.php';
            elseif ($act == 'aktifessay') include 'modul/ujian/active_essay.php';
            elseif ($act == 'closeessay') include 'modul/ujian/close_essay.php';
            elseif ($act == 'editessay') include 'modul/ujian/edit_essay.php';
            elseif ($act == 'delessay') include 'modul/ujian/del_essay.php';
            elseif ($act == 'status') include 'modul/ujian/view_statusujian.php';
            elseif ($act == 'delkelas') include 'modul/ujian/del_kelasujian.php';
            elseif ($act == 'addkelasujian') include 'modul/ujian/add_kelasujian.php';
            elseif ($act == 'addkelasujiane') include 'modul/ujian/essay/add_kelasujian.php';
            elseif ($act == 'delkelase') include 'modul/ujian/essay/del_kelasujian.php';
          } elseif ($page == 'nilai') {
            if ($act == '') include 'modul/nilai/data_nilai.php';
            elseif ($act == 'view') include 'modul/nilai/view_nilaikelas.php';
          } elseif ($page == 'profil') {
            if ($act == '') include 'modul/profil/data_profil.php';
          } elseif ($page == 'chat') {
            if ($act == '') include 'modul/chat/chat.php';
            if ($act == 'lihat') include 'modul/chat/isiChat.php';
            elseif ($act == 'del') include 'modul/chat/del.php';
          } elseif ($page == 'tugas') {
            if ($act == '') include 'modul/tugas/v_tugas.php';
            elseif ($act == 'add') include 'modul/tugas/add_tugas.php';
            elseif ($act == 'addkelastugas') include 'modul/tugas/add_kelastugas.php';
            elseif ($act == 'delkelas') include 'modul/tugas/del_kelastugas.php';
            elseif ($act == 'close') include 'modul/tugas/close.php';
            elseif ($act == 'active') include 'modul/tugas/active.php';
            elseif ($act == 'edit') include 'modul/tugas/edit_tugas.php';
            elseif ($act == 'del') include 'modul/tugas/del_tugas.php';
            elseif ($act == 'view') include 'modul/tugas/data_tugas.php';
            elseif ($act == 'viewkelas') include 'modul/tugas/view_tugaskelas.php';
          } elseif ($page == 'pengumuman') {
            if ($act == '') include 'modul/pengumuman/data_pengumuman.php';
            elseif ($act == 'add') include 'modul/pengumuman/add_pengumuman.php';
            elseif ($act == 'edit') include 'modul/pengumuman/edit_pengumuman.php';
            elseif ($act == 'del') include 'modul/pengumuman/del_pengumuman.php';
          } elseif ($page == 'proses') {
            include 'modul/models.php';
          } elseif ($page == 'input_nilai') {
            include 'modul/nilai/input_nilai.php';
          } elseif ($page == 'edit_nilai') {
            include 'modul/nilai/edit_nilai.php';
          } elseif ($page == '') {
            include 'Home.php';
          } else {
            echo "<b>4014!</b> Tidak ada halaman !";
          }
          ?>
          <footer class="footer p-fixed">
            <div class="container-fluid clearfix">
              <span class="text-info d-block text-center text-sm-left d-sm-inline-block"><?= $apl['copyright']; ?></span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><?= $apl['nama_sekolah']; ?> <i class="fa fa-graduation-cap text-danger"></i></span>
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
    <script src="../vendor/js/jquery.dataTables.js"></script>
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
          toolbar: [{
              name: 'basicstyles',
              items: ['Bold', 'Italic', 'Underline', 'Strike']
            },
            {
              name: 'paragraph',
              items: ['NumberedList', 'BulletedList']
            },

          ],
          filebrowserImageBrowseUrl: '../vendor/kcfinder',
          // uiColor:'#1991eb',


        });

        CKEDITOR.replace('ckeditor1', {
          toolbar: [{
              name: 'basicstyles',
              items: ['Bold', 'Italic', 'Underline', 'Strike']
            },
            {
              name: 'paragraph',
              items: ['NumberedList', 'BulletedList']
            },

          ],
          filebrowserImageBrowseUrl: '../vendor/kcfinder',
          // uiColor:'#1991eb'
        });
        CKEDITOR.replace('ckeditor2', {
          toolbar: [{
              name: 'basicstyles',
              items: ['Bold', 'Italic', 'Underline', 'Strike']
            },
            {
              name: 'paragraph',
              items: ['NumberedList', 'BulletedList']
            },

          ],
          filebrowserImageBrowseUrl: '../vendor/kcfinder',
          // uiColor:'#1991eb'
        });
        CKEDITOR.replace('ckeditor3', {
          toolbar: [{
              name: 'basicstyles',
              items: ['Bold', 'Italic', 'Underline', 'Strike']
            },
            {
              name: 'paragraph',
              items: ['NumberedList', 'BulletedList']
            },

          ],
          filebrowserImageBrowseUrl: '../vendor/kcfinder',
          // uiColor:'#1991eb'
        });
        CKEDITOR.replace('ckeditor4', {
          toolbar: [{
              name: 'basicstyles',
              items: ['Bold', 'Italic', 'Underline', 'Strike']
            },
            {
              name: 'paragraph',
              items: ['NumberedList', 'BulletedList']
            },

          ],
          filebrowserImageBrowseUrl: '../vendor/kcfinder',
          // uiColor:'#1991eb'
        });
        CKEDITOR.replace('ckeditor5', {
          toolbar: [{
              name: 'basicstyles',
              items: ['Bold', 'Italic', 'Underline', 'Strike']
            },
            {
              name: 'paragraph',
              items: ['NumberedList', 'BulletedList']
            },

          ],
          filebrowserImageBrowseUrl: '../vendor/kcfinder',
          // uiColor:'#1991eb'
        });
      });

      function pilihJadwal() {
        $.ajax({
          url: 'modul/jadwal.php',
          type: 'post',
          data: {
            mata_pelajaran_id: $('#mapel').val(),
            kelas_id: $('#kelas').val(),
          },
          success: function(result) {
            console.log(result);
            if (result.length > 0) {
              isi = '<option value="">Pilih Jadwal</option>';
              result.forEach(element => {
                isi += `<option value="${element.id_jadwal}">${element.hari + ' | ' + element.jam_mulai + ' - ' + element.jam_selesai}</option>`;
              });
            } else {
              isi = '<option value="">Jadwal tidak ada</option>';
            }
            $('#jadwal').html(isi);
          }
        });
      }
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
