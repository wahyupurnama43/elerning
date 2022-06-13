<?php

$close = mysqli_query($con, "UPDATE kelas_ujian SET aktif='N' WHERE id_ujian='$_GET[ujian]'  ");

if ($close) {
	echo "
			<script type='text/javascript'>
			setTimeout(function () {
			swal({
			title: 'ULANGAN TELAH DITUTUP',
			text:  'Terimakasih',
			type: 'success',
			timer: 1000,
			showConfirmButton: false
			});     
			},10);  
			window.setTimeout(function(){ 
			window.location.replace('?page=ujian');
			} ,1000);   
		</script>";
}
