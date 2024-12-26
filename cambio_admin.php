<?php 
require("login_autentica.php");
include("layout.php");
$tabla=$_REQUEST["tabla"];
$id_param=$_REQUEST["id_param"];
if(isset($_REQUEST["id_param"])){$id_param=$_REQUEST["id_param"];}

$FB->abre_form("form1","cambio_adminok.php","post");
$FB->titulo_azul1("Editar $tabla","2","0", 4); 

$tabla1=$tabla;
if($condecion=='general'){  $tabla='General'; }else {

$valores=$LT->devuelvecampos($tabla, 0, "");
//echo $valores[1];
$rw=$QL->select($valores[0], $valores[1], $valores[3], $id_param, $DB, $valores[7]);
}
?>
<body onLoad="
<?php 
switch ($tabla)
{
	case "Dependencia":
	echo "cambio_ajax2('$rw[1]', 11, 'llega_sub2', 'param4', 1, 0)";
	break;
	case "Campo de Cabezote de formularios":
	echo "cambio_ajax2('$rw[1]', 9, 'llega_sub1', 'param4', 1, '$rw[4]')";
	break;
	case "Parametro":
	echo "cambio_ajax2('$rw[1]', 9, 'llega_sub1', 'param4', 1, '$rw[4]')";
	break;
	case "Permiso":
	echo "cambio_ajax2('$rw[1]', 5, 'llega_sub1', 'param2', 1, '$rw[2]');  ";
	break;
	case "Usuario":
	echo "cambio_ajax2('$rw[12]', 1, 'llega_sub1', 'param13', 1, '0'); ";

	break;
	case "asignardinero":
	echo "cambio_ajax2('$rw[5]',15,'llega_sub1','param2',3,'$rw[1]'); ";
	break;
	case "transpasodinero":
	echo "cambio_ajax2('$rw[5]',15,'llega_sub1','param2',3,'$rw[1]'); ";
	break;
	case "deudaspro":
	echo "cambio_ajax2('$rw[5]',15,'llega_sub1','param2',3,'$rw[1]'); ";
	break;
	case "Tareas":
		echo "cambio_ajax4('$rw[4]','$rw[6]',30,'llega_sub1','param6',3,'$rw[5]');";

		break;
	default:
	break;
}
?>">
<?php


switch ($tabla)
{
	case "General": 

//$sql1="Select * FROM $tabla1 where `id$tabla1`=$id_param";
// $sql1=devuelve_consulta($tabla1,$id_param,$DB); 
 $sql1="Select * FROM $tabla1 where `id$tabla1`=$id_param";
$DB->Execute($sql1);  
$rw=mysqli_fetch_row($DB->Consulta_ID);
	$sql="SHOW COLUMNS FROM $tabla1";
$DB1->Execute($sql); $va=1; $va2=0; 


	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		if($va2!=0){	
		$dato=explode("_",$rw1[0]);
		
		if($dato[0]=="val"){
			$FB->llena_texto("Valor $dato[1]:",$va2, 118, $DB, "", "", "$rw[$va2]",1, 1);
		}else if($dato[0]=="inner"){
			if($dato[2]!=''){
				$nombretable=$dato[1]."_".$dato[2];
			}else{
				$nombretable=$dato[1];
			}
			$FB->llena_texto("$dato[1]:",$va2,2,$DB,"(Select * FROM $nombretable ORDER BY 2)", "",$rw[$va2], 2, 1);
			
		}
		else {
			$FB->llena_texto("$dato[1]:",$va2, 1, $DB, "", "", "$rw[$va2]",1, 0);	
		}
		
		}
		$va2++;
	}

	@$imagen=$_REQUEST['imagenes'];
	if($imagen!=''){
		$FB->llena_texto("$imagen", 100, 6, $DB, "", "", "", 1, 0);
		$FB->llena_texto("param101", 1, 13, $DB, "", "", "$imagen", 5, 0);

	}
	
	$tabla=$tabla1;
	$condecion='general';
break;
	
case "Rol": 
$FB->llena_texto("Nombre Rol:", 1, 1, $DB, "", "", $rw[1], 2, 1);

break; 

case "Usuario": 

if (!isset($param1) or $param1=='' ) {
	$rol = $rw[1];
}else {
	$rol = $param1;
}



$FB->llena_texto("Rol:",1,2,$DB,"SELECT idroles, rol_nombre FROM roles WHERE idroles!=0 $cond_rol ORDER BY rol_nombre", "cambioParaUsers(this.value,\"cambio_admin.php\",\"Usuario\",\"$rw[0]\")", "$rol", 2, 1);
$FB->llena_texto("Nombre:",2, 1, $DB, "", "", $rw[2], 2, 1);
$FB->llena_texto("Usuario:",3, 1, $DB, "", "", $rw[3], 2, 1);

$FB->llena_texto("Contrase&ntilde;a:", 4, 3, $DB, "", "", "", 2, 1);
// $FB->llena_texto("Email:", 5, 111, $DB, "", "", $rw[5], 2, 0);

if ($rw[49]=="no" or $rw[49]==""){

	// $FB->llena_texto("Cedula:",5, 1, $DB, "", "", "$rw[6]", 17, 1);
	$FB->llena_texto("Email:", 5, 111, $DB, "", "", $rw[5], 2, 0);
	if ($nivel_acceso==1 ) {
	echo"<tr><td><label>Validar</label></td><td><input id='param82' name='param82' type='checkbox' ></td></tr>";
	}

}else if ($rw[49]=="on"){
	echo "<tr><td><label>Email:</label></td><td><input name='param5' id='param5' class='form-control' readonly type='text' value='$rw[5]'></td></tr>";

	// $FB->llena_texto("Cedula:",5, 35, $DB, "", "", "$rw[6]", 17, 1);
	if ($nivel_acceso==1 ) {
		echo"<tr><td><label>Validar:</label></td><td><input id='param82' name='param82' type='checkbox' checked></td></tr>";
	}
	
}
$FB->llena_texto("Tipo De Identificaci&oacute:",6,2,$DB,"(SELECT iddocumento, tip_nombre FROM tipodocumento  ORDER BY iddocumento)", "",$rw[6], 2, 1);
$FB->llena_texto("Identificaci&oacute;n:",7, 1, $DB, "", "", $rw[7], 2, 1);
$FB->llena_texto("Genero:", 8, 8, $DB, $sexo, "", $rw[8], 4, 1);

if($rol==6){
	$FB->llena_texto("param9", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param10", 1, 13, $DB, "", "1", 0, 5, 0);
	$FB->llena_texto("Cliente Credito:",23,2,$DB,"(SELECT `idcreditos`, `cre_nombre` FROM `creditos` )", "", $rw[20], 2, 1);
	$FB->llena_texto("Celular Vinculado al Cliente:", 11, 1, $DB, "", "", "$rw[11]", 2, 1);
	$FB->llena_texto("param12", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param13", 1, 13, $DB, "", "Cliente", 0, 5, 0);
 }else {
	$FB->llena_texto("Fecha de nacimiento:", 9, 10, $DB, "", "", $rw[9], 2, 0);
	$FB->llena_texto("param23", 1, 13, $DB, "", "0", 0, 5, 0);
	$FB->llena_texto("Sede de Trabajo:",10,2,$DB,"(SELECT idsedes, sed_nombre FROM sedes  ORDER BY sed_nombre)", "", $rw[10], 2, 1);
	$FB->llena_texto("Tel&eacute;fono:", 11, 1, $DB, "", "", $rw[11], 2, 0);
	$FB->llena_texto("Celular:", 12, 1, $DB, "", "", $rw[12], 2, 0);
	$FB->llena_texto("Profesi&oacute;n:", 13, 1, $DB, "", "", $rw[13], 2, 0);
}

if($rol==3){
$FB->llena_texto("Tipo de Operador:",18,82, $DB, $vehiculo, "", $rw[14], 2, 0);
$FB->llena_texto("Vehiculo:",19,2,$DB,"(SELECT `idvehiculos`, concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as vehiculo FROM vehiculos where veh_estado=1)", "", "$rw[15]", 2, 0);
$FB->llena_texto("Tipo licencia: $rw[16]", 20, 82, $DB, $tipolicencia, "", "$rw[16]", 2, 1);
$FB->llena_texto("Fecha de Vencimiento:", 21, 10, $DB, "", "", "$rw[17]", 2, 0);
}else {
	$FB->llena_texto("param18", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param19", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param20", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param21", 1, 13, $DB, "", "$fechaactual", 0, 5, 0);
}
if($rw[19]==1){
	$estado=1;
}else{
	$estado=0;
}
if($rol!=6){
	$FB->llena_texto("Tipo de Contrato:",22,82, $DB, $tipocontrato, "", "$rw[18]", 2, 0);
}else{
	$FB->llena_texto("param22", 1, 13, $DB, "", "Cliente", 0, 5, 0);
}

$FB->llena_texto("Estado:", 14, 82, $DB, $estado_pro, "",$estado, 4, 1);
$FB->llena_texto("Firma/huella:", 15, 6, $DB, "", "", "",2, 0);
$FB->llena_texto("Foto:", 16, 6, $DB,"" ,"", "",2, 0);



break;
case "Vehiculos":

	$FB->llena_texto("Tipo Vehiculo:",1,82,$DB,$tipovehiculo,"","$rw[1]",1,0);
	$FB->llena_texto("Marca:",2, 1, $DB, "", "", "$rw[2]", 2, 1);
	$FB->llena_texto("Placa:",3, 1, $DB, "", "", "$rw[3]", 2, 1);
	$FB->llena_texto("Modelo:",4, 1, $DB, "", "", "$rw[4]", 2, 1);
	$FB->llena_texto("Color:",12, 1, $DB, "", "", "$rw[12]", 2, 1);			
	$FB->llena_texto("Tipo:",13, 1, $DB, "", "", "$rw[13]", 2, 1);		
	$FB->llena_texto("Due&ntilde;o:",5,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE (usu_estado=1 or usu_filtro=1) and roles_idroles in (1,3)", "", "$rw[5]", 1, 1);
	$FB->llena_texto("Fecha de Seguro:", 6, 10, $DB, "", "", "$rw[6]", 2, 0);
	$FB->llena_texto("Foto Seguro:",21, 6, $DB, "", "", "",2, 0);
	$FB->llena_texto("Fecha de Tecnomec&aacute;nica:", 7, 10, $DB, "", "", "$rw[7]", 2, 0);
	$FB->llena_texto("Foto Tecnomec&aacute;nica:", 22, 6, $DB, "", "", "",2, 0);	
	$FB->llena_texto("Fecha de CambioAceite:", 8, 10, $DB, "", "", "$rw[8]", 2, 0);

	
	$FB->llena_texto("Km actual:",9, 1, $DB, "", "", "$rw[9]", 2, 1);	
	$FB->llena_texto("Km CambioAceite:",10, 1, $DB, "", "", "$rw[10]", 2, 1);	
	$FB->llena_texto("No CHASIS:",14, 1, $DB, "", "", "$rw[14]", 2, 1);	
	$FB->llena_texto("No MOTOR:",15, 1, $DB, "", "", "$rw[15]", 2, 1);	
	$FB->llena_texto("No CILINDRAJE:",16, 1, $DB, "", "", "$rw[16]", 2, 1);	
	$FB->llena_texto("USO DEL VEH&Iacute;CULO:",17, 1, $DB, "", "", "$rw[17]", 2, 1);	
	$FB->llena_texto("Estado:", 11, 8, $DB, $estado_pro, "", "Activo", 4, 1);
	$FB->llena_texto("ESPECIFICACIONES T&Eacute;CNICAS:",18, 9, $DB, "", "", "$rw[18]", 2, 0);
	$FB->llena_texto("CARA SUPERIOR:", 19, 6, $DB, "", "", "",2, 0);	
	$FB->llena_texto("CARA INFERIOR:",20, 6, $DB, "", "", "",2, 0);
	break;
case "Clientes":

$FB->llena_texto("CC / Nit:",1, 1, $DB, "", "", $rw[1], 1, 1);
$FB->llena_texto("Nombre Del Cliente:", 2, 1, $DB, "", "", $rw[2], 1, 0);
$FB->llena_texto("Tel&eacute;fonos :",3, 121, $DB, "", "", $rw[3], 1, 1);

$FB->llena_texto("Ciudad Origen:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`  where inner_estados=1)", "", $rw[4], 1, 1);

@$direcc=explode("&",$rw[5]);
@$param5=$direcc[0];
@$param51=$direcc[1];
@$param19=$direcc[2];
@$param20=$direcc[3];

	echo "<tr bgcolor='#FFFFFF' ><td>Direcci&oacute;n:</td>
	<td align='left' ><select class='trans'  name='param5' id='param5' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param5, $DB);
    echo "</select>
	<input name='param51' id='param51' class='trans'  type='text' value='$param51' onkeypress='return noenter();'>
	</td></tr>
	";

	echo "<tr bgcolor='#FFFFFF' ><td>Lugar de Recogida:</td>
	<td align='left' ><select class='trans'  name='param19' id='param19' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param19, $DB);
    echo "</select>
	<input name='param20' id='param20' class='trans'  type='text' value='$param20' onkeypress='return noenter();'>
	</td></tr>";

	
$FB->llena_texto("Email:", 6, 111, $DB, "", "", $rw[6], 1, 0);	
$FB->llena_texto("Clasificaci&oacute;n:", 7, 213, $DB, "", "3",$rw[7], 1, 0);	
//$FB->llena_texto("param6",6, 13, $DB, "", "", "2",2,0);

break; 

case "Pais": 
$FB->llena_texto("Nombre:",1, 1, $DB, "", "", $rw[1],2,1);
$FB->llena_texto("C&oacute;digo:",2, 1, $DB, "", "", $rw[2],2,1);
break; 
case "Region": 
$FB->llena_texto("Pa&iacute;s:",1,2,$DB,"(SELECT idpaises, pai_nombre FROM paises WHERE pai_nombre='COLOMBIA') UNION (SELECT idpaises, pai_nombre FROM paises WHERE pai_nombre!='COLOMBIA' ORDER BY pai_nombre)","",$rw[1],2,1);
$FB->llena_texto("Nombre regi&oacute;n:",2, 1, $DB, "", "", $rw[2],2,1);
break; 
case "Departamento":
$FB->llena_texto("Nombre departamento:",1, 1, $DB, "", "", $rw[1],2,1);
break;
case "Menu":
$FB->llena_texto("Nombre Men&uacute;:",1, 1, $DB, "", "", $rw[1],2,1);
$FB->llena_texto("URL destino:",2, 1, $DB, "", "", $rw[2],2,1);
$FB->llena_texto("Categor&iacute;a jer&aacute;rquica a la que pertenece?",3,2,$DB,"SELECT idmenu, men_nombre FROM menu WHERE (men_predecesor=0 or men_principal=1) ORDER BY men_predecesor, men_nombre","",$rw[3],2,0);
$FB->llena_texto("Orden:",4, 112, $DB, "", "", $rw[4], 2, 1);
$FB->llena_texto("Principal:", 5, 5, $DB, "", "", $rw[5], 2, 0);
$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
$FB->llena_texto("&Iacute;cono", 7, 6, $DB, $tabla, 1, $rw[0], 1, 0);
break; 
case "asignardinero":

$rw[2]=number_format($rw[2],0,".",".");
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$rw[5]", 2, 1);
$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", $rw[1],2,1);
$FB->llena_texto("Fecha de Busqueda:", 3, 10, $DB, "", "", "$rw[3]", 2, 0);
$FB->llena_texto("Tipo de transaccion:", 4, 82, $DB, $transaccionoper, "", $rw[7], 2, 1);
$FB->llena_texto("Valor:",5, 118, $DB, "", "", "$rw[2]", 2, 1);
$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
break;
case "transpasodinero":
if($nivel_acceso==1 or $nivel_acceso==5){

	$rw[2]=number_format($rw[2],0,".",".");
	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$rw[5]", 2, 1);
	$FB->llena_texto("Asignar a:", 2, 4, $DB, "llega_sub1", "", $rw[1],2,1);
	$FB->llena_texto("Fecha :", 3, 10, $DB, "", "", "$rw[3]", 2, 0);
	$FB->llena_texto("Valor:",5, 118, $DB, "", "", "$rw[2]", 2, 1);
	$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
	$FB->llena_texto("Imagen", 6, 6, $DB, "", "", "",1,0);
	$FB->llena_texto("param4",1, 13, $DB, "", "", "Asignar Dinero",2,0);
}else{

	$rw[2]=number_format($rw[2],0,".",".");
$FB->llena_texto("Valor:",5, 118, $DB, "", "", "$rw[2]", 2, 1);
$FB->llena_texto("Asignar a:", 2, 4, $DB, "llega_sub1", "", $rw[1],2,1);
$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
$FB->llena_texto("Imagen", 6, 6, $DB, "", "", "",1,0);
$FB->llena_texto("param4",1, 13, $DB, "", "", "Asignar Dinero",2,0);

}



break;
case "reclamos":

		$FB->llena_texto("Fecha de Envio:", 8, 10, $DB, "", "", "$rw[2]", 2, 0);
		$FB->llena_texto("Tipo Reclamo:", 9, 82, $DB, $tiporeclamo, "", "$rw[4]", 2, 1);
		$FB->llena_texto("Nombre:", 4, 1, $DB, "", "", "$rw[11]", 1, 0);
		$FB->llena_texto("telefono:", 5, 1, $DB, "", "", "$rw[12]", 1, 0);
		$FB->llena_texto("E-mail:", 6, 1, $DB, "", "", "$rw[13]", 1, 0);	
		$FB->llena_texto("Ciudad donde quiere recibir la notificacion:", 1, 1, $DB, "", "", "$rw[16]", 1, 1);
		$FB->llena_texto("Direccion donde quiere recibir la notificacion:",11, 1, $DB, "", "", "$rw[17]", 1, 1);
		$FB->llena_texto("Descripcion de Reclamo:", 7,9, $DB, "", "", "$rw[5]", 2, 0);
/* 		$FB->llena_texto("Numero De Guia Completo",2, 1, $DB, "", "", "$rw[9]",2,1);
		$FB->llena_texto("param10", 1, 13, $DB, "", "$rw[10]", 0, 5, 0);
		$FB->llena_texto("param3", 1, 13, $DB, "", "ser_consecutivo", 0, 5, 0);
		echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarguia(29);'  >Validar Guia </button></td></tr>";	 */	
		$FB->llena_texto("Foto Guia", 8, 6, $DB, "", "", "",1,0);
	//	$FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);

	break;

case "deudaspro":
$rw[2]=number_format($rw[2],0,".",".");
$rw[3] = date("Y-m-d", strtotime($rw[3]));
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where inner_estados=1 )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$rw[5]", 2, 1);
$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", $rw[1],2,1);
$FB->llena_texto("Fecha de Busqueda:", 3, 10, $DB, "", "",$rw[3], 2, 0);
$FB->llena_texto("Tipo de transaccion:", 4, 82, $DB, $deudaoper, "", $rw[7], 2, 1);
$FB->llena_texto("Valor:",5, 118, $DB, "", "", "$rw[2]", 2, 1);
$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
$FB->llena_texto("Imagen", 7, 6, $DB, "", "", "",1,0);

break;

case "Precios": 

	$sql2 = "SELECT  `con_precios`,con_idprecios FROM `configuracionkilos` WHERE con_idprecioskilos='$id_param' and con_tipo='normal' order by idconfiguracionkilos asc";
	$DB->Execute($sql2);
	while($rw3=mysqli_fetch_row($DB->Consulta_ID))
	{
		$preciosconfi[$rw3[1]]=$rw3[0];
		
	}
	
$FB->llena_texto("Ciudad Origen:",1,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades`  where inner_estados=1", "","$rw[1]",2,1);
$FB->llena_texto("Ciudad Destino:",2,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades`  where inner_estados=1", "","$rw[2]",2,1);
$FB->llena_texto("Precio Primeros Kg:",3, 123, $DB, "", "", "$rw[3]", 2, 1);

$sql = "SELECT `idprecioskilos`, `pre_inicial`, `prec_final` FROM `precioskilos`";
			$DB1->Execute($sql);
			$aumento=6;
			while ($rw2 = mysqli_fetch_row($DB1->Consulta_ID)) {

				$aumento++;
				$confipre=$preciosconfi[$rw2[0]];
				$FB->llena_texto("Precio $rw2[1] hasta $rw2[2] Kg:", $aumento, 123, $DB, "", "", "$confipre", 2, 1);
			}
			$FB->llena_texto("Servicio:",5,279,$DB,"SELECT `idtiposervicio`, `tip_nom` FROM `tiposervicio`  ", "","$rw[5]",2,0);
			$FB->llena_texto("param100",6, 13, $DB, "", "", "normal",2,0);


break;
case "Precios credito": 

	$sql2 = "SELECT  `con_precios`,con_idprecios FROM `configuracionkilos` WHERE con_idprecioskilos='$id_param' and con_tipo='Credito' order by idconfiguracionkilos asc";
	$DB->Execute($sql2);
	while($rw3=mysqli_fetch_row($DB->Consulta_ID))
	{
		$preciosconfi[$rw3[1]]=$rw3[0];
		
	}

$FB->llena_texto("Credito:",1,2,$DB,"SELECT `idcreditos`, `cre_nombre` FROM `creditos` ", "","$rw[1]",2,1);
$FB->llena_texto("Ciudad Origen:",2,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades`  where inner_estados=1", "","$rw[2]",2,1);
$FB->llena_texto("Ciudad Destino:",3,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades`  where inner_estados=1", "","$rw[3]",2,1);

$FB->llena_texto("Precio Primeros Kg:",4, 123, $DB, "", "", "$rw[4]", 2, 1);
$sql = "SELECT `idprecioskilos`, `pre_inicial`, `prec_final` FROM `precioskilos`";
			$DB1->Execute($sql);
			$aumento=6;
			while ($rw2 = mysqli_fetch_row($DB1->Consulta_ID)) {

				$aumento++;
				$confipre=$preciosconfi[$rw2[0]];
				$FB->llena_texto("Precio $rw2[1] hasta $rw2[2] Kg:", $aumento, 123, $DB, "", "", "$confipre", 2, 1);
			}

$FB->llena_texto("Servicio:",6,279,$DB,"SELECT `idtiposervicio`, `tip_nom` FROM `tiposervicio`  ", "","$rw[6]",2,0);
$FB->llena_texto("param100",6, 13, $DB, "", "", "Credito",2,0);
break;
case "Tareas":

	$diassemanas=explode(",",$rw[2]);

	$FB->llena_texto("Tarea:", 1, 1, $DB, "", "", "$rw[1]", 1, 0);
	echo '<tr><td>Dias Programados</td><td>
	<div>
	<label class="">
		<input type="checkbox" name="diassemana[]" value="Lunes" autocomplete="off"';
		if(in_array("Lunes",$diassemanas)){ echo "checked"; } echo '> Lunes
	</label>
	<label class="">
		<input type="checkbox" name="diassemana[]" value="Martes" autocomplete="off" ';
		if(in_array("Martes",$diassemanas)){ echo "checked"; } echo '> Martes
	</label>
	<label class="">
		<input type="checkbox" name="diassemana[]" value="Miercoles" autocomplete="off" ';
		if(in_array("Miercoles",$diassemanas)){ echo "checked"; } echo '> Miercoles
	</label>
	<label class="">
		<input type="checkbox" name="diassemana[]" value="Jueves" autocomplete="off" ';
		if(in_array("Jueves",$diassemanas)){ echo "checked"; } echo '> Jueves
	</label>
	<label class="">
		<input type="checkbox" name="diassemana[]" value="Viernes" autocomplete="off" ';
		if(in_array("Viernes",$diassemanas)){ echo "checked"; } echo '> Viernes
	</label>
	<label class="">
		<input type="checkbox" name="diassemana[]" value="Sabado" autocomplete="off" ';
		if(in_array("Sabado",$diassemanas)){ echo "checked"; } echo '> Sabado
	</label>
	<label class="">
		<input type="checkbox" name="diassemana[]" value="Domingo" autocomplete="off" ';
		if(in_array("Domingo",$diassemanas)){ echo "checked"; } echo '> Domingo
	</label>
</div></tr></td>';
$hora=date("H:i:s");
	$FB->llena_texto("Hora Programada:", 7, 102, $DB, "", "", "$rw[7]", 2, 0);
	//$FB->llena_texto("Dias:", 5,86, $DB, $dias, "", "$rw[5]", 2, 1);
	$FB->llena_texto("Fecha unica:", 3, 10, $DB, "", "", "$rw[3]", 2, 0);
	$FB->llena_texto("Para Rol:", 4, 2, $DB, "(SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre)", "cambio_ajax2(this.value,30, \"llega_sub1\", \"param6\",1,param5.value)", "$rw[4]", 2, 1);
	$FB->llena_texto("Sede:", 5, 2, $DB, "(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio_ajax2(param4.value,30, \"llega_sub1\", \"param6\",1,this.value)", "$rw[5]", 2, 1);
	$FB->llena_texto("Para Operario:", 6, 4, $DB, "llega_sub1", "", "$rw[6]", 2, 0);
	$FB->llena_texto("Estado:",8,82, $DB, $estadosac, "", "$rw[8]", 1, 0);
break;

case "Porcentajes Sedes":

	$FB->llena_texto("Sede Origen:", 1, 2, $DB, "(SELECT idsedes, sed_nombre FROM sedes where sed_principal='si'  ORDER BY sed_nombre)", "", "$rw[1]", 2, 1);
	$FB->llena_texto("Sede Destino:", 2, 2, $DB, "(SELECT idsedes, sed_nombre FROM sedes where sed_principal='si'  ORDER BY sed_nombre)", "", "$rw[2]", 2, 1);
	$FB->llena_texto("Tipo Servicio:", 3,279, $DB, "SELECT `idtiposervicio`, `tip_nom` FROM `tiposervicio` ", "", "$rw[3]", 2, 0);
	$FB->llena_texto("Tipo de Pago:", 4,82, $DB, $tipopago3, "", "$rw[4]", 2, 1);
	$FB->llena_texto("Estado Servicio:", 5,82, $DB, $estadosguias2, "", "$rw[5]", 2, 1);
	$FB->llena_texto("Kilo Inicial:", 6, 129, $DB, "#", "", "$rw[6]", 2, 1);
	$FB->llena_texto("Kilo Final:", 7, 129, $DB, "#", "", "$rw[7]", 2, 1);
	$FB->llena_texto("% Sede :", 8, 129, $DB, "%", "", "$rw[8]", 2, 1);
	$FB->llena_texto("% Empresa :", 9, 129, $DB, "%", "", "$rw[9]", 2, 1);
break;	





case "Permiso": 
$FB->llena_texto("Item del Men&uacute;:",1,2,$DB,"SELECT idmenu, men_nombre FROM menu WHERE idmenu='$rw[1]'", "",$rw[1],2,1);
$FB->llena_texto("Rol:",2,2,$DB,"SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre","",$rw[2],2,1);
$FB->llena_texto("Crear:", 3, 5, $DB, "", "", $rw[3], 2, 0);
$FB->llena_texto("Editar:", 4, 5, $DB, "", "", $rw[4], 2, 0);
$FB->llena_texto("Eliminar:", 5, 5, $DB, "", "", $rw[5], 2, 0);
$FB->llena_texto("Visible en el men&uacute;:", 6, 5, $DB, "", "", $rw[6],2, 0);
break; 

case "Ciudad": 
$FB->llena_texto("Departamento:",1,2,$DB,"(SELECT iddepartamentos, dep_nombre FROM departamentos order by dep_nombre)","",$rw[1],2,1);
$FB->llena_texto("Nombre Ciudad:",2,1, $DB, "", "", $rw[2],2,1);
break; 


case "Tipos de Datos": 
$FB->llena_texto("Tipo de dato:",1, 1, $DB, "", "", $rw[1],2,1);
$FB->llena_texto("Prefijo de visualizaci&oacute;n de informaci&oacute;n:",2, 1, $DB, "", "", $rw[2],2,0);
$FB->llena_texto("Sufijo de visualizaci&oacute;n de informaci&oacute;n:",3, 1, $DB, "", "", $rw[3],2,0);
$FB->llena_texto("Consulta la base de datos:",4, 8, $DB, $sino, "", $rw[4],2,0);
break; 
case "Parametro": 
$FB->llena_texto("Tipo de dato:",1,2,$DB,"SELECT idtiposindicadores, int_nombre FROM tiposindicadores ORDER BY int_nombre", 
"cambio_ajax2(this.value, 9, \"llega_sub1\", \"param4\", 1, 0)",$rw[1],2,1);
$FB->llena_texto("C&oacute;digo:",2, 1, $DB, "", "", $rw[2],2,1);
$FB->llena_texto("Nombre del Par&aacute;metro:",3, 9, $DB, "", "", $rw[3],2,1);
$FB->llena_texto("Descripci&oacute;n:", 4, 4, $DB, "llega_sub1", "", $rw[4],2,0);
$FB->llena_texto("Niveles de desagregaci&oacute;n:",5, 9, $DB, "", "", $rw[5],2,0);
$FB->llena_texto("param6",6, 13, $DB, "", "", "2",2,0);
break; 
case "Campo de Cabezote de formularios": 
$FB->llena_texto("Tipo de dato:",1,2,$DB,"SELECT idtiposindicadores, int_nombre FROM tiposindicadores ORDER BY int_nombre", 
"cambio_ajax2(this.value, 9, \"llega_sub1\", \"param4\", 1, 0)",$rw[1],2,1);
$FB->llena_texto("Orden:",2, 40, $DB, "SELECT ind_codigo FROM indicadores WHERE ind_codigo NOT IN ($rw[2]) ORDER BY ind_codigo", "", $rw[2],2,1);
$FB->llena_texto("Nombre del grupo poblaci&oacute;n o instituci&oacute;n al que se le aplicara el formulario:",3, 9, $DB, "", "", $rw[3],2,1);
$FB->llena_texto("Descripci&oacute;n:", 4, 4, $DB, "llega_sub1", "", $rw[4],2,0);
$FB->llena_texto("Niveles de desagregaci&oacute;n - se deben separar por punto y coma (;):",5, 9, $DB, "", "", $rw[5],2,0);
$FB->llena_texto("param6",6, 13, $DB, "", "", "1",2,0);
break; 

case "Documento":
$condecion=explode("_zzz_",$condecion);
$condecion=$condecion[0];
$FB->llena_texto("param1", 1, 13, $DB, "", "", $rw[1], 5, 0);
$FB->llena_texto("Tipo de documento:", 2, 2, $DB, "SELECT idtipodocumentos, tid_nombre FROM tipodocumentos ", "", $rw[2], 2, 1);
$FB->llena_texto("Contrato:", 3, 23, $DB, "SELECT idcontratosproyectos, ent_nombre, cop_contrato FROM contratosproyectos  INNER JOIN entidades ON entidades_identidades=identidades AND proyectos_idproyectos='".$_SESSION["id_proyecto"]."' ORDER BY cop_contrato ", "", $rw[3], 2, 1);
$FB->llena_texto("Nombre:",4, 1, $DB, "", "", $rw[4], 2, 1);
$FB->llena_texto("Fecha:",5, 10, $DB, "", "", $rw[5], 2, 1);
$FB->llena_texto("Versi&oacute;n:",6, 112, $DB, "", "", $rw[6], 2, 1);
$FB->llena_texto("Observaciones:",7, 9, $DB, "", "", $rw[7], 2, 0);
$FB->llena_texto("Documento:", 8, 6, $DB, $tabla, 1, $rw[0], 2, 0);
break; 

} 
$FB->llena_texto("condecion", 1, 13, $DB, "", "", $condecion, 5, 0);
$FB->llena_texto("tabla", 1, 13, $DB, "", "", $tabla, 5, 0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("", 1, 14, $DB, "", "", 0, 1, 0);
$FB->cierra_form(); 
include("footer.php"); ?>