<?php
$del = mysqli_query($con,"DELETE FROM tb_jenisujian WHERE id_jenis='$_GET[id]' ") or die(mysqli_error($con));
if ($del) {	

	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'SUKSES',
	text:  'ULANGAN BERHASIL DIHAPUS',
	type: 'success',
	timer: 3000,
	showConfirmButton: true
	});     
	},10);  
	window.setTimeout(function(){ 
	window.location.replace('?page=jenisujian');
	} ,3000);   
	</script>";
}

 ?>