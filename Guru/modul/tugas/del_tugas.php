<?php 

$sql=mysqli_query($con,"DELETE FROM tb_tugas WHERE id_tugas='$_GET[idt]' ");
	if ($sql) {
	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'SUKSES',
	text:  'TUGAS TELAH TERHAPUS',
	type: 'success',
	timer: 1000,
	showConfirmButton: false
	});     
	},10);  
	window.setTimeout(function(){ 
	window.location.replace('?page=tugas');
	} ,1000);   
	</script>";
	}
