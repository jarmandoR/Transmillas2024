<?php 
require("login_autentica.php"); 
include("layout.php");
/* include("cabezote1.php"); 
include("cabezote4.php");  */
?>
<script src="js/jquery-2.1.0.min.js"></script>

	<script type="text/javascript">

timer =0;
function testtimeout(nombres){
	clearTimeout(timer);
	imer =setTimeout(buscar(nombres),3000);
}

 function buscar(nombre) {
			
			var telefono = $("input#param2").val();
			variable = telefono.length; 

			if (variable >= 7) {
				//alert('holaaaa');
				datos = {"vlores":telefono,"tipo":"telefono"};

				$.ajax({
					url: "buscarclientes.php",
					type: "POST",
					data: datos
				}).done(function(respuesta){

					if (respuesta === null) {
						
						
					}	else {
						
						var idcliente=respuesta.idclientes;
						
						var mensaje="EL Cliente con el telefono: "+telefono+" ya Existe";
						alert(mensaje);	
						
						location.href="new_cliente.php?id_param="+idcliente+"&tabla=Clientes&condecion=2";
						
					}				
				});			
			}	
		
	}
</script>

<?php 
//echo $condecion;
if($condecion==2){
	 $sql="SELECT `idclientesdir`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`,  `cli_nombre`,`cli_clasificacion`, `cli_tipo`,cli_principal, `cli_valoraprobado`, `cli_fecharegistro`,cli_au,cli_ac,`cli_whatsap` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes WHERE  idclientes=$id_param and cli_principal=1 $cond ";		
	$DB1->Execute($sql);
	$rw=mysqli_fetch_row($DB1->Consulta_ID);
} else {
	$condecion=1;
}
//echo "wwwwwwwwwwwww".$rw[2];
$FB->abre_form("form1","newclienteok.php","post");

$FB->llena_texto("Foto:", 101, 6, $DB, "", "", "",2, 0);
$FB->llena_texto("Hoja de Vida:", 102, 6, $DB, "", "", "",2, 0);
$FB->llena_texto("Fecha de ingreso:", 1, 10, $DB, "", "", "", 2, 0);
$FB->llena_texto("Nombre:",2, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Apellido:",3, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Fecha de nacimiento:", 4, 10, $DB, "", "", "", 2, 0);
$FB->llena_texto("Cedula:",5, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Foto Cedula:", 103, 6, $DB, "", "", "",2, 0);
$FB->llena_texto("Licencia de Conducir N:",6, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Foto Licencia:", 104, 6, $DB, "", "", "",2, 0);
$FB->llena_texto("Tipo licencia:", 7, 82, $DB, $tipolicencia, "", "", 4, 1);
$FB->llena_texto("Foto Pagare:", 105, 6, $DB, "", "", "",2, 0);
$FB->llena_texto("Imagen del Estado de la Moto:", 106, 6, $DB, "", "", "",2, 0);
$FB->llena_texto("Imagen de los documentos de la Moto:", 107, 6, $DB, "", "", "",2, 0);
$FB->llena_texto("Tel&eacute;fono:", 8, 1, $DB, "", "", "", 2, 0);
$FB->llena_texto("Celular:", 9, 1, $DB, "", "", "", 2, 0);
$FB->llena_texto("Tipo de Vivienda:", 10, 8, $DB, $tipodevivienda, "", "", 4, 1);
$FB->llena_texto("Nombre de Arrendador:",11, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Nombre de Esposa(o):",12, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Profesi&oacute;n, ocupaci&oacute;n u oficio:", 13, 1, $DB, "", "", "", 2, 0);
$FB->llena_texto("Celular:",14, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Nombre Padre:",15, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Profesi&oacute;n, ocupaci&oacute;n u oficio:", 16, 1, $DB, "", "", "", 2, 0);
$FB->llena_texto("Celular:",17, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Nombre Madre:",18, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Profesi&oacute;n, ocupaci&oacute;n u oficio:", 19, 1, $DB, "", "", "", 2, 0);
$FB->llena_texto("Celular:",20, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Tipo de Estudio:", 21, 8, $DB, $$nivelaca, "", "", 4, 1);
$FB->llena_texto("Colegio:",22, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Ciudad:",23, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("EPS:",24, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Fecha de Afiliaci&oacute;n:", 25, 10, $DB, "", "", "", 2, 0);
$FB->llena_texto("Nombre:",26, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Celular:",27, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Nombre:",28, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Celular:",29, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Nombre de la ultima empresa:",30, 1, $DB, "", "", "", 2, 1);





$FB->llena_texto("Email:", 5, 111, $DB, "", "", "", 2, 0);
$FB->llena_texto("Tipo De Identificaci&oacute:",6,2,$DB,"(SELECT iddocumento, tip_nombre FROM tipodocumento  ORDER BY iddocumento)", "", "", 2, 1);
$FB->llena_texto("Identificaci&oacute;n:",7, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Genero:", 8, 8, $DB, $sexo, "", "", 4, 1);
$FB->llena_texto("Fecha de nacimiento:", 9, 10, $DB, "", "", "", 2, 0);
if($param1==6){
	$FB->llena_texto("Cliente Credito:",10,2,$DB,"(SELECT idclientes, cli_nombre FROM clientes inner join clientesdir on `idclientes`=`cli_idclientes` WHERE cli_clasificacion=1 ORDER BY cli_nombre $cond)", "", "", 2, 1);
 }	else {
	$FB->llena_texto("Sede de Trabajo:",10,2,$DB,"(SELECT idsedes, sed_nombre FROM sedes  ORDER BY sed_nombre)", "", "", 2, 1);
 }
 
$FB->llena_texto("Tel&eacute;fono:", 11, 1, $DB, "", "", "", 2, 0);
$FB->llena_texto("Celular:", 12, 1, $DB, "", "", "", 2, 0);
$FB->llena_texto("Profesi&oacute;n:", 13, 1, $DB, "", "", "", 2, 0);

if($param1==3){
$FB->llena_texto("Tipo de Operador:",18,82, $DB, $vehiculo, "", "", 2, 0);
$FB->llena_texto("Vehiculo:",19,2,$DB,"(SELECT `idvehiculos`, concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as vehiculo FROM vehiculos where veh_estado=1)", "", "", 2, 1);
$FB->llena_texto("Tipo licencia:", 20, 82, $DB, $tipolicencia, "", "", 4, 1);
$FB->llena_texto("Fecha de Vencimiento:", 21, 10, $DB, "", "", "", 2, 0);

}else {
	$FB->llena_texto("param18", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param19", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param20", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param21", 1, 13, $DB, "", "$fechaactual", 0, 5, 0);

}

$FB->llena_texto("Estado:", 14, 8, $DB, $estado_pro, "", "Activo", 4, 1);
$FB->llena_texto("Firma/huella:", 15, 6, $DB, "", "", "",2, 0);	
$FB->llena_texto("Foto:", 17, 6, $DB, "", "", "",2, 0);


	
include("footer.php");
?>