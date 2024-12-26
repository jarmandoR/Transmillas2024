<?php
require("login_autentica.php");
include("cabezote1.php");
include("cabezote4.php");
$mensaje= "";

 $sql="SELECT `exa_idexamen`, CONCAT(`exa_nombre`, '|' , `exa_codigo`) as codname FROM `examenes` where exa_codigo like '%$valorBusqueda%' or exa_nombre like '%$valorBusqueda%'  ";		
 $mensaje.= "<option value=''>$sql</option>";
 
 $DB1->Execute($sql);
	//$mensaje.= "<select name='codname' id='codname'>";
	
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
	 $mensaje.= "<option value='$rw1[0]'>$rw1[1]</option>";
	}
//$mensaje.= "</select>";
	echo $mensaje;
	
	
?>
