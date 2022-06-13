<?php
// hapus gambar
$data  = mysqli_fetch_assoc(mysqli_query($con, "SELECT gambar FROM soal WHERE id_soal='$_GET[ids]'"));
unlink("../vendor/images/img_Soal/" . $data['gambar']);
$sql = mysqli_query($con, "DELETE FROM soal WHERE id_soal='$_GET[ids]' ");
if ($sql) {
	echo "
	<script type='text/javascript'>
	setTimeout(function () {
	swal({
	title: 'Sukses',
	text:  'Data Telah Terhapus !',
	type: 'success',
	timer: 1000,
	showConfirmButton: false
	});     
	},10);  
	window.setTimeout(function(){ 
	window.location.replace('?page=ujian&act=soal&id=$_GET[id]');
	} ,1000);   
	</script>";
}
