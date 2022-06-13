<?php
$del = mysqli_query($con, "UPDATE tb_guru SET status='N',confirm='Yes' WHERE id_guru='$_GET[id]' ") or die(mysqli_error($con));
if ($del) {

	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'SUKSES',
	text:  'Akun ditolak',
	type: 'success',
	timer: 1000,
	showConfirmButton: false
	});     
	},10);  
	window.setTimeout(function(){ 
	window.location.replace('index.php');
	} ,1000);   
	</script>";
}
