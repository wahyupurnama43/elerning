<?php
  $status = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM nilai
    WHERE id_siswa  = '$_GET[id_siswa]'
    AND id_ujian  = '$_GET[id_ujian]'
  "));
    
  $soal = explode(',', $status['acak_soal']);

  if ($status['status'] !== NULL) {
    $jawaban          = explode(',', $status['status']);
    $index            = $_GET['index'];  

    switch ($_GET['status']) {
      case 'benar':
        if ($jawaban[$index] == 'salah') {
          $status['jml_benar']  += 1;
          $status['jml_salah']  -= 1;
        } else if ($jawaban[$index] == '') {
          $status['jml_benar']  += 1;
        }
        break;
      case 'salah':
        if ($jawaban[$index] == 'benar') {
          $status['jml_benar']  -= 1;
          $status['jml_salah']  += 1;
        } else if ($jawaban[$index] == '') {
          $status['jml_salah']  += 1;
        }
        break;
      
      default:
        # code...
        break;
    }
    $jawaban[$index]  = $_GET['status'];
    $jawabanfix       = implode(",", $jawaban);

    if ($status['jml_benar'] > 0) {
      $nilai  = $status['jml_benar'] / count($soal) * 100;
    } else {
      $nilai  = 0;
    }
    mysqli_query($con, "UPDATE nilai
      SET status    = '$jawabanfix',
          jml_benar = '$status[jml_benar]',
          jml_salah = '$status[jml_salah]',
          nilai     = '$nilai'
      WHERE id_siswa  = '$_GET[id_siswa]'
      AND id_ujian  = '$_GET[id_ujian]'
    ");
  } else {
    $jml_benar  = 0;
    $jml_salah  = 0;
    switch ($_GET['status']) {
      case 'benar':
        $jml_benar  += 1;
        break;
      case 'salah':
        $jml_salah  += 1;
        break;
      
      default:
        # code...
        break;
    }

    if ($jml_benar > 0) {
      $nilai  = $jml_benar / count($soal) * 100;
    } else {
      $nilai  = 0;
    }
    mysqli_query($con, "UPDATE nilai
      SET status    = '$_GET[status]',
          jml_benar = '$jml_benar',
          jml_salah = '$jml_salah',
          nilai     = '$nilai'
      WHERE id_siswa  = '$_GET[id_siswa]'
      AND id_ujian  = '$_GET[id_ujian]'
    ");
  }

  echo "
  <script type='text/javascript'>
    window.setTimeout(function(){ 
      window.location.replace('?page=input_nilai&id_siswa=$_GET[id_siswa]&id_ujian=$_GET[id_ujian]');
    } ,3000);   
  </script>";