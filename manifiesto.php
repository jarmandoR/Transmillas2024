<style>
        .container-left {
            float: left;
            margin-right: 10px; /* Espacio entre botones */
        }

        .container-right {
            float: right;
            margin-left: 10px; /* Espacio entre botones */
        }
</style>
<?php 
require("login_autentica.php"); 
include("layout.php");
echo '<div class="container-left">';

echo '<button type="button" class="btn btn-danger btn-lg" onclick="window.location.href = \'adm_manifiestos.php?funcion=Vehiculos\';" >Vehiculos</button>';
echo '<button type="button" class="btn btn-danger btn-lg" onclick="window.location.href = \'adm_manifiestos.php?funcion=Conductores\';" >Conductores</button>';

echo'</div>';
echo'<div class="container-right">';


echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Agregar viaje\",\"$rw1[5]\")' >+Viaje</button>";

echo'</div>';


$FB->titulo_azul1("Manifiesto de carga",9,0,5);  
$FB->abre_form("form1","manifiesto.php","post");

	if($param5!=''){  $conde2="and hoj_sede=$param5"; }  else { $conde2=""; }

$FB->llena_texto("Busqueda por:",3,82,$DB,$busquedamani,"",$param3,17,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2",4,0);
$FB->llena_texto("Fecha:", 34, 10, $DB, "", "", "$fechaactual", 1, 0);
 $anioinc = 2020;
 $aniofin = date("Y");





if ($param2 !="") {

	if ($param3=="Placa vehiculo") {
		$JOIN="inner join vehiculo_manif on vehimid=mani_idVehiculo";
		$cond="and vehim_placas like '$param2%'";# code...
		
	}else if($param3=="Conductor"){

		
		$JOIN="inner join conductor_mani on condid=mani_idConduc";
		$cond="and cond_nombre like '$param2%'";
	}
	
}else{
	$JOIN="";
	$cond="";
}




$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 

$conde1=""; 

  if($param2!="" and $param3!=""){ 
   $conde1="and $param3 like '%$param2%' "; 
	}else { $conde1="  "; } 


  if($param4!='0' and $param4!=''){
	  $cond5=" and hoj_estado='$param4'";
  }

  if($param1!='0' and $param1!=''){
	$cond3=" and hoj_tipocontrato='$param1'";
}



if(isset($_REQUEST["ordby"])){ $ordby=$_REQUEST["ordby"]; } else { $ordby="hoj_nombre,hoj_apellido"; } 
if(@$_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } 	$asc2=""; if($asc=="ASC"){ $asc2="DESC";}
//$condlimit=$FB->llena_sigant($pagina, $ordby, $asc, $valor); 


// $FB->titulo_azul1("#",1,0,7); 
$FB->titulo_azul1("Fecha ",1,0,7); 
$FB->titulo_azul1("Conductor",1,0,0); 
$FB->titulo_azul1("Placa Vehiculo",1,0,0); 
$FB->titulo_azul1("Contrato",1,0,0);
$FB->titulo_azul1("Manifiesto",1,0,0);
$FB->titulo_azul1("Remesas de carga",1,0,0);
$FB->titulo_azul1("Guias",1,0,0); 
$FB->titulo_azul1("Seguridad",1,0,0); 
$FB->titulo_azul1("Calificacion",1,0,0); 
$FB->titulo_azul1("Editar",1,0,0); 
$FB->titulo_azul1("Eliminar",1,0,0); 


   $sql="SELECT `idmani`, `mani_idConduc`, `mani_idVehiculo`, `mani_valor_cont`, `mani_fecha_ini`, `mani_fecha_fin`, `mani_piezas`, `mani_Contrato`, `mani_manifiesto`, `mani_fecha`, `mani_idusuIngreso`, `mani_ciudad_destino`,mani_remesa_carga,mani_guias,mani_cal,mani_comentario,mani_seguridad  FROM `manifiestos_viajes` $JOIN where idmani>0 $cond ORDER BY  idmani desc ";

$DB->Execute($sql); $va=(($compag-1)*$CantidadMostrar); 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

		echo "<td>".$rw1[4]."</td>";

		$conductor = "SELECT `cond_nombre`,cond_firma FROM  `conductor_mani` where condid=$rw1[1] ";
		$DB1->Execute($conductor);
		$rw2 = mysqli_fetch_array($DB1->Consulta_ID);

		echo "<td>".$rw2[0]."</td>";

		$vehiculo = "SELECT `vehim_placas` FROM  `vehiculo_manif` where vehimid=$rw1[2] ";
		$DB1->Execute($vehiculo);
		$rw3 = mysqli_fetch_array($DB1->Consulta_ID);

		echo "<td>".$rw3[0]."</td>";
		echo "<td><a href='".$rw1[7]."' target='_blank'>Ver</a></td>";
		if ($rw1[8]=="") {
			echo "<td>Sin archivo</td>";

		}else {
			echo "<td><a href='firmarManifiesto.php?pdf=$rw1[8]&dato=$rw2[1]' target='_blank'>Ver</a></td>";

		}
		if ($rw1[12]=="") {
			echo "<td>Sin archivo</td>";

		}else {
			echo "<td><a href='maniRemesaCarga.php?pdf=$rw1[12]&dato=$rw2[1]' target='_blank'>Ver</a></td>";

		}
		if ($rw1[13]=="") {
			echo "<td>Sin archivo</td>";

		}else {
			echo "<td><a href='img_manifiestos/manifiestos/$rw1[13]' target='_blank'>Ver</a></td>";

		}
		if ($rw1[16]=="") {
			echo "<td>Sin archivo</td>";

		}else {
			echo "<td><a href='img_manifiestos/manifiestos/$rw1[16]' target='_blank'>Ver</a></td>";

		}
	
		if ($rw1[14]=='Buena') {
			$bu="selected";
			$re="";
			$mal="";
			$colorselect="#28B463";
		}elseif ($rw1[14]=='Regular') {
			$bu="";
			$re="selected";
			$mal="";
			$colorselect="#D35400";
		}elseif ($rw1[14]=='Mala') {
			$bu="";
			$re="";
			$mal="selected";
			$colorselect="#8B0000";
		}else {
			$bu="";
			$re="";
			$mal="";
			$colorselect="rgb(7, 79, 145)";
		}
		echo "<td><div id='campo'>";
		echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:".$colorselect.";color:#f9f9f9;font-size:15px'  name='$id_p' id='$id_p'  onchange='califica($id_p,this.value)' class='borrar' required>";
		// $LT->llenaselect_ar("Selecccione...",$estadosguiasinfin);
		echo"<option value='Seleccione'>Seleccione...</option>";
		echo"<option value='Buena' $bu>Buena</option>";
		echo"<option value='Regular'$re>Regular</option>";
		echo"<option value='Mala'$mal>Mala</option>";

		echo"</select><br>";
		echo"<textarea name='$id_p' id ='desc$id_p' rows='' cols='' '>$rw1[15]</textarea></td>";
		// <input type="text" onchange="alert(this.value)">

	echo "<td>	<a onclick='pop_dis16($id_p, \"Editar viaje\",\"$rw1[1]\")';  style='cursor: pointer;' title='editar' >Editar</td>";
	if($nivel_acceso==1){
		$DB->edites($id_p, "manifiestos", 2, $condecion);
	}

	}

 //Operacion matematica para boton siguiente y atras 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
 // onchange=location.href='http://www.dominio/pagina.php?ref='+this.value
	$selec200="";
	$selec50="";
	$selec100="";
	$selec10000="";
 if($CantidadMostrar==50){ $selec50="Selected";} else if($CantidadMostrar==100){ $selec100="Selected";} else if($CantidadMostrar==200){ $selec100="Selected";} else if($CantidadMostrar==10000){ $selec10000="Selected";}
	echo "<section class='paginacion'><ul ><li>Mostrar <select onchange=location.href=\"?CantidadMostrar=\"+this.value ><option value='50' $selec50 >50</option><option value='100' $selec100>100</option><option value='200' $selec200>200</option><option value='10000' $selec10000>Todos..</option></select></li><li><a>Total Registros: $valor </a></li><li ><a href=\"?pag=".$DecrementNum."\" >&#171;&#171;</a></li>";
    //Se resta y suma con el numero de pag actual con el cantidad de 
    //numeros  a mostrar
     $Desde=$compag-(ceil($CantidadMostrar/2)-1);
     $Hasta=$compag+(ceil($CantidadMostrar/2)-1);
     //Se valida
     $Desde=($Desde<1)?1: $Desde;
     $Hasta=(($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta)/10;
     //Se muestra los numeros de paginas
     for($i=$Desde; $i<=$Hasta;$i++){
     	//Se valida la paginacion total
     	//de registros
     	if($i<=$TotalRegistro){
     		//Validamos la pag activo
     	  if($i==$compag){

           echo "<li><a href=\"?pag=".$i."\" class=\"active\">".$i."</a></li>";

     	  }else {

     	  	echo "<li><a href=\"?pag=".$i."\">".$i."</a></li>";

     	  }     		

     	}

     }

	echo "<li class=\"active\"><a href=\"?pag=".$IncrimentNum."\">&#187;&#187;</a></li></ul>";



include("footer.php");

?>
<script>
	function califica(idMani,valor) {
    var checkbox = document.getElementById(idMani);
    // var boton = document.getElementById(tipo+idusuario+"guardarCuenCobro");
	var option = "Seleccione"
	var estado = "calificacion";


		datos = {"idMani":idMani,"valor":valor,"estado":estado};
			$.ajax({
						url: "guardaManifiesto.php",
						type: "POST",
						data: datos
					}).done(function(respuesta){
						
				if (valor=='Buena') {
					checkbox.style.backgroundColor = "#28B463";
					
				}else if (valor=='Regular') {
					checkbox.style.backgroundColor = "#D35400";
					
				}else if (valor=='Mala') {
					checkbox.style.backgroundColor = "#8B0000";
					
				}else{
					checkbox.style.backgroundColor = "rgb(7, 79, 145)";

				}
						// checkbox.style.backgroundColor = "#28B463";
						// if (checkbox.checked) {
						// 	boton.style.display = "inline-block"; // Muestra el botón si el checkbox está marcado
						// } else {
						// 	boton.style.display = "none"; // Oculta el botón si el checkbox no está marcado
						// }
			});
	
}

document.querySelectorAll('textarea').forEach(textarea => {
            textarea.oninput = function() {
				var estado = "observacion";
                const id = textarea.id;
                const name = textarea.name;
                const value = textarea.value;


				datos = {"idMani":name,"Observacion":value,"estado":estado};
				$.ajax({
							url: "guardaManifiesto.php",
							type: "POST",
							data: datos
						}).done(function(respuesta){
							
				});
            };
        });
</script>