<?php
# Fill our vars and run on cli
# $ php -f db-connect-test.php
echo "josee";

$dbname="u202535984_transmillas"; 
$dbhost="localhost";
$dbuser="u202535984_jose";
$dbpass="Dobarli23@";
$Usu_ses="vive";
$salt = "transmi2344fsdfd"; 



$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");

$test_query = "SHOW TABLES FROM $dbname";
$result = mysqli_query($link, $test_query);

 $query = "SELECT idusuarios, idroles, usu_usuario,usu_usuario, usu_pass, usu_nombre, rol_nombre,usu_idsede FROM usuarios INNER JOIN roles ON roles_idroles=idroles  AND 
 (usu_estado=1 or usu_filtro=1)";
$result = mysqli_query($link, $query);

$tblCnt = 0;
while($tbl = mysqli_fetch_array($result)) {

  echo $tbl[0]."<br />\n";
}





?>