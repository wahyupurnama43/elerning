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
  <h3><b>Chat Box</b><small class="text-muted"></h3>
  <hr>
  <div class="row">
    <!-- style="overflow:scroll;height:600px;border-radius:10px;background-color:#fff;border:7px solid;" -->
    <div class="col-md-12 col-xs-12 wrap" style="background-color:#F5F5F5;border-radius:20px; overflow:scroll;height:600px;">
      <div class="mt-3">
        <h4><b><i class="fa fa-wechat text-success"></i></b> <b class="text-success">Chat</b> Box</h4>
        <hr>
        <form action="" method="post">
          <div class="form-group">
            <select class="form-control" name="id_roleguru" onchange="cek_database()" id="id_roleguru" style="font-weight: bold;font-size: 16px; border-radius: 10px;" required>
              <option>Kirim Ke</option>
              <?php
                $sqlMapel = mysqli_query($con, "SELECT * FROM tb_roleguru
                  INNER JOIN tb_master_kelas ON tb_roleguru.id_kelas=tb_master_kelas.id_kelas
                  INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel
                  WHERE tb_roleguru.id_guru='$sesi'
                ");
                while($mapel=mysqli_fetch_array($sqlMapel)){
                  echo "<option value='$mapel[id_roleguru]'>Kelas $mapel[kelas] - $mapel[mapel]</option>";
                }
              ?>
            </select>
            <!-- <input type="hidden" name="idpengirim" id="id_guru"> -->
            <input type="hidden" name="idkelas" id="id_kelas">
          </div>
          <div class="form-group">
            <label for="">Batas Waktu (Jam)</label>
            <input type="number" name="batas_waktu" class="form-control" min="0">
          </div>
          <div class="form-group">
            <button name="sendMassageMassal" type="submit" class="btn btn-light"><i class="fa fa-send"></i> Kirim</button>
          </div>
        </form>
        <?php 
          if (isset($_POST['sendMassageMassal'])) {
            $waktuMulai   = strtotime('now');
            $waktuSelesai = $waktuMulai + ($_POST['batas_waktu'] * 60 * 60);
            $send         = mysqli_query($con, "INSERT INTO chat VALUES('null', '$_POST[id_roleguru]','$waktuMulai', '$_POST[batas_waktu]', '$waktuSelesai')");
            if ($send) {
            echo "
              <script type='text/javascript'>
                setTimeout(function () {
                  swal({
                    title             : 'SUKSES',
                    text              : 'CHAT BERHASIL DIBUAT',
                    type              : 'success',
                    timer             : 3000,
                    showConfirmButton : true
                  });     
                },10);  
                window.setTimeout(function(){ 
                  window.location='?page=chat';
                } ,3000);
              </script>";                        
            }                   
          }
          // Tampilkan Role Guru
          $chat     = mysqli_query($con, "SELECT * FROM chat 
          JOIN tb_roleguru ON chat.id_roleguru = tb_roleguru.id_roleguru
          JOIN tb_master_mapel ON tb_roleguru.id_mapel = tb_master_mapel.id_mapel 
          WHERE tb_roleguru.id_guru='$sesi'") or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($chat))
          { 
            if (strtotime('now') > $row['waktu_selesai']) {
              mysqli_query($con, "DELETE FROM `chat` WHERE `id_chat`='$row[id_chat]'") or die(mysqli_error($con));
              mysqli_query($con, "DELETE FROM `isi_chat` WHERE `id_chat`='$row[id_chat]'") or die(mysqli_error($con));
            } ?>
            <div class="alert alert-secondary"><a href="?page=chat&act=lihat&id=<?= $row['id_chat']; ?>"><?= $row['mapel']; ?></a></div>
          <?php }
        ?>
      </div>  
    </div>
  </div>