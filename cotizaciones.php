<style>
        .container-left {
            float: left;
            margin-right: 10px; /* Espacio entre botones */
        }

        .container-right {
            float: right;
            margin-left: 10px; /* Espacio entre botones */
        }
		<style>
        /* Estilo general del cuerpo */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        /* Contenedor del input y el botón */
        .input-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        /* Estilo para el input */
        .link-input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        /* Estilo para el botón de copiar */
        .copy-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .copy-button:hover {
            background-color: #45a049;
        }
		     /* Contenedor del icono y el botón */
			 .container {
            text-align: left;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para el icono de imagen */
        .image-icon {
            font-size: 64px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        /* Estilo para el botón de descarga */
        .download-button {
            display: inline-flex;
            align-items: left;
			
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .download-button:hover {
            background-color: #45a049;
        }

        /* Estilo para el icono dentro del botón */
        .download-button .mdi {
            margin-right: 8px;
        }
    
</style>
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
<?php 
require("login_autentica.php"); 
include("layout.php");
echo '<div class="container-left">';

echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Camara comercio\",\"$rw1[5]\")' >Camara de comercio</button>";
echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Rut\",\"$rw1[5]\")' >Rut</button>";
echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Certificacion bancaria\",\"$rw1[5]\")' >Certificacion bancaria</button>";
echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Brochur\",\"$rw1[5]\")' >Brochur</button>";


echo'</div>';
echo'<div class="container-right">';


echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Agregar cotizacion\",\"$rw1[5]\")' >+Cotizacion</button>";

echo'</div>';

$cond2="idsedes ='$id_sedes'";
$FB->titulo_azul1("Cotizaciones",9,0,5);  
$FB->abre_form("form1","cotizaciones.php","post");

if($param5!=''){  $conde2="and hoj_sede=$param5"; }  else { $conde2=""; }

$por["cot_nit"]="Nit";
$por["cot_id"]="Num factura";

$estado["realizada"]="Realizada";
$estado[""]="No realizada";
$FB->llena_texto("Busqueda por:",3,82,$DB,$por,"",$param3,17,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2",4,0);
$FB->llena_texto("Fecha desde:", 34, 10, $DB, "", "", "$param34", 1, 0);
$FB->llena_texto("Fecha hasta:", 36, 10, $DB, "", "", "$param36", 4, 0);
$FB->llena_texto("Sede :",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 and sed_principal='si' $conde2  order by sed_nombre asc  )", "", "$id_sedes",1, 0);
$FB->llena_texto("Estado:",4,82,$DB,$estado,"",$param4,4,0);
 $anioinc = 2020;
 $aniofin = date("Y");








$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 

	if ($param2 !="") {
		$cond="and $param3='$param2'";# code...
	}else{
		$cond="";
	}
	if ($param35 !="") {
		$cond2="and idsedes ='$param35'";# code...
	}else{
		if($nivel_acceso==1){
			$cond2="";	
		}else{
		$cond2="and idsedes ='$id_sedes'";

		}
	}
    if($param34!="" ){ 
		$conde1="and cot_fecha>='$param34' and cot_fecha<='$param36'";
	}else{
		$conde1="";
	}

    if($param4!="" ){ 
		$conde3="and cot_estado='$param4' ";
	}else{
		$conde3="and cot_estado='' ";
	}

	

//   if($param4!='0' and $param4!=''){
// 	  $cond5=" and hoj_estado='$param4'";
//   }

//   if($param1!='0' and $param1!=''){
// 	$cond3=" and hoj_tipocontrato='$param1'";
// }



if(isset($_REQUEST["ordby"])){ $ordby=$_REQUEST["ordby"]; } else { $ordby="hoj_nombre,hoj_apellido"; } 
if(@$_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } 	$asc2=""; if($asc=="ASC"){ $asc2="DESC";}
//$condlimit=$FB->llena_sigant($pagina, $ordby, $asc, $valor); 


// $FB->titulo_azul1("#",1,0,7); 
$FB->titulo_azul1("Numero",1,0,7); 
$FB->titulo_azul1("Cliente",1,0,0); 
$FB->titulo_azul1("Cotizacion",1,0,0); 
$FB->titulo_azul1("Fecha",1,0,0);
// $FB->titulo_azul1("Manifiesto",1,0,0);
// $FB->titulo_azul1("Remesas de carga",1,0,0);
$FB->titulo_azul1("Enviar al correo",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Editar",1,0,0); 
$FB->titulo_azul1("Eliminar",1,0,0); 


$sql="SELECT `cot_id`, `cot_clirente`, `cot_nit`, `cot_origen`, `cot_destino`, `cot_direc_origen`, `cot_direc_destino`, `cot_desc_merc`, `cot_tipo_servi`, `cot_peso`, `cot_val_minima`, `cot_kilo_adi`, `cot_vol`, `cot_val_asegurado`, `cot_val_seguro`, `cot_val_kilos_adi`, `cot_val_servicio`, `cot__val_total`,cot_fecha,cot_correo,cot_Whatsapp,cot_enviado,sed_nombre,usu_nombre,cot_estado FROM cotozaciones JOIN usuarios ON cot_id_ingresa = idusuarios JOIN sedes ON usu_idsede = idsedes WHERE cot_id>0 $cond2 $cond $conde1 $conde3 order by cot_id desc";

$DB->Execute($sql); $va=(($compag-1)*$CantidadMostrar); 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

		echo "<td>".$rw1[0]."</td>";

		$conductor = "SELECT `cond_nombre`,cond_firma FROM  `conductor_mani` where condid=$rw1[1] ";
		$DB1->Execute($conductor);
		$rw2 = mysqli_fetch_array($DB1->Consulta_ID);

		echo "<td>".$rw1[1]."</td>";

		$vehiculo = "SELECT `vehim_placas` FROM  `vehiculo_manif` where vehimid=$rw1[2] ";
		$DB1->Execute($vehiculo);
		$rw3 = mysqli_fetch_array($DB1->Consulta_ID);

		// echo "<td>".$rw3[0]."</td>";
		// echo "<td><a href='".$rw1[7]."' target='_blank'>Ver</a></td>";
		// if ($rw1[8]=="") {
		// 	echo "<td>Sin archivo</td>";

		// }else {
		// echo '<td><a  href="#" onclick="ver('.$rw1[1].','.$rw1[2].','.$rw1[3].','.$rw1[4].','.$rw1[5].','.$rw1[6].','.$rw1[7].','.$rw1[8].','.$rw1[9].','.$rw1[10].','.$rw1[11].','.$rw1[12].','.$rw1[13].','.$rw1[14].','.$rw1[15].','.$rw1[16].','.$rw1[17].','.$rw1[18].');">Ver</a></td>';

        echo '<td><a href="#" onclick="ver(' . 
        "'" . addslashes($rw1[0]) . "'," .  // Se utiliza addslashes para escapar las comillas y caracteres especiales
        "'" . addslashes($rw1[1]) . "'," . 
        "'" . addslashes($rw1[2]) . "'," . 
        "'" . addslashes($rw1[3]) . "'," . 
        "'" . addslashes($rw1[4]) . "'," . 
        "'" . addslashes($rw1[5]) . "'," . 
        "'" . addslashes($rw1[6]) . "'," . 
        "'" . addslashes($rw1[7]) . "'," . 
        "'" . addslashes($rw1[8]) . "'," . 
        "'" . addslashes($rw1[9]) . "'," . 
        "'" . addslashes($rw1[10]) . "'," . 
        "'" . addslashes($rw1[11]) . "'," . 
        "'" . addslashes($rw1[12]) . "'," . 
        "'" . addslashes($rw1[13]) . "'," . 
        "'" . addslashes($rw1[14]) . "'," . 
        "'" . addslashes($rw1[15]) . "'," . 
        "'" . addslashes($rw1[16]) . "'," . 
        "'" . addslashes($rw1[17]) . "'," . 
		"'" . addslashes($rw1[18]) . "'," . 
		"'" . addslashes($rw1[22]) . "'," . 
        "'" . addslashes($rw1[23]) . "');\">Ver</a></td>";
		// }
		// if ($rw1[12]=="") {
		// 	echo "<td>Sin archivo</td>";

		// }else {
		// 	echo "<td><a href='maniRemesaCarga.php?pdf=$rw1[12]&dato=$rw2[1]' target='_blank'>Ver</a></td>";

		// }
		// if ($rw1[13]=="") {
		// 	echo "<td>Sin archivo</td>";

		// }else {
		// 	echo "<td><a href='img_manifiestos/manifiestos/$rw1[13]' target='_blank'>Ver</a></td>";

		// }
	
         if($rw1[21]==""){

            $textEnviar1="Enviar";
            $colorEnviar1="rgb(7, 79, 145)";
         }else{

            $colorEnviar1="#28B463";
            $textEnviar1="Reenviar";
         }
		echo"<td>$rw1[18]</td>";
        echo"<td><button style='display: $botonEnviar2; width:120px;border:1px solid #f9f9f9;background-color:".$colorEnviar1.";color:#f9f9f9;font-size:15px' id='correo".$rw1[0]."' onclick='enviarCorreo($rw1[0],\"$rw1[1]\",\"$rw1[19]\")'>$textEnviar1</button></td>";
		if ($rw1[24]=="realizada") {
			$colorselect="#28B463";
			$si="selected";
			$no="";
			$linkotros="auto";
		}else if($rw1[24]==""){
			$si="";
			$no="selected";
			$colorselect="#8B0000";
			$linkotros="none";
		}

		echo "<td><div id='campo'>";
		echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:".$colorselect.";color:#f9f9f9;font-size:15px'  name='$va' id='".$rw1[0]."estado'  onchange='realizada($rw1[0],\"realizada\",this.value)' class='borrar' required>";
		// $LT->llenaselect_ar("Selecccione...",$estadosguiasinfin);
		echo"<option value='' $no>No realizada</option>";
		echo"<option value='realizada'$si>Realizada</option>";
	   

		echo"</select>";
	echo "<td>	<a onclick='pop_dis16($id_p, \"Editar cotizacion\",\"$rw1[1]\")';  style='cursor: pointer;' title='editar' >Editar</td>";
	if($nivel_acceso==1){
		$DB->edites($id_p, "cotizaciones", 2, $condecion);
	}

	}


include("footer.php");

?>
<script>

function ver(id,clirente,nit,origen,destino,direc_origen,direc_destino,desc_merc,tipo_servi,peso,val_minima,kilo_adi,vol,val_asegurado,val_seguro,val_kilos_adi,val_servicio,val_total,fecha,ciudadhecho,usuhecho){
var url = "cotiza_descargable.php?id=" + encodeURIComponent(id) + "&clirente=" + encodeURIComponent(clirente)+ "&origen=" + encodeURIComponent(origen)+ "&nit=" + encodeURIComponent(nit)+ "&destino=" + encodeURIComponent(destino)+ "&direc_origen=" + encodeURIComponent(direc_origen)+ "&direc_destino=" + encodeURIComponent(direc_destino)+ "&desc_merc=" + encodeURIComponent(desc_merc)+ "&tipo_servi=" + encodeURIComponent(tipo_servi)+ "&peso=" + encodeURIComponent(peso)+ "&val_minima=" + encodeURIComponent(val_minima)+ "&kilo_adi=" + encodeURIComponent(kilo_adi)+ "&vol=" + encodeURIComponent(vol)+ "&val_asegurado=" + encodeURIComponent(val_asegurado)+ "&val_kilos_adi=" + encodeURIComponent(val_kilos_adi)+ "&val_servicio=" + encodeURIComponent(val_servicio)+ "&val_total=" + encodeURIComponent(val_total)+ "&fecha=" + encodeURIComponent(fecha)+ "&val_seguro=" + encodeURIComponent(val_seguro)+ "&ciudadhecho=" + encodeURIComponent(ciudadhecho)+ "&usuhecho=" + encodeURIComponent(usuhecho);

// Abrir la nueva página en una nueva pestaña
window.open(url, "_blank");   
}
function enviarCorreo(id,cliente,email){

	
	var boton = document.getElementById("correo"+id);
	datos = {"numFac":id,"cliente":cliente,"email":email};
			$.ajax({
					url: "cotizaEmail.php",
					type: "POST",
					data: datos
				}).done(function(respuesta){
					
					if (respuesta=="Revise el archivo antes de enviarlo y vuelva a intentar.") {
						alert("ERROR revise el archivo antes de enviarlo y vuelva a intentar.");
					}else{
                   	alert(respuesta);

					boton.textContent = 'Reenviar';
					boton.style.backgroundColor = "#28B463";
					}
				});
}

        // Función para copiar el enlace al portapapeles
		function copyLink(event) {
            event.preventDefault(); // Previene el comportamiento predeterminado del enlace

            // Obtén el valor del input
            var copyText = document.getElementById("linkInput").value;

            // Usa la API moderna de portapapeles
            navigator.clipboard.writeText(copyText).then(function() {
                // Opcional: Muestra un mensaje de confirmación
                alert("Enlace copiado: " + copyText);
            }).catch(function(error) {
                console.error("Error al copiar el enlace: ", error);
            });
        }

function realizada(id,funcion,estado){
	
	// var valorAbono=document.getElementById(valor1,fechaini,fechafin).value;
	// var valorAbono = document.getElementById(valor1).value;
	
	 var select = document.getElementById(id+"estado");
	// var enlace = document.getElementById(tipo+idusuario);
	// var funcion = "realizada";

datos = {"id":id,"funcion":funcion,"estado":estado};
		$.ajax({
				url: "guardarcotizacion.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				


				// if (respuesta.trim().toLowerCase() === "ok") {
				// 	// La respuesta es "ok", realiza las acciones correspondientes
				// 	console.log("OK");
				// 	// Cambia el color de fondo
		
					if (estado=="realizada") {
						select.style.backgroundColor = "#28B463"; // Cambia "red" por el color que desees
					}else{
						select.style.backgroundColor = "#8B0000"; // Cambia "red" por el color que desees
					}
				// } else {
				// 	// La respuesta no es "ok", maneja el caso de otra manera si es necesario
				// 	console.log("error al guardar cambio");
				// }
			});
			
}
</script>