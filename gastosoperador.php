<?php
require("login_autentica.php"); 
include("layout.php");
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];

if($nivel_acceso==1 or $nivel_acceso==5 or $nivel_acceso==10){

if($param1!=""){  $conde1="and usu_idsede='$param1'";  $id_sedes =$param1; }  else {$param1=""; $conde1="and usu_idsede=$id_sedes ";  }
if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1.="and (asi_idpromotor='$param2' or asi_idautoriza='$param2')"; } } else {$param2="";  }
if($param4!=''){ 
	$conde1.="and date(asi_fecha)>='$param5' and date(asi_fecha)<='$param4'";  

	 $fechaactual=$param4;  
	 $fechainicio=$param5;  
	}else{
		$conde1.="and date(asi_fecha)>='$fechainicio' and date(asi_fecha)<='$fechaactual'";  
	}
if($nivel_acceso==1 or $nivel_acceso==10){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }
$FB->titulo_azul1("Gastos Operador ",9,0,7);  
$FB->abre_form("form1","","post");

	$conde="";
	$conde="asi_fecha";
	$conde2="and usu_idsede=$id_sedes "; 

	$FB->llena_texto("Fecha de inicio:", 5, 10, $DB, "", "", "$fechainicio", 17, 0);
	$FB->llena_texto("Fecha fin:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);
	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "cambio4(\"param2\",\"param1\",\"gastosoperador.php\")", "$id_sedes", 1, 1);
	//$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);
	$FB->llena_texto("Operario:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) $conde2", "", $param2, 1, 0);
	$FB->llena_texto("confirmar:", 6, 82, $DB, $confirmar, "", "$param6", 4, 1);

	$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
	$FB->cierra_form(); 

}else{
	$conde1="and usu_idsede=$id_sedes "; 
	$conde1.="and (asi_idpromotor='$id_usuario')";	
	$conde1.=" and asi_fecha like '$fechaactual%'"; 
}



if($rcrear==1) { $FB->nuevo("GastosOperador", $condecion, ""); } 

//$FB->titulo_azul1("Fecha",1,0,5); 

$FB->titulo_azul1("Confirmar",1,0,5); 
$FB->titulo_azul1("Valor ",1,0,0); 
$FB->titulo_azul1("Descripcion ",1,0,0); 
$FB->titulo_azul1("Valor Confirmado",1,0,0); 

if($nivel_acceso==1  or $nivel_acceso==5 or $nivel_acceso==10){
$FB->titulo_azul1("Fecha Confirmado",1,0,0); 
$FB->titulo_azul1("Operador",1,0,0); 
}
$FB->titulo_azul1("Clasificacion",1,0,0); 
$FB->titulo_azul1("Tipo",1,0,0); 
$FB->titulo_azul1("Imagen",1,0,0); 

if($nivel_acceso==1){
	if($param1==""){
		$conde1='and  asi_usercom IS NULL';
	}

	
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
} 

if($param6=="" or $param6=="0"){
	$conde21="and  asi_usercom IS NULL";
}else{
	$conde21="and  asi_usercom IS NOT NULL";
}

  $sql="SELECT `idasignaciondinero`,`asi_fecha`,  `asi_tipo`,usu_nombre, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor`,asi_usercom, `asi_valorcom`, `asi_fechaconf`,asi_idgastos FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0 and asi_tipo in ('Gastos')  $conde1 $conde21 ORDER BY asi_fecha desc";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

	
	if($rw1[7]==$id_usuario and $rw1[8]!=''){

		echo "<td>CONFIRMADO</td>";

	}else if($rw1[8]=='' and $rw1[7]==$id_usuario ){
		echo "<td>POR CONFIRMAR</td>";
	}else if($nivel_acceso==1){

		echo "<td align='center' >
		<a  onclick='pop_dis10($id_p,\"Confirmargastos\",\"Gastos\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
	
	}else if($rw1[8]==''){
		echo "<td>POR CONFIRMAR</td>";
	}else if($rw1[8]!=''){
		echo "<td>CONFIRMADO</td>";
	}

		$valor=number_format($rw1[4],0,".",".");
		@$valor2=number_format($rw1[9],0,".",".");
		echo "
		<td>".$valor."</td>	
		<td>".$rw1[5]."</td>
		<td>".$valor2."</td>";
		if($nivel_acceso==1 or $nivel_acceso==5 or $nivel_acceso==10){
				echo "<td>".$rw1[10]."</td>
				<td>".$rw1[3]."</td>
				";
		}	

		 $sql="SELECT cla_nombre,tipo_nombre FROM `tipo_gastos` inner join clasificacion_gastos on inner_clasificacion_gastos=idclasificacion_gastos where idtipo_gastos='$rw1[11]';";
		$DB->Execute($sql);
		$rw3=mysqli_fetch_array($DB->Consulta_ID);
		
		echo "	<td>".$rw3[0]."</td>
		<td>".$rw3[1]."</td>
		";

		$LT->llenadocs2($DB, "asignaciondinero", $id_p, 1, 35, 1);
		if($nivel_acceso==1){
			$DB->edites($id_p, "gastosoperador", 2, $condecion);
		//$DB->edites($id_p, "asignardinero", 1, $condecion);
		}
	echo "</tr>";
}
include("footer.php"); ?>

<script>
// Obtener el campo de entrada


function ejecutarFuncion(valor) {
  // Obtener el valor ingresado en el input
  

  // Llamar a la función y pasarle el valor ingresado
  var campoValor = document.getElementById('param8');
  var valorIngresado = campoValor.value;
  var numCaracter= valor.length;
  

  if (valorIngresado.length >= valor.length) {
		if (valor === valorIngresado) {
		//Llamar a la función y pasarle el valor ingresado

		}else{
			setTimeout(function() {
			alert("El Monto no coincide con el valor del gasto que es "+valor);
			campoValor.value = '';
		}, 500); // 1000 milisegundos = 1 segundo
		
		}
		
	}

	// Verificar si la longitud del valor ingresado es igual a 4
	// if (valorIngresado.length === 4) {
	// // Llamar a la función y pasarle el valor ingresado
	// alert("ok"+valor);
	// }
}
</script>