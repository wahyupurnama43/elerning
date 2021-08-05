<?php 
  // jumlah mapel yg diampu
  $mapel  = mysqli_num_rows(mysqli_query($con,"SELECT id_mapel FROM tb_roleguru WHERE id_guru='$sesi' "));
  //perangkat
  $perangkat  = mysqli_num_rows(mysqli_query($con,"SELECT id_tugas FROM tb_tugas WHERE id_guru='$sesi' "));

  // materi
  $materi = mysqli_num_rows(mysqli_query($con,"SELECT id_materi FROM tb_materi
    INNER JOIN tb_roleguru ON tb_materi.id_roleguru=tb_materi.id_roleguru
    WHERE tb_roleguru.id_guru='$sesi' "));
  // ujian
  $objektif = mysqli_num_rows(mysqli_query($con,"SELECT id_ujian FROM ujian WHERE id_guru='$sesi' "));
  $essay    = mysqli_num_rows(mysqli_query($con,"SELECT id_ujianessay FROM ujian_essay WHERE id_guru='$sesi' "));
  $ujian    = $objektif+$essay;

?>
<div class="content-wrapper">
  <h3><b>Dashboard</b><small class="text-muted">/Guru</small></h3>
  <hr>
  <div class="row">
    <!-- style="overflow:scroll;height:600px;border-radius:10px;background-color:#fff;border:7px solid;" -->
    <div class="col-md-12 col-xs-12 wrap" style="background-color:#F5F5F5;border-radius:20px; overflow:scroll;height:600px;">
      <div class="mt-3">
        <h4><b><i class="fa fa-wechat text-success"></i></b> <b class="text-success">Chat</b> Box</h4>
        <hr>
        <form action="" method="POST">
          <div class="form-group">
            <select class="form-control" name="mapel" id="mapel" style="font-weight: bold;font-size: 16px; border-radius: 10px;" required>
              <option>Pilih Mata Pelajaran</option>
              <?php
                $data_mapel  = mysqli_query($con, "SELECT * FROM tb_master_mapel");
                while($mapel = mysqli_fetch_array($data_mapel)){
                  echo "<option value='$mapel[id_mapel]'>$mapel[mapel]</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <button name="sendMassageMassal" type="submit" class="btn btn-light"><i class="fa fa-send"></i> Tampilkan Chat</button>
          </div>
        </form>
        <?php 
          if (isset($_POST['sendMassageMassal'])) {
            echo "
              <script type='text/javascript'>
                window.location='?page=chat&mapel=$_POST[mapel]';
              </script>";
          }
          if (isset($_GET['mapel'])) {  
            $chat = mysqli_query($con, "SELECT * FROM `isi_chat` 
              JOIN `chat` ON `isi_chat`.`id_chat`=`chat`.`id_chat` 
              JOIN `tb_roleguru` ON `chat`.`id_roleguru`=`tb_roleguru`.`id_roleguru`
              LEFT OUTER JOIN tb_guru ON isi_chat.id_user = tb_guru.id_guru
              LEFT OUTER JOIN tb_siswa ON isi_chat.id_user = tb_siswa.id_siswa 
              WHERE `tb_roleguru`.`id_mapel`='$_GET[mapel]'
              ORDER BY id_isi_chat
            ") or die(mysqli_error($con));
            $chat1  = mysqli_fetch_array($chat);
            if (strtotime('now') > $chat1['waktu_selesai']) {
              mysqli_query($con, "DELETE FROM `chat` WHERE `id_chat`='$row[id_chat]'") or die(mysqli_error($con));
              mysqli_query($con, "DELETE FROM `isi_chat` WHERE `id_chat`='$row[id_chat]'") or die(mysqli_error($con));
              die('<div class="alert alert-warning">Tidak ada chat disini</div>');
            }
            foreach ($chat as $row) {
              $id_chat  = $row['id_chat'];
              if ($sesi == $row['id_user']) { ?>
                <div class="row">
                  <div class="col-4"></div>
                  <div class="col-8">
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <div class="row">
                        <div class="col-2">
                          <img class="img-md rounded-circle" src="../vendor/images/img_Siswa/<?= $_SESSION['foto']; ?>" alt="">
                        </div>
                        <div class="col-10">
                          <strong><?= $row['nama_siswa']; ?> </strong><?= substr($row['tanggal'], 11, 5); ?><em style="font-size: 10px;"></em> <br><?= $row['isi_chat']; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } else { 
                if ($row['nama_siswa']) {
                  $nama   = $row['nama_siswa'];
                  $warna  = 'alert-secondary';
                  $url    = '../vendor/images/img_Siswa/';
                } else {
                  $nama   = $row['nama_guru'];
                  $warna  = 'alert-warning';
                  $url    = '../vendor/images/img_Guru/';
                  $guru   = mysqli_fetch_assoc(mysqli_query($con, "SELECT foto FROM tb_guru
                    WHERE id_guru = '$row[id_guru]'
                  "));
                  $row['foto']  = $guru['foto'];
                }
                ?>
                <div class="row">
                  <div class="col-8">
                    <div class="alert <?= $warna; ?> alert-dismissible" role="alert">
                      <div class="row">
                        <div class="col-2">
                          <img class="img-md rounded-circle" src="<?= $url . $row['foto']; ?>" alt="">
                        </div>
                        <div class="col-10">
                          <strong><?= $nama; ?> </strong><?= substr($row['tanggal'], 11, 5); ?><em style="font-size: 10px;"></em> <br><?= $row['isi_chat']; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-4"></div>
                </div>
              <?php }
            }
            if (mysqli_num_rows($chat) > 0) { ?>
              <form action="#" method="post">
                <div class="row">
                  <div class="col-10">
                    <input type="hidden" name="id_chat" value="<?= $id_chat; ?>">
                    <textarea name="isi_chat" id="isi_chat" cols="30" rows="5" placeholder="Tulis Pesan" class="form-control" required></textarea>
                  </div>
                  <div class="col-2">
                    <button name="kirimPesan" type="submit" class="btn btn-light"><i class="fa fa-send"></i> Kirim</button>
                  </div>
                </div>
              </form>
              <?php 
                if (isset($_POST['kirimPesan'])) {
                  $tanggal  = date('Y-m-d H:i:s');
                  $send     = mysqli_query($con, "INSERT INTO isi_chat VALUES('null', '$_POST[id_chat]', '$sesi', '$_POST[isi_chat]', '$tanggal')") or die(mysqli_error($con));
                  if ($send) {
                  echo "
                    <script type='text/javascript'>
                      window.location='?page=chat&mapel=$_GET[mapel]';
                    </script>";                        
                  }                   
                }
            }
          }
        ?>
      </div>  
    </div>
  </div>