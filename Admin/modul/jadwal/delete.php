<?php
$del  = mysqli_query($con, "DELETE FROM jadwal 
    WHERE id_jadwal = '$_GET[id]' 
  ") or die(mysqli_error($con));
if ($del) {
  echo "
    <script type='text/javascript'>
      setTimeout(function () {
        swal({
          title             : 'SUKSES',
          text              : 'JADWAL BERHASIL DIHAPUS',
          type              : 'success',
          timer             : 1000,
          showConfirmButton : false
        });     
      },10);  
      window.setTimeout(function(){ 
        window.location='?page=jadwal';
      } ,1000);   
    </script>";
}
