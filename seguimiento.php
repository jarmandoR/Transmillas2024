<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 
//echo "okkkkkkkkkkkkk".$param9;

//echo $_SESSION['usuario_rol'];
$FB->titulo_azul1("Seguimiento de Guias",9,0,5);  
$FB->abre_form("form1","","post");
$fechainicial=date('Y-m-01');
?>

<?php 
	if($param4!=''){  $fechainicial=$param4;}
	if($param6!=''){  $fechaactual=$param6;}
	if($param5!=''){ $id_ciudad=$param5;  $conde2=" and cli_idciudad=$id_ciudad"; }  else {  $id_ciudad=""; }
	if($param7!=''){ $id_ciudad2=$param7;  $conde2.=" and ser_ciudadentrega=$id_ciudad2"; }  else {  $id_ciudad2=""; }
	
	$FB->llena_texto("Fecha de Inicial:", 4, 10, $DB, "", "", "$fechainicial", 17, 0);
	$FB->llena_texto("Fecha de Final:", 6, 10, $DB, "", "", "$fechaactual", 4, 0);
	$FB->llena_texto("Ciudad Origen:",5,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where inner_estados=1 )", "", "$id_ciudad", 17, 0);
	$FB->llena_texto("Ciudad Destino:",7,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where inner_estados=1 )", "", "$id_ciudad2", 4, 0);



$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda,"",$param1,1,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);

$FB->llena_texto("Operador De:",8,82,$DB,$operador,"",$param8,1,0);
//$FB->llena_texto("Operador:", 9, 4, $DB, "llega_sub1", "", "",4,0);
$FB->llena_texto("Operador:",9, 2, $DB, "(SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5) and  (usu_estado=1 or usu_filtro=1))", "", "$param9",4,0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);


$FB->cierra_form(); 
$FB->titulo_azul1("Fecha Ingreso",1,0,7); 
$FB->titulo_azul1("#Guia",1,0,0); 
$FB->titulo_azul1("#Relacionado",1,0,0); 
$FB->titulo_azul1("Remitente",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Servicio",1,0,0); 

//if($_SESSION['usuario_rol']!=2){
$FB->titulo_azul1("Guia",1,0,0); 
//$FB->titulo_azul1("Reasignar",1,0,0); 
//$FB->titulo_azul1("Validar",1,0,0); 
//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);
//}
$conde1=""; 
$conde3=""; 

if($param2!="" and $param1!=""){ 
 $conde1="and $param1 like '%$param2%' "; 
  }else { $conde1="  "; } 

if($param1==""){ $param1="ser_prioridad"; } 

if($param9!=''){ $conde3 =" and ser_idresponsable='$param9'"; }
if($param8!=''){ $conde3 =" and $param8='$param9'"; }


 $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad
 FROM serviciosdia where date(ser_fecharegistro)>='$fechainicial' and  date(ser_fecharegistro)<='$fechaactual' $conde1 $conde2 $conde3 ORDER BY $param1 $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$direc1=str_replace("&"," ", $rw1[4]);
		$direct2=str_replace("&"," ", $rw1[7]);
		echo "<td>".$rw1[10]."</td>
		<td>".$rw1[11]."</td>
		<td>".$rw1[12]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$direc1."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$direct2."</td>
		<td>".$rw1[8]."</td>
		<td>".$rw1[9]."</td>
		";

		echo "<td align='center' ><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='img/recogidas.png'></a></td>";
	//	echo "<td align='center' ><a  onclick='pop_dis24($id_p,\"Asignar Paquete\",$rw1[13])';  style='cursor: pointer;' title='Asignar Paquete' ><img src='img/paquete.png'></a></td>";
		//echo "<td align='center' >	<a  onclick='pop_dis1($id_p, \"Seguimiento Datos\")';  style='cursor: pointer;' title='Editar Datos' ><img src='img/informacion.jpg'></a></td>";		
		echo "</tr>"; 
	}
	echo "<tr><td align='center' > Total Datos:$va</td>"; 
	
	echo "</tr>"; 

include("footer.php");
?>