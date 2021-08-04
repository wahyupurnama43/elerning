<?php 
  $kelas_tugas  = mysqli_query($con, "SELECT * FROM kelas_tugas WHERE id_tugas='$_GET[tugas]'") or die(mysqli_error($con));
  if (mysqli_num_rows($kelas_tugas) > 0) {
    $aktif  = mysqli_query($con,"UPDATE kelas_tugas SET aktif='Y' WHERE id_tugas='$_GET[tugas]' ") or die(mysqli_error($con));
    if ($aktif) {
      echo "
        <script type='text/javascript'>
          setTimeout(function () {
            swal({
              title             : 'TUGAS TELAH AKTIF',
              text              :  '',
              type              : 'success',
              timer             : 3000,
              showConfirmButton : true
            });     
          },10);  
          window.setTimeout(function(){ 
            window.location.replace('?page=tugas');
          } ,3000);   
        </script>";
    }
  } else {
    echo "
      <script type='text/javascript'>
        setTimeout(function () {
          swal({
            title             : 'PILIH KELAS TERLEBIH DAHULU',
            text              :  '',
            type              : 'warning',
            timer             : 3000,
            showConfirmButton : true
          });     
        },10);  
        window.setTimeout(function(){ 
          window.location.replace('?page=tugas');
        } ,3000);   
      </script>";
  }
?>