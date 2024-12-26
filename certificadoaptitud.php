<?php 
require("login_autentica.php");
include("cabezote1.php"); 
//include("cabezote4.php"); 

$FB->abre_form("form1","edit_saludocupacional.php","post");

switch ($condecion)
{

	case "certificado":
	

 	$sql="SELECT `idsaludocupacional`, `sal_fecha`, `sal_fn`, `sal_idtipodocumento`, `sal_iddocumento`,
	`sal_nombre`, `sal_telefono`, `sal_empresa`,`sal_cargo`, `sal_actitudlaboral`,sal_idusuario,`sal_ingreso`,
	`sal_retiro`, `sal_periodico`, `sal_espconfinados`, `sal_traalturas`, `sal_manalimentos`,`sal_audiometria`, 
	`sal_audio_est`, `sal_optometria`, `sal_opt_est`, `sal_visiometria`, 	`sal_vis_est`, `sal_laboratorios`, 
	`sal_lab_est`, `sal_espirometria`, `sal_esp_est`, `sal_otros`, `sal_otr_est` ,`sal_recomendaciones`
	From saludocupacional WHERE idsaludocupacional='$id_param' ";
	$DB->Execute($sql); 
	$rw=mysqli_fetch_row($DB->Consulta_ID);  
	$FB->llena_texto("tabla", 15, 13, $DB, "", "", "saludocupacional", 5, 0);
	$param=$rw[0];

$FB->titulo_azul1(" CERTIFICADO DE APTITUD MEDICA OCUPACIONAL",14,0, 5);  
//echo "<tr><td colspan='4' align=center>(Segun lo dispuesto en las resoluciones 2346/2007/,1918/2009,1409/2012 y la NTC 4115)</td>	</tr>";	
$FB->llena_texto("Fecha:", 1, 10, $DB, "", "", $rw[1], 1, 0);
$FB->llena_texto("INGRESO:",25, 5, $DB, "", "", $rw[11], 6, 0);
$FB->llena_texto("RETIRO", 26, 5, $DB, "", "", $rw[12], 6, 0);
$FB->llena_texto("PERI&Oacute;DICO:",27, 5, $DB, "", "", $rw[13], 6, 0);
$FB->llena_texto("ESPACIOS CONFINADOS:",28, 5, $DB, "", "", $rw[14],6, 0);
$FB->llena_texto("TRABAJO EN ALTURAS:",29, 5, $DB, "", "", $rw[15],6, 0);
$FB->llena_texto("MAN ALIMENTOS:",30, 5, $DB, "", "", $rw[16],4, 0);
$FB->cierra_tabla(); 
$FB->titulo_azul1("MOTIVO DE EVALUACION",4,0, 5); 
$FB->llena_texto("Tipo Documento:",3,2,$DB,"SELECT `iddocumento`, `tip_nombre` FROM `tipodocumento` ORDER BY iddocumento","",$rw[3],17,1);
$FB->llena_texto("Documento:", 4, 115, $DB, "", "", "$rw[4]",4,1);
$FB->llena_texto("Nombre Del Paciente:",5, 1, $DB, "", "", $rw[5], 1, 1);
$FB->llena_texto("Tel&eacute;fonos:", 6, 1, $DB, "", "", $rw[6], 4, 0);
//-----------------------------------------------------------------------------------------

 	$sql="SELECT `cer_idsaludocupacional`, `cer_examenmedico`, `cer_audiometria`, `cer_visiometria`, 
	`cer_espirometria`, `cer_laboratorio`, `cer_vistibular`, `cer_resexamenes`, `cer_observaciones`, `cer_tiprestricciones`,
	`cer_comentarios`, `cer_egreso`, `cer_recomendaciones` FROM `certificadoaptitud` WHERE cer_idsaludocupacional='$param' ";
	$DB->Execute($sql); 
	$rw1=mysqli_fetch_row($DB->Consulta_ID);  
//-----------------------------------------------------------------------------------------
$FB->titulo_azul1("EXAMENES REALIZADOS",12,0, 5); 
$FB->llena_texto("EXAMEN MEDICO:",7, 5, $DB, "", "", $rw1[1], 1, 0);
$FB->llena_texto("AUDIOMETRIA", 8, 5, $DB, "", "", $rw1[2], 6, 0);
$FB->llena_texto("VISIOMETRIA:",9, 5, $DB, "", "", $rw1[3], 6, 0);
$FB->llena_texto("ESPIROMETRIA:",10, 5, $DB, "", "", $rw1[4],6, 0);
$FB->llena_texto("LABORATORIO CLINICO:",11, 5, $DB, "", "", $rw1[5],6, 0);
$FB->llena_texto("PRUEBA VESTIBULAR:",12, 5, $DB, "", "", $rw1[6],4, 0);
//-----------------------------------------------------------------------------------------
$FB->titulo_azul1("INFORMACION ORGANIZACION",4,0, 5);
$FB->llena_texto("Nombre de la Empresa:",13, 1, $DB, "", "", $rw[7],1, 0);
$FB->llena_texto("Cargo:",14, 1, $DB, "", "", $rw[8], 4, 0);
//-----------------------------------------------------------------------------------------

if($rw1[7]==""){

$datos="";
if($rw[17]==1){ $datos.="AUDIOMERTIA: $rw[18]"; }
if($rw[19]==1){ $datos.=" ,OPTOMETRIA: $rw[20]"; }
if($rw[21]==1){ $datos.=" ,VISIOMETRIA: $rw[22]"; }
if($rw[23]==1){ $datos.=" ,LABORATORIOS: $rw[24]"; }
if($rw[25]==1){ $datos.=" ,ESPIROMETRIA: $rw[26]"; }
if($rw[27]!=""){ $datos.=" ,$rw[28]: $rw[28]"; }
$rw1[7]=$datos;

}

$FB->titulo_azul1("OFICIALCONCEPTO DE LA VALORACION MEDICA",4,0, 5);
$FB->llena_texto("APTITUD LABORAL PARA EL CARGO:",15,82, $DB, $aptitud_cargo, "",@$rw[9], 1, 1);
$FB->llena_texto("RESULTADOS EXAMENES:",16,9, $DB, "", "",@$rw1[7] ,1, 0);
$FB->llena_texto("OBSERVACIONES:",17,9, $DB, "", "",@$rw1[8] ,1, 0);
$FB->llena_texto("TIPO DE RESTRICCION:",18,9, $DB, "", "",@$rw1[9] ,1, 0);
$FB->llena_texto("COMENTARIO DE EXAMENES PERIODICOS:",19,9, $DB, "", "",@$rw1[10] ,1, 0);
$FB->llena_texto("COMENTARIO DE EXAMENES DE EGRESO:",20,9, $DB, "", "",@$rw1[11] ,1, 0);
//-----------------------------------------------------------------------------------------
if($nivel_acceso==8 or $nivel_acceso==9){ $cond="and idusuarios=$id_usuario"; $rw[10]=$id_usuario; } else { $cond=""; }
$FB->titulo_azul1("RECOMENDACIONES GENERALES EXAMENES REALIZADOS",4,0, 5);

if(@$rw1[12]==""){ $rw1[12]=$rw[29]; }

$FB->llena_texto("",21,9, $DB, "", "",@$rw1[12] ,1, 0);
$FB->llena_texto("MEDICO:",22,2,$DB,"(SELECT idusuarios, usu_nombre FROM usuarios where roles_idroles in (8,9) $cond ORDER BY usu_nombre)", "", "$rw[10]", 1, 1);	
$FB->llena_texto("HUELLA ASPIRANTE:",23, 6, $DB,"" ,"", "",1, 0);
$FB->llena_texto("FOTO ASPIRANTE:", 24, 6, $DB,"" ,"", "",1, 0);
$FB->cierra_tabla(); 
			
	break;
	
	default:
	break;
}
echo "<table width='100%' cellpadding=0 cellspacing=0>";
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("param", 1, 13, $DB, "", "", $param, 5, 0);
$FB->llena_texto("condecion", 1, 13, $DB, "", "", $condecion, 5, 0);
$FB->llena_texto("paciente", 1, 13, $DB, "", "", $paciente, 5, 0);		

	echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='4'><input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='' 
			onClick='javascript:history.back();' value='Atras' style='width:190px;'> 
			<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='submit' name='enviar' value='Guardar-Siguiente' style='width:190px;' ></td></tr>";

$FB->cierra_form(); 
?>