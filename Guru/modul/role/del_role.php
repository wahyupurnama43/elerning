<?php
$role = mysqli_query($con, "SELECT * 
    FROM tb_roleguru
    WHERE id_roleguru = '$_GET[id]'
  ") or die(mysqli_error($con));
$data_role  = mysqli_fetch_assoc($role);

mysqli_query($con, "UPDATE jadwal 
    SET status = 'belum'
    WHERE id_jadwal = '$data_role[jadwal_id]'
  ") or die(mysqli_error($con));

//Hapus materi
mysqli_query($con, "DELETE FROM tb_materi 
    WHERE id_roleguru = '$_GET[id]'
  ");

//Hapus tugas
$tugas  = mysqli_query($con, "SELECT * FROM tb_tugas 
    WHERE id_guru = '$data_role[id_guru]'
    AND id_mapel  = '$data_role[id_mapel]' 
  ");

foreach ($tugas as $key) {
  mysqli_query($con, "DELETE FROM kelas_tugas 
      WHERE id_tugas = '$key[id_tugas]' 
    ");
}

mysqli_query($con, "DELETE FROM tb_tugas 
    WHERE id_guru = '$data_role[id_guru]'
    AND id_mapel  = '$data_role[id_mapel]' 
  ");

//Hapus ujian dan nilai
$ujian  = mysqli_query($con, "SELECT * FROM ujian 
    WHERE id_guru = '$data_role[id_guru]'
    AND id_mapel  = '$data_role[id_mapel]' 
  ");

foreach ($ujian as $key) {
  mysqli_query($con, "DELETE FROM nilai 
      WHERE id_ujian = '$key[id_ujian]' 
    ");

  mysqli_query($con, "DELETE FROM kelas_ujian 
      WHERE id_ujian = '$key[id_ujian]' 
    ");
}

mysqli_query($con, "DELETE FROM ujian 
    WHERE id_guru = '$data_role[id_guru]'
    AND id_mapel  = '$data_role[id_mapel]' 
  ");

//Hapus pengumuman
mysqli_query($con, "DELETE FROM tb_pengumuman 
    WHERE roleguru  = '$_GET[id]' 
  ");

$del = mysqli_query($con, "DELETE FROM tb_roleguru WHERE id_roleguru='$_GET[id]' ") or die(mysqli_error($con));
if ($del) {

  echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'SUKSES',
	text:  'JADWAL MAPEL BERHASIL DIHAPUS',
	type: 'success',
	timer: 1000,
	showConfirmButton: false
	});     
	},10);  
	window.setTimeout(function(){ 
	window.location.replace('?page=mapel');
	} ,1000);   
	</script>";
}
