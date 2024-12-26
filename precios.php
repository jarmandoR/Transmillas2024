<style>
        .container{
            float: left;
            margin-right: 10px;
			display: flex;
            align-items: center;
        }
		.archivo-button {
         margin-right: 10px; /* Espacio entre el input y el botón */
        }
        .email-button {
            display: inline-flex;
            align-items: center;
            background-color: #2196F3; /* Color de fondo */
            color: white; /* Color del texto */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
			margin-right: 10px; /* Espacio entre el input y el botón */
        }

        .file-button {
            display: inline-flex;
            align-items: center;
            background-color: #4CAF50; /* Color de fondo */
            color: white; /* Color del texto */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
			margin-right: 10px; /* Espacio entre el input y el botón */
        }
        .email-button i {
            margin-right: 8px; /* Espacio entre el icono y el texto */
        }

        .file-button i {
            margin-right: 8px; /* Espacio entre el icono y el texto */
        }



        .file-button {
            background-color: #4CAF50;
        }
	
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script>
    
	function generatePDF() {
		window.location.href = 'descargarprecios.php';
	}
	</script>
<?php


if ($_REQUEST["descargar"]=="1") {
// 	header('Content-type: application/vnd.ms-excel; charset=utf-8');
// 	header("Content-Disposition: attachment; filename=Precios_.xls;  charset=utf-8");
// 	header("Pragma: no-cache");
// 	header("Expires: 0"); 
// 	require("login_autentica.php");
//     include("cabezote3.php");


require("login_autentica.php"); 
include("layout.php");

$conde="";
$conde="pre_idciudadori";
$precioinicialkilos=$_SESSION['precioinicial'];


if(isset($_REQUEST["param1"]) && isset($_REQUEST["param2"])){ if($param1!="" and $param2!=""){  $conde="pre_idciudadori"; $conde1="and (pre_idciudadori='$param1' and pre_idciudaddes='$param2') or  (pre_idciudaddes='$param1' and pre_idciudadori='$param2')"; }else {

	if(isset($_REQUEST["param1"])){ if($param1!=""){  $conde="pre_idciudadori"; $conde1="and pre_idciudadori='$param1' "; } } else {$param1=""; $conde1=""; }
	if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde="pre_idciudaddes"; $conde1.="and pre_idciudaddes='$param2' "; } } else {$param2="";  $conde1="";}
	} } 

	$FB->titulo_azul1("Configuraci&oacute;n de Precios",9,0,7);  
	$FB->abre_form("form1","","post");
	
	$FB->llena_texto("Ciudad 1:",1,2,$DB,"SELECT `idciudades`, `ciu_nombre` FROM `ciudades`  where inner_estados=1","cambio1(this.value, param2.value, \"precios.php\", 1);",$param1,1,0);
	$FB->llena_texto("Ciudad 2:",2,2,$DB,"SELECT `idciudades`, `ciu_nombre` FROM ciudades","cambio1(param1.value, this.value, \"precios.php\", 1);",$param2,4,0);
	

	
	$FB->cierra_form();
	// if($rcrear==1) { $FB->nuevo("Precios", $condecion, ""); } 
	

echo'<table  class="tabla">';
echo'<tr bgcolor="#074F91" style="color:#FFFFFF;">';
echo'<th >Ciudad Origen</th>';
echo'<th >Ciudad Destino</th>';
echo'<th >Primeros '.$precioinicialkilos.' Kg </th>';



	$sql = "SELECT `idprecioskilos`, `pre_inicial`, `prec_final` FROM `precioskilos` order by pre_inicial asc";
	$DB1->Execute($sql);
	$menus=array();
	while ($rw2 = mysqli_fetch_row($DB1->Consulta_ID)) {
		echo'<th >Precio Kg '.$rw2[1].' a '.$rw2[2].'</th>';
		// $FB->titulo_azul1("Precio Kg $rw2[1] a $rw2[2]",1,0,0); 
		array_push($menus,$rw2[0]);
	}
	echo'<th >Tipo servicio</th>';
echo' </tr>';
	
	// $FB->titulo_azul1("Tipo Servicio",1,0,0); 
	// $FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
	
	echo$sql="SELECT `idprecios`, `pre_idciudadori`, `pre_idciudaddes`, `pre_kilo`, `pre_adicional`,`pre_tiposervicio` FROM `precios`  where idprecios>0  $conde1 order by pre_idciudadori asc";
	$DB1->Execute($sql); $va=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$preciosconfi=array();
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		
		$sql1="SELECT  `ciu_nombre`,idciudades FROM `ciudades` WHERE idciudades in ($rw1[1],$rw1[2]) ";
		$DB->Execute($sql1); 
		while($rw=mysqli_fetch_row($DB->Consulta_ID))
		{
			
			if($rw[1]==$rw1[1]){
				$valor[1]=$rw[0];
			}else {
				$valor[2]=$rw[0];
			}
		}
		if($rw1[1]==$rw1[2]){ $valor[2]=$valor[1];  }
		echo "<tr class='text' bgcolor='$color'>";
		echo "<td>".$valor[1]."</td>
		<td>".$valor[2]."</td>";
		echo "<td>".$rw1[3]."</td>";
	
				 $sql2 = "SELECT  `con_precios`,con_idprecios FROM `configuracionkilos` WHERE con_idprecioskilos='$id_p' and con_tipo='normal' order by idconfiguracionkilos asc";
				$DB->Execute($sql2);
				while($rw3=mysqli_fetch_row($DB->Consulta_ID))
				{
					$preciosconfi[$rw3[1]]=$rw3[0];
					
				}
				
				foreach ($menus as $value) {
	
					 $datosp =$preciosconfi[$value];
					if($datosp !=''){
						echo "<td>".$datosp."</td>";
					}
					else{
						echo "<td>0</td>";
					}
					
	
				}
	
	
			
	
			
	
			if($rw1[5]!=0 and $rw1[5]!=NULL){
				$sql33="Select `idtiposervicio`, `tip_nom` from tiposervicio WHERE `idtiposervicio`='$rw1[5]'"; 
				$DB->Execute($sql33);
				$rw7=mysqli_fetch_row($DB->Consulta_ID); 
				echo "<td>$rw7[1]</td>";
			}else {
				echo "<td>Carga via terrestre</td>";
			}
	
		// $DB->edites($id_p, "Precios", 1, $condecion);
		// echo "</tr>";
	}




}else{

	require("login_autentica.php"); 
    include("layout.php");
	
	$conde="";
	$conde="pre_idciudadori";
	$precioinicialkilos=$_SESSION['precioinicial'];


	if(isset($_REQUEST["param1"]) && isset($_REQUEST["param2"])){ if($param1!="" and $param2!=""){  $conde="pre_idciudadori"; $conde1="and (pre_idciudadori='$param1' and pre_idciudaddes='$param2') or  (pre_idciudaddes='$param1' and pre_idciudadori='$param2')"; }else {
	
		if(isset($_REQUEST["param1"])){ if($param1!=""){  $conde="pre_idciudadori"; $conde1="and pre_idciudadori='$param1' "; } } else {$param1=""; $conde1=""; }
		if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde="pre_idciudaddes"; $conde1.="and pre_idciudaddes='$param2' "; } } else {$param2="";  $conde1="";}
		} } 


	$FB->titulo_azul1("Configuraci&oacute;n de Precios",9,0,7);  
	$FB->abre_form("form1","","post");
	
	$FB->llena_texto("Ciudad 1:",1,2,$DB,"SELECT `idciudades`, `ciu_nombre` FROM `ciudades`  where inner_estados=1","cambio1(this.value, param2.value, \"precios.php\", 1);",$param1,1,0);
	$FB->llena_texto("Ciudad 2:",2,2,$DB,"SELECT `idciudades`, `ciu_nombre` FROM ciudades","cambio1(param1.value, this.value, \"precios.php\", 1);",$param2,4,0);

	
	$FB->cierra_form(); 
	
	if($rcrear==1) { $FB->nuevo("Precios", $condecion, ""); } 
	$htmlTable = '';
	$htmlTable .= '<table border="1">';

	// Cabeceras de la tabla
	$htmlTable .= '<tr>';
	$htmlTable .= '<th>Ciudad Origen</th>';
	$htmlTable .= '<th>Ciudad Destino</th>';
	$htmlTable .= '<th>Primeros ' . $precioinicialkilos . ' Kg</th>';


	$FB->titulo_azul1("Ciudad Origen",1,0,5); 
	$FB->titulo_azul1("Ciudad Destino",1,0,0); 
	$FB->titulo_azul1("Primeros $precioinicialkilos Kg ",1,0,0); 
	
	$sql = "SELECT `idprecioskilos`, `pre_inicial`, `prec_final` FROM `precioskilos` order by pre_inicial asc";
	$DB1->Execute($sql);
	$menus=array();
	while ($rw2 = mysqli_fetch_row($DB1->Consulta_ID)) {
	
		$htmlTable .= '<th>Precio Kg ' . $rw2[1] . ' a ' . $rw2[2] . ' Kg</th>';
		$FB->titulo_azul1("Precio Kg $rw2[1] a $rw2[2]",1,0,0); 
		array_push($menus,$rw2[0]);
	}
	
	$htmlTable .= '<th>Tipo Servicio</th></tr>';
	$FB->titulo_azul1("Tipo Servicio",1,0,0); 
	$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
	
	$sql="SELECT `idprecios`, `pre_idciudadori`, `pre_idciudaddes`, `pre_kilo`, `pre_adicional`,`pre_tiposervicio` FROM `precios`  where idprecios>0  $conde1 ORDER BY $conde, $ord $asc";
	$DB1->Execute($sql); $va=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$preciosconfi=array();
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		
		$sql1="SELECT  `ciu_nombre`,idciudades FROM `ciudades` WHERE idciudades in ($rw1[1],$rw1[2]) ";
		$DB->Execute($sql1); 
		while($rw=mysqli_fetch_row($DB->Consulta_ID))
		{
			
			if($rw[1]==$rw1[1]){
				$valor[1]=$rw[0];
			}else {
				$valor[2]=$rw[0];
			}
		}
		if($rw1[1]==$rw1[2]){ $valor[2]=$valor[1];  }
		$htmlTable .= "<tr>";

				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				$htmlTable .= "<td>".$valor[1]."</td>
				<td>".$valor[2]."</td>";

				echo "<td>".$valor[1]."</td>
				<td>".$valor[2]."</td>";
				$htmlTable .= "<td>".$rw1[3]."</td>";
				echo "<td>".$rw1[3]."</td>";
	
				 $sql2 = "SELECT  `con_precios`,con_idprecios FROM `configuracionkilos` WHERE con_idprecioskilos='$id_p' and con_tipo='normal' order by idconfiguracionkilos asc";
				$DB->Execute($sql2);
				while($rw3=mysqli_fetch_row($DB->Consulta_ID))
				{
					$preciosconfi[$rw3[1]]=$rw3[0];
					
				}
				
				foreach ($menus as $value) {
	
					 $datosp =$preciosconfi[$value];
					if($datosp !=''){
						$htmlTable .= "<td>".$datosp."</td>";
						echo "<td>".$datosp."</td>";
						
					}
					else{
						$htmlTable .= "<td>0</td>";
						echo "<td>0</td>";
					}
					
	
				}
	
	
			
	
			
	
			if($rw1[5]!=0 and $rw1[5]!=NULL){
				$sql33="Select `idtiposervicio`, `tip_nom` from tiposervicio WHERE `idtiposervicio`='$rw1[5]'"; 
				$DB->Execute($sql33);
				$rw7=mysqli_fetch_row($DB->Consulta_ID); 
				$htmlTable .= "<td>$rw7[1]</td>";
				echo "<td>$rw7[1]</td>";
			}else {
				$htmlTable .= "<td>Carga via terrestre</td></tr>";
				echo "<td>Carga via terrestre</td>";
			}
	
		$DB->edites($id_p, "Precios", 1, $condecion);
		echo "</tr>";

		
	}
	$htmlTable .= "</table>";
	
	// $datos;
	// echo $htmlTable;
	
	$_SESSION['htmlTable'] = $htmlTable;

	
	include("footer.php"); 
}






?>
 <div class="container">
        <form id="pdfForm" action="descargarprecios.php" method="POST" style="display: none;">
            <textarea name="htmlTable" style="display: none;"><?php echo htmlspecialchars($htmlTable); ?></textarea>
        </form>
        <button type="button" class="icon-button file-button" onclick="document.getElementById('pdfForm').submit();">
            <i class="fas fa-file"></i> Documento
        </button>
    </div>
    <script>

    






			// p2=document.getElementById('param2').value;	
			// p3=document.getElementById('param3').value;
        function openInNewTab() {
			var html=document.getElementById('html').value;
			console.log(html);
            // window.open('descargarprecios.php?html='+html+'', '_blank');


			// var div = document.getElementById(idusuario);
  

		datos = {"html":html};
			$.ajax({
					url: "descargarprecios.php",
					type: "POST",
					data: datos
				}).done(function(respuesta){
					
					// if (respuesta=="ok") {
					// 	alert("Valor descontado");
					// // }
					// // Cambia el contenido del div
					// div.innerHTML = "$"+respuesta;
					// if (checkbox.checked) {
					// 	boton.style.display = "inline-block"; // Muestra el botón si el checkbox está marcado
					// } else {
					// 	boton.style.display = "none"; // Oculta el botón si el checkbox no está marcado
					// }
				});
        }

		
    // Optional: Automatically submit the form
    // document.getElementById('formEnviar').submit();

    </script>
