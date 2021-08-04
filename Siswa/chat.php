<?php 
  if (isset($_POST['sendMassage'])) {
    $tanggal  = date('Y-m-d');
    $send     = mysqli_query($con, "INSERT INTO pesan 
      VALUES(
        'null',
        '$_POST[pengirim]',
        '$_POST[penerima]',
        '$tanggal',
        'Re: $_POST[isi_pesan]',
        'belum',
        '$_POST[kelas]'
      )
    ");
    if ($send) {
      $ubah = mysqli_query($con,"UPDATE pesan SET sudah_dibaca='sudah' WHERE id_pesan='$_POST[status]' ");
      if ($ubah) {
        echo "
        <script type='text/javascript'>
          setTimeout(function () {
            swal({
              title             : 'Sukses',
              text              : 'Terkirim',
              type              : 'success',
              timer             : 3000,
              showConfirmButton : true
            });     
          },10);  
          window.setTimeout(function(){ 
            window.location='index.php';
          } ,3000);
        </script>"; 
      }
    }                   
  } elseif (isset($_POST['sendMassageMassal'])) {
    $tanggal  = date('Y-m-d');
    $send     = mysqli_query($con, "INSERT INTO pesan 
      VALUES(
        'null',
        '$_POST[idpengirim]',
        '$_POST[penerima]',
        '$tanggal',
        '$_POST[pesan]',
        'belum',
        '$_POST[idkelas]'
      )
    ");
    if ($send) {
      echo "
      <script type='text/javascript'>
        setTimeout(function () {
          swal({
            title             : 'Sukses',
            text              : 'Terkirim',
            type              : 'success',
            timer             : 3000,
            showConfirmButton : true
          });     
        },10);  
        window.setTimeout(function(){ 
          window.location='index.php';
        } ,3000);
      </script>";                        
    }                   
  }  
?>