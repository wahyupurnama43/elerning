<?php
$del = mysqli_query($con, "DELETE FROM tb_siswa WHERE id_siswa='$_GET[id]' ") or die(mysqli_error($con));
if ($del) {

	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'SUKSES',
	text:  'AKUN BERHASIL DIHAPUS',
	type: 'success',
	timer: 1000,
	showConfirmButton: false
	});     
	},10);  
	window.setTimeout(function(){ 
	window.location.replace('?page=siswa');
	} ,1000);   
	</script>";
}
