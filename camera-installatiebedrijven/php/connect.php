
<?php

$servername = "localhost";
$username = "wwm_camera";
$password = "cctv03";
$dbname = "wwm_camera";

$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "";

?>