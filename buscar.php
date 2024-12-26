<?php
require("login_autentica.php");
include("cabezote1.php");
include("cabezote4.php");
$mensaje= "";
if($idcodigoname=="codigo"){
$sql="SELECT `idcodigo`, `cod_codigo`, `cod_descripcion` FROM `codigo` where cod_codigo like '$valorBusqueda%'  order by idcodigo  ";	

}else if($idcodigoname=="name"){
	
$sql="SELECT `idcodigo`, `cod_codigo`, `cod_descripcion` FROM `codigo` where cod_descripcion like '$valorBusqueda%'  order by idcodigo  ";	
}
else{
 $sql="SELECT `idcodigo`, `cod_codigo`, `cod_descripcion` FROM `codigo`  order by idcodigo  limit 1000 ";		
 $mensaje.= "<option value=''>Seleccione...</option>";
 }
 $DB1->Execute($sql);
	//$mensaje.= "<select name='codname' id='codname'>";
	
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
	 $mensaje.= "<option value='$rw1[0]'>$rw1[1]-$rw1[2]</option>";
	}
//$mensaje.= "</select>";
	echo $mensaje;
?>
