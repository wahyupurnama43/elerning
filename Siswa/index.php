<?php
  session_start();
  include '../config/db.php';
  if (@$_SESSION['Siswa']) {
    if (@$_SESSION['Siswa']) {
      $sesi = @$_SESSION['Siswa'];
    }
    $sql  = mysqli_query($con,"SELECT * FROM tb_siswa WHERE id_siswa = '$sesi'") or die(mysqli_error($con));
    $data = mysqli_fetch_array($sql);
    // data seklah.apl
    $sekolah  = mysqli_query($con,"SELECT * FROM tb_sekolah WHERE id_sekolah=1 ");
    $apl      = mysqli_fetch_array($sekolah); 
    
    if ($_GET['page'] == 'materi') {
      $sqlmtr = mysqli_query($con,"SELECT tb_materi.* FROM tb_materi
        INNER JOIN tb_roleguru ON tb_materi.id_roleguru = tb_roleguru.id_roleguru
        LEFT OUTER JOIN (
          SELECT notifikasi_materi.* FROM notifikasi_materi
          JOIN tb_siswa ON notifikasi_materi.id_siswa = tb_siswa.id_siswa
          WHERE tb_siswa.id_siswa = '$_SESSION[Siswa]'
        ) notif ON tb_materi.id_materi = notif.id_materi
        WHERE tb_roleguru.id_kelas  = '$data[id_kelas]'
        AND notif.id_materi IS NULL
        AND tb_materi.public = 'Y'
      ");

      foreach ($sqlmtr as $key) {
        mysqli_query($con, "INSERT INTO notifikasi_materi  
          VALUES (
            NULL,
            '$_SESSION[Siswa]',
            '$key[id_materi]'
          )
        ");
      }
    }

    if ($_GET['page'] == 'tugas') {
      if ($_GET['mapel']) {
        // cek tabel tugas
        $kelas  = mysqli_query($con,"SELECT * FROM kelas_tugas 
          JOIN tb_tugas ON kelas_tugas.id_tugas = tb_tugas.id_tugas
          WHERE id_kelas  = '$_SESSION[id_kelas]'
          AND tb_tugas.id_mapel = '$_GET[mapel]'
          ORDER BY kelas_tugas.id_tugas DESC 
        ");
      } elseif ($_GET['notifikasi']) {
        $tugas  = mysqli_query($con,"SELECT kelas_tugas.id_tugas FROM kelas_tugas 
          JOIN tb_tugas ON kelas_tugas.id_tugas = tb_tugas.id_tugas
          INNER JOIN tb_guru ON tb_tugas.id_guru  = tb_guru.id_guru
          LEFT OUTER JOIN (
            SELECT notifikasi_tugas.* FROM notifikasi_tugas
            JOIN tb_siswa ON notifikasi_tugas.id_siswa = tb_siswa.id_siswa
            WHERE tb_siswa.id_siswa = '$_SESSION[Siswa]'
          ) notif ON tb_tugas.id_tugas = notif.id_tugas
          WHERE id_kelas  = '$_SESSION[id_kelas]'
          AND kelas_tugas.aktif = 'Y'
          AND notif.id_tugas IS NULL
          ORDER BY kelas_tugas.id_tugas DESC 
        ");
        $kelas  = mysqli_query($con,"SELECT * FROM kelas_tugas 
          JOIN tb_tugas ON kelas_tugas.id_tugas = tb_tugas.id_tugas
          WHERE id_kelas  = '$_SESSION[id_kelas]'
          ORDER BY kelas_tugas.id_tugas DESC 
        ");
        foreach ($tugas as $key) {
          mysqli_query($con, "INSERT INTO notifikasi_tugas  
            VALUES (
              NULL,
              '$_SESSION[Siswa]',
              '$key[id_tugas]'
            )
          ");
        }
      } else {
        // cek tabel tugas
        $kelas  = mysqli_query($con,"SELECT * FROM kelas_tugas 
          JOIN tb_tugas ON kelas_tugas.id_tugas = tb_tugas.id_tugas
          WHERE id_kelas  = '0'
          ORDER BY kelas_tugas.id_tugas DESC 
        ");
      }
    } 

    if ($_GET['page'] == 'pengumuman') {
      $pengumuman = mysqli_query($con, "SELECT tb_pengumuman.* FROM tb_pengumuman 
        JOIN tb_roleguru ON tb_pengumuman.roleguru = tb_roleguru.id_roleguru
        LEFT OUTER JOIN (
          SELECT notifikasi_pengumuman.* FROM notifikasi_pengumuman
          JOIN tb_siswa ON notifikasi_pengumuman.id_siswa = tb_siswa.id_siswa
          WHERE tb_siswa.id_siswa = '$_SESSION[Siswa]'
        ) notif ON tb_pengumuman.id = notif.id_pengumuman
        WHERE tb_roleguru.id_kelas = '$_SESSION[id_kelas]'
        AND notif.id_pengumuman IS NULL
        ORDER BY id ASC
      ");
      foreach ($pengumuman as $key) {
        mysqli_query($con, "INSERT INTO notifikasi_pengumuman  
          VALUES (
            NULL,
            '$_SESSION[Siswa]',
            '$key[id]'
          )
        ");
      }
    }?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>E-learning | <?=$data['nama_siswa']; ?></title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="../vendor/node_modules/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../vendor/node_modules/simple-line-icons/css/simple-line-icons.css">
          <!-- plugin css for this page -->
        <link rel="stylesheet" href="../vendor/node_modules/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../vendor/css/style.css">
        <link rel="shortcut icon" href="../vendor/images/smpdw.png" />
        <link href="../vendor/sweetalert/sweetalert.css" rel="stylesheet" />
        <script src="../vendor/js/jquery.min.js"></script>
          <script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>
        <script type="text/javascript" src="../vendor/ckeditor/ckeditor.js"></script>
        <link rel="stylesheet" type="text/css" href="../vendor/css/jquery.dataTables.css">
        <script type="text/javascript" src="js/main.js"></script>
        <link href="css/ujian.css" rel="stylesheet">
        <script type="text/javascript" src="js/sidein_menu.js"></script>
        <script>
          function disableBackButton() {
              window.history.forward();
          }
          setTimeout("disableBackButton()", 0);
        </script>
      </head>
      <body>
        <div class="container-scroller">
          <!-- partial:../../partials/_navbar.html -->
          <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background-color: #1991eb;">
              <a class="navbar-brand brand-logo" href="index.php" style="font-family:Aegyptus;font-weight: bold;font-size: 30px;">
                <img src="../vendor/images/<?=$apl['logo'];?>" alt="logo" style="height: 45px;width: 45px;border-radius: 10px;"> <b><?=$apl['textlogo'];?></b>
              </a>
              <a class="navbar-brand brand-logo-mini" href="index.php">
              </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
              <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
                <li class="nav-item" style="width: 400px;">
                  <a href="#" style="color: #fff;text-decoration: none;"> <b><?=$apl['nama_sekolah'];?></b></a>
                </li>
              </ul>
              <ul class="navbar-nav navbar-nav-right">
                <?php 
                // notifikasi materi baru
                  $no     =1;
                  $sqlmtr = mysqli_query($con,"SELECT tb_materi.* FROM tb_materi
                    INNER JOIN tb_roleguru ON tb_materi.id_roleguru = tb_roleguru.id_roleguru
                    LEFT OUTER JOIN (
                      SELECT notifikasi_materi.* FROM notifikasi_materi
                      JOIN tb_siswa ON notifikasi_materi.id_siswa = tb_siswa.id_siswa
                      WHERE tb_siswa.id_siswa = '$_SESSION[Siswa]'
                    ) notif ON tb_materi.id_materi = notif.id_materi
                    WHERE tb_roleguru.id_kelas  = '$data[id_kelas]'
                    AND notif.id_materi IS NULL
                    AND tb_materi.public = 'Y'
                  ");
                  $jmlh = mysqli_num_rows($sqlmtr);
                  
                  $tugas  = mysqli_query($con,"SELECT * FROM kelas_tugas 
                    JOIN tb_tugas ON kelas_tugas.id_tugas = tb_tugas.id_tugas
                    INNER JOIN tb_guru ON tb_tugas.id_guru  = tb_guru.id_guru
                    LEFT OUTER JOIN (
                      SELECT notifikasi_tugas.* FROM notifikasi_tugas
                      JOIN tb_siswa ON notifikasi_tugas.id_siswa = tb_siswa.id_siswa
                      WHERE tb_siswa.id_siswa = '$_SESSION[Siswa]'
                    ) notif ON tb_tugas.id_tugas = notif.id_tugas
                    WHERE id_kelas  = '$_SESSION[id_kelas]'
                    AND kelas_tugas.aktif = 'Y'
                    AND notif.id_tugas IS NULL
                    ORDER BY kelas_tugas.id_tugas DESC 
                  ");
                  $jumlahTugas  = mysqli_num_rows($tugas);
                  
                  $pengumuman = mysqli_query($con, "SELECT tb_pengumuman.* FROM tb_pengumuman 
                    JOIN tb_roleguru ON tb_pengumuman.roleguru = tb_roleguru.id_roleguru
                    LEFT OUTER JOIN (
                      SELECT notifikasi_pengumuman.* FROM notifikasi_pengumuman
                      JOIN tb_siswa ON notifikasi_pengumuman.id_siswa = tb_siswa.id_siswa
                      WHERE tb_siswa.id_siswa = '$_SESSION[Siswa]'
                    ) notif ON tb_pengumuman.id = notif.id_pengumuman
                    WHERE tb_roleguru.id_kelas = '$_SESSION[id_kelas]'
                    AND notif.id_pengumuman IS NULL
                    ORDER BY id ASC
                  ");
                  
                  $jumlahPengumuman = mysqli_num_rows($pengumuman);
                  $jumlahNotifikasi = $jmlh + $jumlahTugas + $jumlahPengumuman;  
                ?>
                <li class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="mdi mdi-bell-ring"></i>
                    <?= $jumlahNotifikasi > 0 ? '<span class="count">' . $jumlahNotifikasi . '</span>' : ''; ?>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <a href="?page=materi" class="dropdown-item">
                      <p class="mb-0 font-weight-normal float-left"><b><?=$jmlh; ?></b> Materi Pelajaran
                      </p>
                      <span class="badge badge-pill badge-warning float-right">Lihat Semua</span>
                    </a>
                    <a href="?page=tugas&notifikasi=1" class="dropdown-item">
                      <p class="mb-0 font-weight-normal float-left"><b><?=$jumlahTugas; ?></b> Tugas
                      </p>
                      <span class="badge badge-pill badge-warning float-right">Lihat Semua</span>
                    </a>
                    
                    <a href="?page=pengumuman" class="dropdown-item">
                      <p class="mb-0 font-weight-normal float-left"><b><?=$jumlahPengumuman; ?></b> Pengumuman
                      </p>
                      <span class="badge badge-pill badge-warning float-right">Lihat Semua</span>
                    </a>
                  </div>
                </li>
                <li class="nav-item d-none d-lg-block">
                  <a class="nav-link" href="?page=profil">
                    <img class="img-xs rounded-circle" src="../vendor/images/img_Siswa/<?=$data['foto']; ?>" alt="">
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
                        <img src="../vendor/images/img_Siswa/<?=$data['foto']; ?>" alt="image" style="border:3px solid black;"/> 
                      </a>
                      <span class="online-status online"></span> 
                    </div>
                    <div class="profile-name">
                      <p class="name"><?=$data['nama_siswa']; ?></p>
                      <p class="designation">Siswa</p>
                      <div class="badge badge-teal mx-auto mt-3"><?=$data['status']; ?></div>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php"><img class="menu-icon" src="../vendor/images/menu_icons/01.png" alt="menu icon"><span class="menu-title">DASHBOARD</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?page=chat"><i class="fa fa-wechat text-success menu-icon"></i><span class="menu-title"> Chat</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?page=materi"><img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon">MATERI</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?page=tugas"><img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <span class="menu-title">TUGAS </span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?page=evaluasi&act=nilai"><img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> <span class="menu-title">NILAI ULANGAN </span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?page=informasi">
                    <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> 
                    <span class="menu-title">INFORMASI</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?page=pengumuman">
                    <img class="menu-icon" src="../vendor/images/menu_icons/04.png" alt="menu icon"> 
                    <span class="menu-title">PENGUMUMAN</span>
                  </a>
                </li>
                <hr>
                <li class="nav-item purchase-button">
                  <a class="nav-link" href="logout.php?ID=<?php echo $data['id_siswa'] ?>">Keluar</a>
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
                if ($page=='materi') {
                  if ($act=='') {
                    include 'modul/materi/data_materi.php';
                  } elseif ($act=='mapel') {
                    include 'modul/materi/view_mapel.php';
                  } elseif ($act=='semester') {
                    include 'modul/materi/view_semester.php';
                  }
                } elseif ($page=='profil') {
                  if ($act=='') {
                    include 'modul/profil/data_profil.php';
                  }
                } elseif ($page=='evaluasi') {
                  if ($act=='') {
                    include 'modul/evaluasi/data_soal.php';
                  } elseif ($act='nilai') {
                    include 'modul/evaluasi/data_nilai.php';
                  }
                }elseif ($page=='ujian') {
                  if ($act=='') {
                    include 'modul/evaluasi/info_ujian.php';
                  }
                } elseif ($page=='chat') {
                  if ($act=='') {
                    include 'modul/chat/chat.php';
                  } elseif ($act=='del') {
                    include 'modul/chat/del.php';
                  }
                }elseif ($page=='tugas') {
                  if ($act=='') {
                    include 'modul/tugas/data_tugas.php';
                  }elseif ($act=='upload') {
                    include 'modul/tugas/upload_tugas.php';
                  }
                }elseif ($page == 'informasi') {
                  include 'modul/informasi.php';
                }elseif ($page == 'pengumuman') {
                  include 'modul/pengumuman.php';
                }elseif ($page=='proses') {
                  include 'modul/models.php';
                  include '../media/story.html';
                }elseif ($page=='') {
                  // include 'Home.php';
                        ?> 
                      <div class="content-wrapper">
                      <h3> <b>Dashboard</b> <small class="text-muted">/Siswa</small>
                      </h3>
                      <hr>
                      <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-body">
                              
                              <div id="isi"> </div>  

                              </div>
                              </div>                  
                        </div>
                      </div>
                      </div>

                        <?php
                      }else{
                        echo "<b>4014!</b> Tidak ada halaman !";
                      }

                      ?>
                
                <!-- End-kontent -->
        
              <!-- content-wrapper ends -->
              <!-- partial:../../partials/_footer.html -->
              <footer class="footer">
                <div class="container-fluid clearfix">
                  <span class="text-info d-block text-center text-sm-left d-sm-inline-block"><?=$apl['copyright'];?></span>
                  <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><?=$apl['nama_sekolah'];?> <i class="fa fa-graduation-cap text-danger"></i></span>
                </div>
              </footer>
              <!-- partial -->
            </div>
            <!-- main-panel ends -->
          </div>
          <!-- page-body-wrapper ends -->
        </div>
        <script src="../vendor/js/jquery.dataTables.js"></script>
        <script src="../vendor/node_modules/popper.js/dist/umd/popper.min.js"></script>
        <script src="../vendor/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../vendor/sweetalert/sweetalert.min.js"></script>
        <script src="script1.js"></script>
        <script src="../vendor/js/off-canvas.js"></script>
        <script src="../vendor/js/misc.js"></script>
        <script>
          <?php
            if ($_GET['page'] == 'tugas') { ?>
              CKEDITOR.replace('ckeditor',{
                filebrowserImageBrowseUrl : '../vendor/kcfinder'
              });
            <?php }
          ?>

          $(document).ready(function() {
            $('#data').DataTable();
          });
        </script>
      </body>
      </html>
    <?php } else {
      include 'modul/500.html';
    }
?>