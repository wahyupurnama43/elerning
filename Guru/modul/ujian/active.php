<?php 
  $kelas_ujian  = mysqli_num_rows(mysqli_query($con, "SELECT * FROM kelas_ujian
    WHERE id_ujian  = '$_GET[ujian]'
  "));
  if ($kelas_ujian > 0) {
    $aktif  = mysqli_query($con, "UPDATE kelas_ujian 
      SET aktif = 'Y' 
      WHERE id_ujian  = '$_GET[ujian]'
    ");
    if ($aktif) {
      echo "
        <script type='text/javascript'>
          setTimeout(function () {
            swal({
              title : 'ULANGAN TELAH AKTIF',
              text  : '',
              type  : 'success',
              timer : 3000
            });     
          },10);  
          window.setTimeout(function(){ 
            window.location.replace('?page=ujian');
          } ,3000);   
        </script>
      ";
    }
  } else {
    echo "
      <script type='text/javascript'>
        setTimeout(function () {
          swal({
            title : 'PILIH KELAS TERLEBIH DAHULU',
            text  : '',
            type  : 'error',
            timer : 3000
          });     
        },10);  
        window.setTimeout(function(){ 
          window.location.replace('?page=ujian');
        } ,3000);   
      </script>
    ";
  }
?>