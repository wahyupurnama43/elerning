<?php
session_start();
include "../config/koneksi.php";
echo '
    <div class="grup">
      <div class="kiri">
        <div class="top-heading">
          <h4>Informasi Ulangan</h4></div> 
          <br>
  ';

//Cek jumlah ujian pada tanggal sekarang
$tgl    = date('Y-m-d');
$qujian = mysqli_query($mysqli, "SELECT * FROM ujian t1, kelas_ujian t2 
    WHERE t1.tanggal = '$tgl' 
    AND t1.id_ujian = t2.id_ujian 
    AND t2.id_kelas = '$_SESSION[id_kelas]' 
    AND t2.aktif    = 'Y'
    ORDER BY t1.jam_mulai ASC
  ");
$tujian = mysqli_num_rows($qujian);
$rujian = mysqli_fetch_array($qujian);

//Jika tidak ada ujian aktif tampilkan pesan
if ($tujian < 1 || (strtotime('now') <= strtotime($rujian['tanggal'] . ' ' . $rujian['jam_mulai'] . ':00'))) {
  echo '
      <div class="table-responsive">
        <table class="table table-striped" id="data">
          <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Pelajaran</th>
            <th>Jenis Ujian</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>';
} else {
  echo '
      <div class="table-responsive">
        <table class="table table-striped" id="data">
          <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Pelajaran</th>
            <th>Jenis Ujian</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
    ';
  $qujian = mysqli_query($mysqli, "SELECT * FROM kelas_ujian 
      INNER JOIN tb_master_kelas ON kelas_ujian.id_kelas=tb_master_kelas.id_kelas
      INNER JOIN ujian ON kelas_ujian.id_ujian=ujian.id_ujian
      INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
      WHERE ujian.tanggal = '$tgl' 
      AND ujian.id_ujian  = kelas_ujian.id_ujian 
      AND kelas_ujian.id_kelas  = '$_SESSION[id_kelas]' 
      AND kelas_ujian.aktif='Y'
    ");
  $no = 1;
  while ($r = mysqli_fetch_array($qujian)) {
    //Jika waktunya sudah tepat, maka ujian akan muncul
    if ((strtotime('now') >= strtotime($r['tanggal'] . ' ' . $r['jam_mulai'] . ':00')) && (strtotime('now') <= strtotime($r['tanggal'] . ' ' . $r['jam_selesai'] . ':00'))) {
      $kelas_ujian  = array();
      $qkelas_ujian = mysqli_query($mysqli, "SELECT * FROM tb_master_kelas t1, kelas_ujian t2
          WHERE  t1.id_kelas  = t2.id_kelas 
          AND t2.id_ujian = '$r[id_ujian]'
        ");
      while ($rku = mysqli_fetch_array($qkelas_ujian)) {
        $kelas_ujian[] = $rku['kelas'];
      }
      echo '
          <tr>
            <td><b>' . $no . '</b></td>
            <td><b>' . $r['judul'] . '</b></td>
            <td><b>' . $r['mapel'] . '</b></td>
        ';
      $jenis  = mysqli_query($mysqli, "SELECT * FROM tb_jenisujian 
          WHERE id_jenis='$r[id_jenis]'
        ");
      $ju = mysqli_fetch_array($jenis);
      echo '<td><b>' . $ju['jenis_ujian'] . '</b></td>';

      //Jika nilai sudah ada tampilkan tombol Sudah Mengerjakan, jika belum ada tampilkan tombol Kerjakan
      $qnilai = mysqli_query($mysqli, "SELECT * FROM nilai 
          WHERE id_ujian  = '$r[id_ujian]' 
          AND id_siswa  = '$_SESSION[id_siswa]' 
        ");
      $tnilai = mysqli_num_rows($qnilai);
      $rnilai = mysqli_fetch_array($qnilai);

      if ($tnilai > 0 and $rnilai['nilai'] != "")
        echo '
            <td bgcolor= bordercolordark="#00FF33" >
              <a class="btn btn-block">Selesai</a>
          ';
      elseif ($tnilai > 0 and $rnilai['sisa_waktu'] != "")
        echo "
          <td bgcolor='#FF3300'>
            <a onclick='show_ujian($r[id_ujian], `$r[kategori]`)'  class='btn btn-block'><i class='fa fa-check-circle-o'></i> Lanjutkan</a>";

      else echo "
          <td bgcolor='#FFFF00'>
            <a onclick='show_detail($r[id_ujian], `$r[kategori]`)' class='btn btn-block'><i class='fa fa-edit'></i> Kerjakan</a>
          </td>
        </tr>";

      $no++;
    }
  }
  echo '</tbody>
    </table>
    </div>';
}
?>
<br>

<!-- INFORMASI MENGENAI MATERI terpost -->
<?php
$no = 1;
$sqlmtr = mysqli_query($mysqli, "SELECT * FROM tb_materi

      INNER JOIN tb_roleguru ON tb_materi.id_roleguru=tb_roleguru.id_roleguru

    INNER JOIN tb_master_mapel ON tb_roleguru.id_mapel=tb_master_mapel.id_mapel

    INNER JOIN tb_master_semester ON tb_roleguru.id_semester=tb_master_semester.id_semester
    
   WHERE tb_roleguru.id_kelas='$_SESSION[kelas]'AND public='Y' ORDER BY tb_materi.id_materi DESC LIMIT 5 ");
$jml = mysqli_num_rows($sqlmtr);
foreach ($sqlmtr as $row) { ?>
  <div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Baru!</strong> Materi <b><?= $row['mapel'] ?> </b> Untuk kelas kamu ! <a href="?page=materi&act=mapel&ID=<?= $row['id_mapel']; ?>&mp=<?= $row['mapel']; ?>">Lihat</a>
  </div>
<?php
}
?>

<?php


echo '</div> ';
?>



<script type="text/javascript">
  function kirim_jawaban_essay(index) {
    var ujian = $('#ujian').val();
    var jawaban = document.getElementById('jawaban' + index).value;
    if (jawaban) {
      $.ajax({
        url: "ajax_ujian.php?action=kirim_jawaban",
        type: "POST",
        data: "ujian=" + ujian + "&index=" + index + "&jawab=" + jawaban,
        success: function(data) {
          if (data == "ok") {} else {
            alert(data);
          }
        },
        error: function() {
          alert('Tidak dapat mengirim jawaban!');
        }
      });
    }
  }

  function selesai_ujian_essay(ujian) {
    $.ajax({
      url: "ajax_ujian.php?action=selesai_ujian_essay",
      type: "POST",
      data: "ujian=" + ujian,
      success: function(data) {
        if (data == "ok") {
          $('#modal-selesai').modal('hide');
          $('#modal-selesai').on('hidden.bs.modal', function() {
            $('#isi').load('home.php');
          });
        } else {
          alert(data);
        }
      },
      error: function() {
        alert('Tidak dapat memproses nilai!');
      }
    });
    return false;
  }
</script>