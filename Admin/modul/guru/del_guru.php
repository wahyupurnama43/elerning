<?php
$data  = mysqli_query($con, "SELECT jadwal_id FROM tb_roleguru WHERE id_guru='$_GET[id]' ") or die(mysqli_error($con));

if (!empty($data)) {
  while ($jadwal = mysqli_fetch_assoc($data)) {
    $del2  = mysqli_query($con, "UPDATE jadwal SET status='belum' WHERE id_jadwal='$jadwal[jadwal_id]' ") or die(mysqli_error($con));
  }
}

$del2  = mysqli_query($con, "DELETE FROM tb_roleguru WHERE id_guru='$_GET[id]' ") or die(mysqli_error($con));
$del  = mysqli_query($con, "DELETE FROM tb_guru WHERE id_guru='$_GET[id]' ") or die(mysqli_error($con));
if ($del) {
  echo "
    <script type='text/javascript'>
      setTimeout(function () {
        swal({
          title             : 'SUKSES',
          text              :  'AKUN BERHASIL DIHAPUS',
          type              : 'success',
          timer             : 1000,
          showConfirmButton : false
        });     
      },10);  
      window.setTimeout(function(){ 
        window.location.replace('?page=guru');
      } ,1000);   
    </script>";
}
