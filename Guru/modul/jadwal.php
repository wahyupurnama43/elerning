<?php
include '../../config/db.php';

$jadwal = mysqli_query($con, "SELECT * FROM jadwal
    WHERE mata_pelajaran_id = '$_POST[mata_pelajaran_id]'
    AND kelas_id = '$_POST[kelas_id]'
    AND status = 'belum'
  ") or die(mysqli_error($con));

$rows = [];

while ($row = mysqli_fetch_assoc($jadwal)) {
  $rows[] = $row;
}
header('Content-type: application/json');
echo json_encode($rows);
  // print_r($rows);
