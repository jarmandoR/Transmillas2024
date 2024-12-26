<?php

$dbname="transml9_transmillas"; 
$dbhost="transmillasweb.com";
$dbuser="transml9_jose";
$dbpass="dobarli23t2";
$Usu_ses="vive";
$salt = "transmi2344fsdfd"; 


$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");

$test_query = "SHOW TABLES FROM $dbname";
$result = mysqli_query($link, $test_query);

$tblCnt = 0;
while($tbl = mysqli_fetch_array($result)) {
  $tblCnt++;
  echo $tbl[0]."<br />\n";
}

if (!$tblCnt) {
  echo "There are no tables<br />\n";
} else {
  echo "There are $tblCnt tables<br />\n";
} 

echo "biennn okkkkkkk  ---";
echo $query = "SELECT   usu_usuario, usu_pass, usu_nombre, rol_nombre,usu_idsede FROM usuarios INNER JOIN roles ON roles_idroles=idroles  AND 
 (usu_estado=1 or usu_filtro=1)";
$result2 = mysqli_query($link, $query);

while($tbl2 = mysqli_fetch_array($result2)) {

  echo $tbl2[0]."<br />\n";
}
?>