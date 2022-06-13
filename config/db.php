<?PHP
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$host = "localhost";
$user = "root";
$pass = "";
$db   = "smpdharmawiweka";

$con = new mysqli($host, $user, $pass, $db) or die(mysqli_error($con));

date_default_timezone_set('Asia/Ujung_Pandang');
