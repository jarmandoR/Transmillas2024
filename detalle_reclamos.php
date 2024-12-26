<style>
	#tableReclamos td{
		color: #000;
	}
</style>

<?php
	require("login_autentica.php");
	include("cabezote3.php");

	$asc="ASC";
	$conde=" ";
	$conde2=" ";
	$conde3=" ";
	$conde4=" ";
	$conde5=" ";
	$conde8=" ";

	if($param34!=''){
		$fechaactual=$param34;
	}

	if($param35==''){
		$param35=0;
	}

	if($param33!='0'){
		$conde=" and `rec_tipo`= '$param33' ";
	}

	if($param34!='0'){
		$conde1=" and `rec_estado`= '$param34' ";
	}

	if($param35!='0'){
		$conde6=" and `rec_guia`= '$param35' ";
	}

	if($param38!='0'){
		$conde8=" and `rec_tipoCliente`= '$param38' ";
	}


	$FB->titulo_azul1("Numero Reclamo",1,0,7);
	$FB->titulo_azul1("Fecha Ingreso",1,0,0);
	$FB->titulo_azul1("Fecha Envio",1,0,0);
	$FB->titulo_azul1("Tipo Reclamo",1,0,0);
	$FB->titulo_azul1("Estado",1,0,0);
	$FB->titulo_azul1("Nombre",1,0,0);
	$FB->titulo_azul1("Descripción de PQRS",1,0,0);
	$FB->titulo_azul1("Telefomo",1,0,0);
	$FB->titulo_azul1("Confirmar Reclamo",1,0,0);
	$FB->titulo_azul1("Correo",1,0,0);
	$FB->titulo_azul1("Ciudad",1,0,0);
	$FB->titulo_azul1("Direccion",1,0,0);
	$FB->titulo_azul1("Guia",1,0,0);
	$FB->titulo_azul1("Foto Guia",1,0,0);
	$FB->titulo_azul1("Valor Seguro",1,'5%',0);
	$FB->titulo_azul1("Generar Acuerdo",1,'5%',0);
	$FB->titulo_azul1("Fecha Acuerdo",1,'5%',0);
	$FB->titulo_azul1("Valor Acuerdo",1,'5%',0);
	$FB->titulo_azul1("Foto Acuerdo",1,'5%',0);
	$FB->titulo_azul1("Requerimientos",1,'5%',0);
	$FB->titulo_azul1("ver requerimiento",1,'5%',0);
	$FB->titulo_azul1("Ver respuesta",1,'5%',0);
	$FB->titulo_azul1("Agregar Pago",1,'5%',0);
	$FB->titulo_azul1("Foto Pago",1,'5%',0);
	$FB->titulo_azul1("Ciente Prob",1,'5%',0);

	if($nivel_acceso=='1'){
		$FB->titulo_azul1("Eliminar",2,'5%',0);
	}else{
		$FB->titulo_azul1("Eliminar",1,'5%',0);
	}

	$sql="SELECT COUNT(*) FROM `reclamos`  inner join servicios on rec_idservicio=idservicios WHERE  idreclamos>0 $conde  $conde1  $conde4 $conde6 $conde8";
	
	$DB->Execute($sql);
	$valor=$DB->recogedato(0);

	// echo "valorrrr----".$_GET['pag'];

	// if(isset($_REQUEST["CantidadMostrar"])){ $CantidadMostrar=$_REQUEST["CantidadMostrar"]; } else { $CantidadMostrar=50; }
	// $CantidadMostrar=5;
	$CantidadMostrar=$_REQUEST["CantidadMostrar"];

	$cantF=$CantidadMostrar*1;

	$compag =(int)($_REQUEST['pag']=='') ? 1 : $_REQUEST['pag'];
	$TotalRegistro  =ceil($valor/$CantidadMostrar);
	//

	// $conde3="";

	// if($param37!='0'){ $conde5=" and usu_tipocontrato='$param37'";  }
	// echo$sql1="SELECT `idreclamos`, `rec_numero`, `rec_fechaingreso`, `rec_fechaenvio`, `rec_tipo`,`rec_estado`,`rec_nombre`, `rec_telefono`, `rec_correo`,`rec_guia`,`rec_fechaacuerdo`,`rec_valoracuerdo`,`rec_descripcion`, `rec_acuerdo`, `rec_idservicio`, `rec_ciudadenvio`,  `rec_direccion`,`rec_tipoCliente` `rec_tipoCliente`FROM `reclamos`  WHERE  idreclamos>0 $conde  $conde1  $conde4 $conde6 $conde8  ORDER BY idreclamos  asc LIMIT ".(($compag-1)*$cantF)." , ".$cantF;
$sql1="SELECT `idreclamos`, `rec_numero`, `rec_fechaingreso`, `rec_fechaenvio`, `rec_tipo`,`rec_estado`,`rec_nombre`, `rec_telefono`, `rec_correo`,`rec_guia`,ser_valorseguro, `rec_fechaacuerdo`,`rec_valoracuerdo`,`rec_descripcion`, `rec_acuerdo`, `rec_idservicio`, `rec_ciudadenvio`,  `rec_direccion`,`fec_descricomf`,`rec_tipoCliente` `rec_tipoCliente`FROM `reclamos` inner join servicios on rec_idservicio=idservicios WHERE  idreclamos>0 $conde  $conde1  $conde4 $conde6 $conde8  ORDER BY idreclamos  asc LIMIT ".(($compag-1)*$cantF)." , ".$cantF;
	$DB1->Execute($sql1);

	$va=(($compag-1)*$cantF);

	// $va=0;
	// $totalasignadas=0;
		/* $rw2 = mysqli_fetch_row($DB1->Consulta_ID);
		echo '<pre>'; print_r($rw2); echo '</pre>'; */
		while($rw1 = mysqli_fetch_row($DB1->Consulta_ID)){
				$id_p=$rw1[0];
				$va++; $p=$va%2;

				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				$verguia="Ver Foto Guia";
				$veracuerdo="Ver Foto Acuerdo";
				$verpago="Ver Foto Pago";
				//if($rw1[2]=='Validado' or $rw1[2]=='Validado Covid19'){}else{ $color="#ff5f42"; }
				$fecha=$rw1[2];
				$fechabd= date("Y-m-d H:i:s",strtotime($fecha."+ 48 hour"));
				$fechaultima= strtotime($fechabd);
				$fechaactual=strtotime("now");


				/* if($rw1[5]=='Confirmar' and $fechaultima<=$fechaactual){
					$color="#C72907";
				}
				else if($rw1[5]=='Confirmar'){
					$color="#2FB80D";
				}
				if($rw1[19]=='si'){
					$color="#F1C40F";
				} */

				if($rw1[5] == 'Confirmar' and $fechaultima<=$fechaactual){
					$color = "#C72907";
				}else if($rw1[5]=='Confirmar'){
					$color="#2FB80D";
				}else if($rw1[5] == 'Abierto'){
					$color = "#E5E748";
				}else if($rw1[5] == 'Conciliacion'){
					$color = "#D6D6D6";
				}else if($rw1[5] == 'Cerrado'){
					$color = "#fff";
				}

				echo "<tr id='tableReclamos' class='text' bgcolor='$color' onmouseover='this.style.background=\"#C8C6F9\"' onmouseout='this.style.background=\"$color\"'>";

				echo "<td>".$rw1[1]."</td>";
				echo "<td>".$rw1[2]."</td>";
				echo "<td>".$rw1[3]."</td>";
				echo "<td>".$rw1[4]."</td>";
				echo "<td>".$rw1[5]."</td>";
				echo "<td>".$rw1[6]."</td>";
				echo "<td><a  onclick='pop_dis16($id_p, \"Reclamo_Descripcion\",\"$rw1[15]\")';  style='cursor: pointer;' title='Descripcion' >Ver</td>";
				echo "<td>".$rw1[7]."</td>";
				if($rw1[5]=='Confirmar'){

					echo "<td align='center' >";
					echo "	<a  onclick='pop_dis16($id_p, \"LlamarReclamos\",\"$rw1[15]\")';  style='cursor: pointer;' title='Confirmar Reclamo' ><img src='img/validar.png'></a></td>";

				}else{

					echo "<td align='center' >";
					echo "	<a  onclick='pop_dis16($id_p, \"LlamarReclamos\",\"$rw1[15]\")';  style='cursor: pointer;' title='Confirmar Reclamo' >Confirmado</td>";

				}

				echo "<td>".$rw1[8]."</td>";
				echo "<td>".$rw1[16]."</td>";
				echo "<td>".$rw1[17]."</td>";

				echo "<td align='center' ><a  onclick='pop_dis5($rw1[15],\"Recogidas\")';  style='cursor: pointer;' title='Detalle Guia' >$rw1[9]</td>";
				echo $LT->llenadocs3($DB, "reclamos",$rw1[0], 1, 35, 'Ver Foto Guia');
				echo "<td>".$rw1[10]."</td>";
				echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16(\"$id_p\",\"acuerdo\",\"$rw1[15]\")';  title='Acordar Pago' > Acordar Pago</td>";
				echo "<td>".$rw1[11]."</td>";
				echo "<td>".$rw1[12]."</td>";
				echo $LT->llenadocs3($DB, "conciliacion", $id_p, 1, 35, 'Ver Foto Acuerdo');



				echo "<td colspan='1' width='0' align='center' ><a id='link' onclick='pop_dis16(\"$id_p\",\"derechopeticion\",\"$rw1[15]\")';   title='Derecos de peticion' >Requerimientos</td>";///////////

				echo $LT->llenadocs3($DB, "documentor", $id_p, 1, 35, 'Ver requerimiento');
				echo $LT->llenadocs3($DB, "requerimiento", $id_p, 1, 35, 'Ver respuesta');


				echo "<td colspan='1' width='0' align='center' ><a id='link' onclick='pop_dis16(\"$id_p\",\"Pagoacuerdo\",\"$rw1[15]\")';   title='Pago Reclamo' > Pago Reclamo</td>";


				echo $LT->llenadocs3($DB, "cancelarpago", $rw1[0], 1, 35, 'Ver Foto Pago');

				// echo "<td><form action='#' method='post'>";
	$sql="SELECT `idreclamos`,`rec_tipoCliente` FROM `reclamos` where idreclamos=$id_param ";

	$DB->Execute($sql);
		$rw=mysqli_fetch_array($DB->Consulta_ID);
				echo "<td colspan='1' width='0' align='center' ><a id='link' onclick='pop_dis16(\"$id_p\",\"cliente/p\",\"$rw1[15]\")';   title='Pago Reclamo' >si/no</td>";

	// echo "<div class='form-group form-check'>" ;
	//     echo " <input type='checkbox' class='form-check-input' id='conditions' name='conditions' value='1'>";
	//      echo"<label class='form-check-label' for='conditions'></label>";
	//  echo "</div>";
	//  echo"<input type='submit' class='btn btn-primary' name='sendForm' value='Enviar'/></form></td>";



				// echo "<td><div id='campo$va'>";
				// echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:#074f91;color:#f9f9f9;font-size:15px'  name='$va' id='$va'   class='borrar' required>";
				// $LT->llenaselect_ar("Selecccione...",$estados);
				// echo "</select></div><input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'></td>";

				if($nivel_acceso=='1'){
					$DB->edites($rw1[0], "reclamos", 1,"delete");
				}else{
					$DB->edites($rw1[0], "reclamos", 3,"delete");
				}

		}



		$FB->titulo_azul1(" Totales :",1,0,10);
		$FB->titulo_azul1(" $va",1,0,0);

		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);
		$FB->titulo_azul1(" ------",1,0,0);

		/* $FB->titulo_azul1("$ $totalalcobro",1,0,0);
		$FB->titulo_azul1("$ $totalprestamos",1,0,0);  */
	//Operacion matematica para boton siguiente y atras
		$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
		$DecrementNum =(($compag -1))<1?1:($compag -1);
	// onchange=location.href='http://www.dominio/pagina.php?ref='+this.value
	$selec200="";
	$selec50="";
	$selec100="";
	$selec10000="";
	if($CantidadMostrar==50){ $selec50="Selected";} else if($CantidadMostrar==100){ $selec100="Selected";} else if($CantidadMostrar==200){ $selec100="Selected";} else if($CantidadMostrar==10000){ $selec10000="Selected";}
		echo "<section class='paginacion'><ul ><li>Mostrar <select onchange=location.href=\"?CantidadMostrar=\"+this.value ><option value='50' $selec50 >50</option><option value='100' $selec100>100</option><option value='200' $selec200>200</option><option value='10000' $selec10000>Todos..</option></select></li><li><a>Total Registros: $valor </a></li><li ><a href=\"?pag=".$DecrementNum."&param34=".$param34."&param33=".$param33."&param38=".$param38."\" >&#171;&#171;</a></li>";
		//Se resta y suma con el numero de pag actual con el cantidad de
		//numeros  a mostrar
		$Desde=$compag-(ceil($cantF/2)-1);
		$Hasta=$compag+(ceil($cantF/2)-1);
		//Se valida
		$Desde=($Desde<1)?1: $Desde;
		$Hasta=(($Hasta<$cantF)?$cantF:$Hasta)/10;
		//Se muestra los numeros de paginas
		for($i=$Desde; $i<=$Hasta;$i++){
			//Se valida la paginacion total
			//de registros
			if($i<=$TotalRegistro){
				//Validamos la pag activo
			if($i==$compag){

			echo "<li><a href=\"?pag=".$i."&param34=".$param34."&param33=".$param33."&param38=".$param38."\" class=\"active\">".$i."</a></li>";

			}else {

				echo "<li><a href=\"?pag=".$i."&param34=".$param34."&param33=".$param33."&param38=".$param38."\">".$i."</a></li>";

			}

			}

		}

		echo "<li class=\"active\"><a href=\"?pag=".$IncrimentNum."&param34=".$param34."&param33=".$param33."&param38=".$param38."\">&#187;&#187;</a></li></ul>";

	include("footer.php");
?>