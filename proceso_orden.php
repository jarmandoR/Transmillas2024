<?php
require("login_autentica.php"); 
include("declara.php");
$array_cursos = $_POST['miorden'];
print_r ($array_cursos);
$orden = 0;
foreach($array_cursos as $id_curso){
	echo$sles8= "UPDATE ord_recoentregas SET orden = $orden WHERE orden_id = $id_curso";
	$DB_m3->Execute($sles8); 	
	$orden++;
}
echo "<p><span style='color: green;'>La lista ha sido cambiada.</span></p>";