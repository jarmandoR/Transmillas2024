<?php 
require("login_autentica.php");
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$id_encuesta=$_SESSION['id_encuesta'];
$p1=$_REQUEST["p1"];
$p2=$_REQUEST["p2"];
$FB = new funciones_varias;
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$param_edicion=1;
?>
<table width="100%" border="1"><tr>
<?php

/*
// Codificar de acuerdo a lo que se muestra
if($p2!=""){$cond2=" AND idpreguntas='$p2'"; } else { $cond2=""; }
$sql="SELECT idpreguntas, pre_pregunta FROM preguntas WHERE encuestas_idencuestas='$id_encuesta' $cond2 ORDER BY pre_tipo, CAST(pre_codigo AS UNSIGNED) ASC";
$DB->Execute($sql); 
while($rw=mysqli_fetch_row($DB->Consulta_ID))
{
	echo "<td>".reemplazo($rw[1])."</td>";
}
echo "</tr>";

$sql="SELECT idpreguntas, pre_pregunta, pre_tipo, pre_vienede, pre_tipoindicador, pre_array, pre_soporte, pre_codigo, pru_fecha, pru_respuesta, pru_idunico FROM preguntasusuarios INNER JOIN preguntas ON preguntas_idpreguntas=idpreguntas AND encuestas_idencuestas='$id_encuesta' $cond2  ORDER BY 
pru_idunico, pre_tipo, CAST(pre_codigo AS UNSIGNED) ASC, pru_fecha DESC ";
$DB->Execute($sql); $va=0; $tipo1=""; $unico="";
while($rw=mysqli_fetch_row($DB->Consulta_ID))
{
	$va++;
	$p=$va%2;
	$id_p=$rw[0];
	if($p==0){$color="#FFFFFF";}
	else{$color="#EFEFEF";}
	$uni=$rw[10];
	$tipo=$rw[2];
	$nombre=$rw[1];
	$idvienede=$rw[3];
	$codigo=$rw[7];
	$idtipoindi=$rw[4];
	$array=$rw[5];
	$tis="";
	if($tipo=="2. General"){
		$sql="SELECT idindicadores, int_nombre, ind_nombre, ind_clase, ind_descripcion, ind_array, ind_codigo FROM indicadores INNER JOIN tiposindicadores 
		ON tiposindicadores_idtiposindicadores=idtiposindicadores AND idindicadores='$idvienede' ";			
		$DB1->Execute($sql); 
		$rw1=mysqli_fetch_row($DB1->Consulta_ID);
		$nombre=$rw1[2];
		$idtipoindi=$rw1[1];
		$array=$rw1[5];
		$tis="Parametrizaci&oacute;n";
	}
	else if($tipo=="1. Indicad"){
		$sql="SELECT idactindgener, int_nombre, aci_nombre, aig_tipoindicador, aig_descripcion, aci_array, aig_codigo FROM actindgener 
		INNER JOIN tiposindicadores ON aig_tipoindicador=idtiposindicadores AND idactindgener='$idvienede' ";	
		$DB1->Execute($sql); 
		$rw1=mysqli_fetch_row($DB1->Consulta_ID);
		$nombre=$rw1[2];
		$idtipoindi=$rw1[1];
		$array=$rw1[5];
		$tis="Indicadores";
	}
	else if($tipo=="3. Pregunt"){
		$sql="SELECT idtiposindicadores, int_nombre FROM tiposindicadores WHERE idtiposindicadores='$idtipoindi' ";	
		$DB1->Execute($sql); 
		$rw1=mysqli_fetch_row($DB1->Consulta_ID);
		$idtipoindi=$rw1[1];
		$tis="Preguntas";
	}
	$tipo1=$tipo;
	if($uni!=$unico){echo "</tr><tr class='text'>";}
	$nome="pregs$va";
	echo "<td>$rw[9]</td>";
	$unico=$uni;
}
*/
?>
</table>