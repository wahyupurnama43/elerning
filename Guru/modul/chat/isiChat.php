<div class="content-wrapper">
  <h3><b>Chat Box</b><small class="text-muted"></h3>
  <hr>
  <div class="row">
    <!-- style="overflow:scroll;height:600px;border-radius:10px;background-color:#fff;border:7px solid;" -->
    <div class="col-md-12 col-xs-12 wrap" style="background-color:#F5F5F5;border-radius:20px; overflow:scroll;height:600px;">
      <div class="mt-3">
        <h4><b><i class="fa fa-wechat text-success"></i></b> <b class="text-success">Chat</b> Box</h4>
        <hr>
        <?php
          $id       = $_GET['id'];  
          $isiChat  = mysqli_query($con, "SELECT * FROM isi_chat 
            LEFT OUTER JOIN tb_guru ON isi_chat.id_user = tb_guru.id_guru
            LEFT OUTER JOIN tb_siswa ON isi_chat.id_user = tb_siswa.id_siswa 
            WHERE id_chat = '$id'
            ORDER BY id_isi_chat
          ") or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($isiChat))
          {
            if ($sesi == $row['id_user']) { ?>
              <div class="row">
                <div class="col-4"></div>
                <div class="col-8">
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="row">
                      <div class="col-2">
                        <img class="img-md rounded-circle" src="../vendor/images/img_Guru/<?= $_SESSION['foto']; ?>" alt="">
                      </div>
                      <div class="col-10">
                        <strong><?= $row['nama_guru']; ?> </strong><?= substr($row['tanggal'], 11, 5); ?><em style="font-size: 10px;"></em> <br><?= $row['isi_chat']; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } else { ?>
                <div class="row">
                  <div class="col-8">
                    <div class="alert alert-secondary" role="alert">
                      <div class="row">
                        <div class="col-2">
                          <img class="img-md rounded-circle" src="../vendor/images/img_Siswa/<?= $row['foto']; ?>" alt="">
                        </div>
                        <div class="col-10">
                          <strong><?= $row['nama_siswa']; ?> </strong><?= substr($row['tanggal'], 11, 5); ?><em style="font-size: 10px;"></em> <br><?= $row['isi_chat']; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-4"></div>
                </div>
            <?php }
          } ?>
          <form action="" method="post">
            <div class="row">
              <div class="col-md-10">
                <input type="hidden" name="id_chat" value="<?= $datachat['id_chat']; ?>">
                <textarea name="isi_chat" id="isi_chat" cols="30" rows="5" placeholder="Tulis Pesan" class="form-control" required></textarea>
              </div>
              <div class="col-md-2">
                <button name="kirimPesan" type="submit" class="btn btn-light"><i class="fa fa-send"></i> Kirim</button>
                <a href="?page=chat" class="btn btn-danger">Kembali</a>
              </div>
            </div>
          </form>
          <?php 
            if (isset($_POST['kirimPesan'])) {
              $tanggal  = date('Y-m-d H:i:s');
              $send     = mysqli_query($con, "INSERT INTO isi_chat VALUES('null', '$id', '$sesi', '$_POST[isi_chat]', '$tanggal')");
              if ($send) {
              echo "
              <script type='text/javascript'>
                window.location='?page=chat&act=lihat&id=" . $id . "';
              </script>";                        
              }                   
            }
          ?>
      </div>  
    </div>
  </div>




























