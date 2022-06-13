<?php
$del  = mysqli_query($con, "DELETE FROM tb_master_mapel WHERE id_mapel='$_GET[id]' ") or die(mysqli_error($con));
if ($del) {
  echo "
      <script type='text/javascript'>
        setTimeout(function () {
          swal({
            title : 'SUKSES',
            text  :  'MAPEL BERHASIL DIHAPUS',
            type  : 'success',
            timer : 1000,
            showConfirmButton: false
          });     
        },10);  
        window.setTimeout(function(){ 
          window.location.replace('?page=mapel');
        } ,1000);   
      </script>";
}
