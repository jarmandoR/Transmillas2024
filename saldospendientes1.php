<?php 
require("login_autentica.php"); 
include("layout.php");

?>
<head>
<!-- 	<script language="JavaScript" type="text/javascript" src="js/jquery-1.4.4.min"></script> 
 --><!--     <script src="js/jquery.printPage.js" type="text/javascript"></script> -->
  <script>  
/*   var version2 = jQuery.noConflict(); 
   version2(document).ready(function() {
    version2(".btnPrint").printPage();
  });  */  
  
  $(function () {
    $(document).on('change', '.borrar', function (event) {
		
		var valor = $(this).val();
		var descripcion=document.getElementById("des_"+$(this).attr('name')).value;
		var idservicio=document.getElementById("servicio_"+$(this).attr('name')).value;
		event.preventDefault();
		$(this).closest('tr').remove();
      	datos = {"tipoguia":"cancelar","servicio":idservicio,"descripcion":descripcion,"llego":valor};
		$.ajax({
				url: "guiasok.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				console.log(respuesta);
			});

    });
});
  
  </script>

</head>
<body onload="">

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Saldos Pendientes Por Cancelar",9,0,5);  
$FB->abre_form("form1","","post");
$conde3="";	


 
if($param4!=''){ $conde="and ser_fecharegistro like '$param4%'";  $fechaactual=$param4; $fechainicio=$param3;    }
$FB->llena_texto("Fecha de Inicio:", 3, 10, $DB, "", "", "$fechainicio", 17, 0);
$FB->llena_texto("Fecha de Final:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);

 $conde="and ser_fecharegistro>= '$fechainicio' and ser_fecharegistro<= '$fechaactual'"; 

if($param5!=''){ $id_ciudad=$param5; }  
$FB->llena_texto("Ciudad Origen:",5,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where inner_estados=1 )", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param2\", 0, 0)", "$id_ciudad", 1, 0);
	



$conde2="and cli_idciudad=$id_ciudad";

$conde4="";

$FB->llena_texto("Estado:",7,82,$DB,$estadocancel,"","$param7",4,0);

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
$FB->titulo_azul1("Fecha Ingreso",1,0,7); 
$FB->titulo_azul1("Fecha Recogida",1,0,0); 
$FB->titulo_azul1("Cliente",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 

$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Servicio",1,0,0); 
$FB->titulo_azul1("Descrpcion",1,0,0); 
if($param7=="cancelado"){
	$FB->titulo_azul1("Cancelado",1,0,0); 
}
$FB->titulo_azul1("Cancel Servicio",1,0,0); 

//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde1=""; 

  if($param7=="cancelado"){ $conde1="ser_estado=100"; } else if($param7=="Activo"){ $conde1="ser_estado<=3"; } else {  $conde1="ser_estado<=3"; }

  $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_visto,`ser_fecharegistro`,ser_desvaliguia,usu_nombre FROM serviciosdia  left join usuarios on idusuarios=ser_idusuarioregistro 
 where  $conde1 $conde $conde2 $conde3 $conde4 ORDER BY ser_fecharegistro $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$rw1[4]=str_replace("&"," ", $rw1[4]);
		$rw1[7]=str_replace("&"," ", $rw1[7]);
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[12]."</td>
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>

		<td>".$rw1[8]."</td>";

		echo "<td>".$rw1[9]."</td>";

		$descrip="des_$va";
		//$FB->llena_texto("Descripcion:",$descrip,9, $DB, "", "",@$rw[1] ,1, 0);	
		echo "<td><textarea name='des_$va' id='des_$va' value='' style='width:195px; class='text' >$rw1[13]</textarea></td>";
		if($param7=="cancelado"){
			 echo "<td>".$rw1[14]."</td>";
		 }
		echo "<td><div id='campo$va'>";
		echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:#074f91;color:#f9f9f9;font-size:15px'  name='$va' id='$va'   class='borrar' required>";
		$LT->llenaselect_ar("Selecccione...",$estados);
		echo "</select></div><input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'></td>";
		
		
	echo "</tr>"; 
	}


include("footer.php");
?>