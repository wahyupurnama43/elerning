<?php
$sql = mysqli_query($con,"INSERT INTO kelas_tugas VALUES('null','$_GET[tugas]','$_GET[kelas]',null,'N') ");
if ($sql) {
    echo "
    <script>
    window.location='?page=tugas';
    </script>  
    ";
}
?>
