<?php
  $del  = mysqli_query($con,"DELETE FROM jadwal 
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
          timer             : 3000,
          showConfirmButton : true
        });     
      },10);  
      window.setTimeout(function(){ 
        window.location='?page=jadwal&alert=Data berhasil dihapus!';
      } ,3000);   
    </script>";
  }
?>