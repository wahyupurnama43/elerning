<?php
$del = mysqli_query($con, "DELETE FROM tb_master_semester WHERE id_semester='$_GET[id]' ") or die(mysqli_error($con));
if ($del) {

	echo "
	<script type='text/javascript'>
	setTimeout(function () {
		swal({
			title: 'SUKSES',
			text:  'SEMESTER BERHASIL DIHAPUS',
			type: 'success',
			timer: 1000,
			showConfirmButton: false
		});     
	},10);  
	window.setTimeout(function(){ 
		window.location.replace('?page=semester');
	} ,1000);   
	</script>";
}
