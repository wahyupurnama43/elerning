<?php
$del = mysqli_query($con, "DELETE FROM tb_materi WHERE id_materi='$_GET[ID]' ") or die(mysqli_error($con));
if ($del) {

	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'SUKSES',
	text:  'MATERI BERHASIL DIHAPUS',
	type: 'success',
	timer: 1000,
	showConfirmButton: false
	});     
	},10);  
	window.setTimeout(function(){ 
	window.location.replace('?page=materi');
	} ,1000);   
	</script>";
}
