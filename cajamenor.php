<?php
require("login_autentica.php"); 
include("layout.php");
$nivel_acceso=$_SESSION['usuario_rol'];


$conde1="";
$conde10="";
if(isset($_REQUEST["param1"])){ if($param1!=""){  $conde1.="and caj_idciudadori='$param1' or caj_idciudaddes='$param1' ";  $id_sedes=$param1; } } 
else {$param1="";  $conde1.="and caj_idciudadori='$id_sedes' or caj_idciudaddes='$id_sedes' ";   }

if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1.=" and asi_idpromotor='$param2'"; } } else {$param2="";  }
if($param4!=''){ $conde10.="and date(caj_fecharegistro)>='$param5' and date(caj_fecharegistro)<='$param4'";  
	$fechaactual=$param4;  
	  $fechainicio=$param5;    } 
else { 
	if($nivel_acceso==1){
		$conde10.=" "; 
		$conde1="";

	}else{

		$conde10.=" and date(caj_fecharegistro)>='$fechainicio' and date(caj_fecharegistro)<='$fechaactual'"; 
	}
	 
}
if($rcrear==1) { $FB->nuevo("cajamenor", $condecion, ""); } 

$FB->titulo_azul1("Caja Menor  ",9,0,7);  
$FB->abre_form("form1","","post");


$conde="";
$conde="caj_fecharegistro";



if($nivel_acceso==1 or $nivel_acceso==10){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }

$FB->llena_texto("Fecha de inicio:", 5, 10, $DB, "", "", "$fechainicio", 1, 0);
$FB->llena_texto("Fecha fin:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);

$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "", "$id_sedes", 1, 1);
$FB->llena_texto("Tipo de transaccion:", 3, 82, $DB, $transaccion, "", "$param3", 4, 1);
$FB->llena_texto("confirmar:", 6, 82, $DB, $confirmar, "", "$param6", 4, 1);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 



$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Usuario",1,0,0); 
$FB->titulo_azul1("Sede Origen",1,0,0); 
$FB->titulo_azul1("Sede Destino",1,0,0); 
$FB->titulo_azul1("Transaccion",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
$FB->titulo_azul1("confirmar",1,0,0); 
$FB->titulo_azul1("Confirmo",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
$FB->titulo_azul1("Fecha Confirmacion",1,0,0); 

$FB->titulo_azul1("Clasificacion",1,0,0); 
$FB->titulo_azul1("Tipo",1,0,0); 
$FB->titulo_azul1("Imagen",1,0,0); 


if($nivel_acceso==1){
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
}

if($param6=="" or $param6=="0"){
	$conde2="and caj_usucom=''";
}else{
	$conde2="and caj_usucom!=''";
}
if($param3!=''){
	$conde2.="and caj_tipotransacion like '%$param3%' ";
}

 $sql="SELECT `idcajamenor`, `caj_fecharegistro`, `usu_nombre`,`sed_nombre`, `caj_tipotransacion`, `caj_descripcion`, `caj_valor`,`caj_usucom`, 
 `caj_cantcom`, `caj_feccom`,caj_idciudaddes,caj_idciudadori,caj_idgastos 
 FROM `cajamenor` inner join usuarios on caj_idusuario=idusuarios 
 inner join sedes on idsedes=caj_idciudaddes $conde10  $conde2  WHERE idcajamenor>0 $conde1  ORDER BY caj_fecharegistro  ASC ";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
//	$rw1[6]=number_format($rw1[6],0,".",".");
		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[11]'";
		$DB->Execute($sql2);
		$rw=mysqli_fetch_row($DB->Consulta_ID);

	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw[1]."</td>	
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		
		";
		

		
		 if($nivel_acceso==1 or $nivel_acceso==5 or $nivel_acceso==11){
			echo "<td align='center' >
			<a  onclick='pop_dis10($id_p,\"Confirmar\",\"$rw1[4]\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
		}
		else {
			echo "	<td><img src='img/Confirmar.png'></a></td>";
		}	
		echo "	<td>".$rw1[7]."</td>
		<td>".$rw1[8]."</td>
		<td>".$rw1[9]."</td>";

		$sql="SELECT cla_nombre,tipo_nombre FROM `tipo_gastos` inner join clasificacion_gastos on inner_clasificacion_gastos=idclasificacion_gastos where idtipo_gastos='$rw1[12]';";
		$DB->Execute($sql);
		$rw3=mysqli_fetch_array($DB->Consulta_ID);
		
		echo "	<td>".$rw3[0]."</td>
		<td>".$rw3[1]."</td>
		";

		$LT->llenadocs2($DB, "cajamenor", $id_p, 1, 35, 1);
	if($nivel_acceso==1){
		$DB->edites($id_p, "cajamenor", 2, $condecion);
	}
	echo "</tr>";
}
include("footer.php"); ?>
<script>
// Obtener el campo de entrada


function ejecutarFuncion(valor) {
  // Obtener el valor ingresado en el input
  

  // Llamar a la función y pasarle el valor ingresado
  var campoValor = document.getElementById('param6');
  var valorIngresado = campoValor.value;
  var numCaracter= valor.length;
  

  if (valorIngresado.length >= valor.length) {
		if (valor === valorIngresado) {
		//Llamar a la función y pasarle el valor ingresado

		}else{
			setTimeout(function() {
			alert("El Monto no coincide, debe ser"+valor);
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