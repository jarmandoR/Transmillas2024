<?php 
require("login_autentica.php");
include("layout.php");
$tabla=$_REQUEST["tabla"];
$id_param=$_REQUEST["id_param"];
if(isset($_REQUEST["condecion"])){ $nivel=""; 
	if($_REQUEST["condecion"]!="0"){ $condecion=$_REQUEST["condecion"]; $ess=explode("-",$condecion); if(isset($ess[1])){$nivel=$ess[1]; $id_param=$ess[0];} }
} else { $condecion=""; }
if(isset($_REQUEST["id_param"])){$id_param=$_REQUEST["id_param"];}
switch($tabla){
	case "Nivel $nivel":
	$id_p=explode("-",$id_param); $id_param=$id_p[0];	
	$valores[0]="marcologico"; $valores[1]="idmarcologico, idvienede, mar_codigo, mar_nombre, mar_descipcion, mar_meta, mar_tipovar"; 
	$valores[3]="idmarcologico"; $valores[7]="";
	break;
	default:
	$valores=$LT->devuelvecampos($tabla, 0, "");
	break;
}
$rw=$QL->select($valores[0], $valores[1], $valores[3], $id_param, $DB, $valores[7]);
?>
<body onLoad="
<?php 
switch ($tabla)
{
	case "Meta Plan":	
//	echo "cambio_ajax2('$rw[1]', 63, 'llega_sub1', 'param2', 1, '$rw[2]')";
	break;
	case "Formulario":
	echo "cambio_ajax2(param1.value,133,'llega_sub1','param2',3,'$rw[2]'); 
	cambio_ajax2('$rw[2]',95,'llega_sub2','param4',1,'$rw[4]'); 
	cambio_ajax2(preg1.value, 244, 'llpr', 'param3', 2, '$id_param'); ";
	break;
	default:
	break;
}
?>">
<?php
$FB->abre_form("form1","nuevo_adminok.php","post");
$FB->titulo_azul1("Clonar $tabla","2","0", 4); 
switch ($tabla)
{
case "Meta Plan":
$FB->llena_texto("Tipo de plan:", 1, 2, $DB, "SELECT idniveles, niv_nombre FROM niveles WHERE proyectos_idproyectos=0 AND idniveles='$rw[1]' ORDER BY niv_orden","",$rw[1],2,1);
$FB->llena_texto("Nombre de meta del Plan:",2, 9, $DB, "", "", $rw[2],2,1);
$FB->llena_texto("Tipo valor:", 3, 2, $DB, "SELECT int_nombre, int_nombre FROM tiposindicadores ORDER BY int_nombre", "", $rw[3], 2, 1);
$FB->llena_texto("Meta:",4, 112, $DB, "", "", $rw[4],2,1);
$FB->llena_texto("Descripci&oacute;n:",5, 9, $DB, "", "", $rw[5],2,1);
$FB->llena_texto("C&oacute;digo:", 6, 81, $DB, "SELECT MAX(mar_codigo) FROM marcologico WHERE niveles_idniveles='$rw[1]' ", "", "", 2, 1);
$FB->llena_texto("Fecha inicial:",7, 10, $DB, "", "", $rw[7],2,1);
$FB->llena_texto("Fecha final:",8, 10, $DB, "", "", $rw[8],2,1);
$DB1->Execute("SELECT niv_orden FROM niveles WHERE idniveles='$rw[1]' "); 
$mose=$DB1->recogedato(0);
if($mose>2){ 
	$FB->llena_texto("Secretar&iacute;a de Educaci&oacute;n:",9,2,$DB,"SELECT idsecretarias,sec_nombre FROM secretarias ORDER BY sec_nombre","",$rw[9],2,0); 
	$FB->llena_texto("Meta PND:", 10, 2, $DB, "SELECT idmarcologico, mar_nombre FROM marcologico INNER JOIN niveles ON niveles_idniveles=idniveles AND proyectos_idproyectos=0
	 AND niv_orden=1 ORDER BY mar_codigo", "", $rw[10], 2, 0);
	$FB->llena_texto("Meta MEN:", 11, 2, $DB, "SELECT idmarcologico, mar_nombre FROM marcologico INNER JOIN niveles ON niveles_idniveles=idniveles AND proyectos_idproyectos=0
	 AND niv_orden=2 ORDER BY mar_codigo", "", $rw[11], 2, 0);
} 
else { 
	$FB->llena_texto("param9", 8, 13, $DB, "", "", "", 2, 1); 
	$FB->llena_texto("param10", 8, 13, $DB, "", "", "", 2, 1); 
	$FB->llena_texto("param11", 8, 13, $DB, "", "", "", 2, 1); 
} 
break; 
case "Formulario": 
$FB->llena_texto("Programa:",1,2,$DB,"SELECT idprogramas,prg_alias FROM programas ORDER BY prg_codigo",
"cambio_ajax2(this.value,133,\"llega_sub1\",\"param2\",3,0);",$rw[1],2,1);
$FB->llena_texto("Proyecto:", 2, 4, $DB, "llega_sub1", "", $rw[2],2,0);
$FB->llena_texto("Nombre del formulario:",3, 1, $DB, "", "", $rw[3],2,1);
$FB->llena_texto("Cabezote del formulario:", 2, 4, $DB, "llega_sub2", "", $rw[4],2,0);
$FB->llena_texto("Tipo de captura:", 6, 8, $DB, $tformato, "", $rw[5],2,1);
$sql1="SELECT COUNT(*) FROM preguntas1 WHERE actindgener_idactindgener='$id_param' ";
$DB->Execute($sql1);
$nu=$DB->recogedato(0);
?>
<tr><td>Cuantas preguntas requiere:</td><td align="right"><select class='form-control' id="preg1" name="preg1" onChange="cambio_ajax2(this.value,244,'llpr',param6.value,1,'<?php echo $id_param; ?>');"><?php for($i=0; $i<47; $i++){ if($nu==$i){ $cond="selected";} else { $cond=""; } echo "<option value='$i' $cond>$i</option>"; } ?></select>
</td></tr><tr><td colspan="2"><div id="llpr"></div></td></tr>
<?php
break; 
case "Meta Proyecto":
$FB->llena_texto("param1", 1, 13, $DB, "", "", $rw[1], 5, 0);
$FB->llena_texto("Contrato relacionado/Responsable meta:", 2, 23, $DB, "SELECT idcontratosproyectos, ent_nombre, cop_contrato FROM contratosproyectos INNER JOIN entidades ON 
entidades_identidades=identidades AND proyectos_idproyectos='$rw[1]' ORDER BY cop_contrato ", "", $rw[2], 2, 1);
$FB->llena_texto("Descripci&oacute;n", 3, 9, $DB, "", "", $rw[3], 2, 1);
$FB->llena_texto("Fecha Inicio", 4, 10, $DB, "", "", $rw[4], 2, 1);
$FB->llena_texto("Fecha Final", 5, 10, $DB, "", "", $rw[5], 2, 1);
$FB->llena_texto("Tipo valor:", 6, 2, $DB, "SELECT int_nombre, int_nombre FROM tiposindicadores ORDER BY int_nombre", "", $rw[6], 2, 1);
$FB->llena_texto("Meta", 7, 1, $DB, "", "", $rw[7], 2, 1);
$FB->llena_texto("Tipo de Meta", 8, 8, $DB, $tmet, "", $rw[8], 2, 1);
$FB->llena_texto("Documentos relacionados", 9, 6, $DB, "", "", "", 2, 0);
break;
} 
$FB->llena_texto("condecion", 1, 13, $DB, "", "", $condecion, 5, 0);
$FB->llena_texto("tabla", 1, 13, $DB, "", "", $tabla, 5, 0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("", 1, 14, $DB, "", "", 0, 1, 0);
$FB->cierra_form(); 
include("footer.php"); ?>