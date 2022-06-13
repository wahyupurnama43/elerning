<?php
$con = mysqli_query($con, "UPDATE tb_siswa SET aktif='Y',confirm='Yes' WHERE id_siswa='$_GET[id]' ") or die(mysqli_error($con));
if ($con) {

	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'CONFIRMASI SUKSES',
	text:  'AKUN TELAH AKTIF',
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
