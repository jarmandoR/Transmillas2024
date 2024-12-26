<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
//echo "jose: ".$param5;
if($param5!=''){ $id_sedes=$param5;  $conde2=" "; }  

?>
<script>


</script>
<head>

	</head>
<body>

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","cierrecaja.php","post");
//$FB->nuevo("Planillas", "$id_ciudad", "nuevo_admin.php");
$FB->titulo_azul1("Cierre de Caja ",9,0,5);  


 
if($param4!=''){ $fechaactual=$param4;  }
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);
$conde3="";	
$conde4="";	




 if($nivel_acceso==3) {
	
$conde3="and ser_idresponsable='$id_usuario'";	
	
}

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
$FB->titulo_azul1("Sede",1,0,7); 
$FB->titulo_azul1("Fecha de cierre",1,0,0); 
$FB->titulo_azul1("Total dinero Dia",1,0,0); 
$FB->titulo_azul1("Dinero recogido por admin",1,0,0); 

$FB->titulo_azul1("Base en sede ",1,0,0); 
$FB->titulo_azul1("Total cierre del dia ",1,0,0); 

$FB->titulo_azul1("Valor Total",1,0,0); 
$FB->titulo_azul1("Confirmar ",1,0,0); 


$conde1=""; 

if($param2!="" and $param1!=""){ 
 $conde1="and $param1 like '%$param2%' "; 
  }else { $conde1="  "; } 
  
if($param1==""){ $param1="ser_prioridad"; } 

$sql2="SELECT idsedes,sum(cus_dinerosede),sed_nombre,cus_fecha,cus_datos,idcuentassede,cue_estado  FROM `cuentassede` inner join sedes on cus_idsede=idsedes WHERE `cus_fecha` like '%$fechaactual%'  group by idsedes ORDER BY sed_nombre";
$DB1->Execute($sql2); 
$va=0; 
$cierre=array();
while($rw=mysqli_fetch_row($DB1->Consulta_ID))
	{
		

		$cierre[$rw[0]]['valor']=$rw[1];
		$cierre[$rw[0]]['nombre']=$rw[2];
		$cierre[$rw[0]]['fecha']=$rw[3];

		$cierre[$rw[0]]['array']=$rw[4];
		$cierre[$rw[0]]['id']=$rw[5];
		$cierre[$rw[0]]['estado']=$rw[6];
		    
			

	
	
	}
	$sql="SELECT idsedes,sed_nombre FROM  sedes where sed_principal='si'";
	$DB->Execute($sql); 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
	
		$estado="";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}	
		
		
		$arrayData = json_decode($cierre[$id_p]['array'], true);

		// Verificar si el JSON se deserializó correctamente
		//  if (json_last_error() === JSON_ERROR_NONE) {




				

			$dinerorecogido = $arrayData['dinerorecogido'];
			$totalsededia = $arrayData['totalsededia'];
			$dinerobase = $arrayData['dinerobase'];

		//  }














		// <td>".$totalDinero."</td>

        $totalDinero=$cierre[$id_p]['valor']-$dinerobase;
		$total=$cierre[$id_p]['valor']+$dinerobase;
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[1]."</td>
		<td>".$cierre[$id_p]['fecha']."</td>
		<td>".$totalsededia."</td>
		<td>".$dinerorecogido."</td>
		
		<td>".$dinerobase."</td>
		<td>".$cierre[$id_p]['valor']."</td>
		<td>".$total."</td>";
		
		$id=$cierre[$id_p]['id'];	

		echo "
		<td align='left' ><select class='trans'  name='param21' id='param21' onchange='estadocierre(this.value,$id)'>";
		if ($cierre[$id_p]['estado']=="SI") {
			echo "<option  value='NO'>NO</option>";
			echo "<option  value='SI' selected>SI</option>";
		}else {
			echo "<option  value='NO' selected>NO</option>";
			echo "<option  value='SI'>SI</option>";
		}
		echo "</select></td>";	
		echo "</tr>"; 

	}


include("footer.php");
?>
<script>
function estadocierre(valor,id){
	
	// var valorAbono=document.getElementById(valor1,fechaini,fechafin).value;
	// var valorAbono = document.getElementById(valor1).value;
	
	//  var select = document.getElementById(id+"estado");
	// var enlace = document.getElementById(tipo+idusuario);
	 var funcion = "estadocierre";

datos = {"id":id,"funcion":funcion,"valor":valor};
		$.ajax({
				url: "guardarHVT.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				


				// if (respuesta.trim().toLowerCase() === "ok") {
				// 	// La respuesta es "ok", realiza las acciones correspondientes
				// 	console.log("OK");
				// 	// Cambia el color de fondo
		
					// if (estado=="realizada") {
					// 	select.style.backgroundColor = "#28B463"; // Cambia "red" por el color que desees
					// }else{
					// 	select.style.backgroundColor = "#8B0000"; // Cambia "red" por el color que desees
					// }
				// } else {
				// 	// La respuesta no es "ok", maneja el caso de otra manera si es necesario
				// 	console.log("error al guardar cambio");
				// }
			});
			
}



</script>