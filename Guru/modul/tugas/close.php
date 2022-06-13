<?php

$close = mysqli_query($con, "UPDATE kelas_tugas SET aktif='N' WHERE id_tugas='$_GET[tugas]'  ");

if ($close) {
	echo "
			<script type='text/javascript'>
				setTimeout(function () {
					swal({
						title: 'KELAS TELAH DITUTUP',
						text:  '',
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
