<?php
  $del  = mysqli_query($con,"DELETE FROM tb_master_mapel WHERE id_mapel='$_GET[id]' ") or die(mysqli_error($con));
  if ($del) {	
    echo "
      <script type='text/javascript'>
        setTimeout(function () {
          swal({
            title : 'SUKSES',
            text  :  'Data Telah dihapus !!',
            type  : 'success',
            timer : 3000
          });     
        },10);  
        window.setTimeout(function(){ 
          window.location.replace('?page=mapel&alert=Data berhasil dihapus');
        } ,3000);   
      </script>";
  }
?>