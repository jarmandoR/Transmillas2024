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
<body onload=" ">

<?php
$Hora =date("H:i:s");
$fechaYHora=date("Y-m-d 00:00:00 ");
//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","buzon.php","post");
//$FB->nuevo("Planillas", "$id_ciudad", "nuevo_admin.php");
$FB->titulo_azul1("Buzon de Mensajes ",9,0,5);
if($rcrear==1) { $FB->nuevo("Buzon", $condecion, ""); }


 // $conde="and not_fecha like '$fechaactual%'";
 // $conde1="and not_fecha like '$fechaactual%'";
if($param5!=''){

	$fechahora=$param5." 23:59:59";
}
if($param1!=''){ $conde="and chat_fechaHoraEnvio >= '$param1'";  $fechaactual=$param1;  }else {
	$conde="and chat_fechaHoraEnvio >= '$fechaYHora'";
}
if($param5!=''){ $conde1="and chat_fechaHoraEnvio <= '$fechahora'"; $fechaactual1=$param5;  }
if($param6!=''){ $conde2="and chat_idEmisor = '$param6'"; }
if($param7!=''){ $conde3="and chat_idReceptor ='$param7'";  }
if($param8!='' and $param8!='0'){ $conde4="and chat_vistoFecha >'0000-00-00 00:00:00'";  }else {   $conde4=""; }

$FB->llena_texto("Buscar desde la fecha:", 1, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Buscar hasta la fecha:", 5, 10, $DB, "", "", "$fechaactual1", 4, 0);

$FB->llena_texto("De:",6,2,$DB,"(SELECT `idusuarios`,`usu_nombre` FROM usuarios where usu_estado='1' order by usu_nombre)", "", "$param6", 1, 0);
$FB->llena_texto("Para:",7,2,$DB,"(SELECT `idusuarios`,`usu_nombre` FROM usuarios where usu_estado='1' order by usu_nombre)", "", "$param7", 4, 0);
$FB->llena_texto("Visto:",8,82, $DB, $clienteP, "", "$param8", 1, 0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form();


$FB->titulo_azul1("Fecha",1,0,7);
$FB->titulo_azul1("De",1,0,0);
$FB->titulo_azul1("para Usuario",1,0,0);
$FB->titulo_azul1("Mensaje",1,0,0);
$FB->titulo_azul1("Imagen",1,0,0);
// $FB->titulo_azul1("Expira",1,0,0);
// $FB->titulo_azul1("Para Rol",1,0,0);

$FB->titulo_azul1("Visto",1,0,0);
$FB->titulo_azul1("Visto fecha",1,0,0);
// $FB->titulo_azul1("Del chat?",1,0,0);

if($nivel_acceso==1 or $nivel_acceso==5){
	$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
	}


	$query6 = "SELECT `chat_idMensaje`, `chat_fechaHoraEnvio`, `chat_idEmisor`, `chat_idReceptor`, 
	`chat_imagen`, `chat_mensaje`, `chat_idSala`, `chat_vistoFecha`,
	 `chat_idGeneralMensaje`, `chat_respuestaA` FROM `ChatTransmillas` WHERE
	   chat_idMensaje>1    $conde $conde1 $conde2 $conde3 $conde4  order by chat_fechaHoraEnvio desc ";

//   $sql="SELECT idnoticia 0,  not_fecha 1,  usu_nombre2, not_titulo3, not_descripcion4, not_expiracion5,not_idrol6,not_visto7,not_respuesta8,not_imagen9,not_imagenResp10,not_idDe11,not_fechaVisto12,not_deChat13 FROM noticia left join usuarios on idusuarios=not_idusuario where idnoticia>1 $conde $conde1 $conde2 $conde3 $conde4  ORDER BY 1 desc";

$DB->Execute($query6); $va=0;
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{

		$estado="";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}


		$sql6="SELECT `idusuarios`, `usu_nombre` FROM `usuarios` where  `idusuarios`='$rw1[2]' ";
				$DB1->Execute($sql6);
                $rw2=mysqli_fetch_row($DB1->Consulta_ID);;
		$sql7="SELECT `idusuarios`, `usu_nombre` FROM `usuarios` where  `idusuarios`='$rw1[3]' ";
				$DB1->Execute($sql6);
                $rw7=mysqli_fetch_row($DB1->Consulta_ID);;
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

	// 	$sql1="SELECT doc_ruta FROM documentos WHERE doc_idviene='$id_p' AND doc_tabla='buzon' and doc_version=1 ORDER BY doc_fecha DESC ";
	//         $DB1->Execute($sql1);
	// 		@$firma=$DB1->recogedato(0);
	// echo "<td align='center'><a href='$ruta' target='_blank'><img src='$ruta' width='50'></a></td><td align='center'><a href='$firma' target='_blank'><img src='$firma' width='50'></a></td>";

		echo "<td>".$rw1[1]."</td>

		<td>".$rw2[1]."</td>
		<td>".$rw7[1]."</td>
		<td>".$rw1[5]."</td>";

if ($rw1[4]=='no' or $rw1[4]== '') {
	echo "
		<td align='center'></td>


		";
    // Verificar fecha para imagen
    // {
    //     $fecha_inicio_mes = strtotime(date("01-m-Y 00:00:00", time()));
    //     $fecha_image_entrada = strtotime($rw1[1]);


}else{

		if($fecha_image_entrada >= $fecha_inicio_mes) {

			// if ($rw1[13]=='2') {
				$urlImagen = "https://transmillas.com/chatPruebas/images/mensajes/{$rw1[4]}";

				// }else{

				// 	$urlImagen = "imgMensajes/{$rw1[4]}";
				// }

        } else {
            $urlImagen = VISUALIZADOR_IMAGENES . '?tipo=mensajes&id=' . $rw1[0];
        }
    // }

	echo "
		<td align='center'><a href='{$urlImagen}' target='_blank'><img src='{$urlImagen}' width='50'></a></td>";
}


		 // $sql5="SELECT `idroles`, `rol_nombre` FROM `roles` where  `idroles`='$rw1[6]' ";
			// 	$DB1->Execute($sql5);
			// 	 $rolnombre=$DB1->recogedato(1);
			// 	if($rolnombre=='0' or $rolnombre==''){
			// 		$rolnombre='Todos';
			// 	}
					if($rw1[7]=='0000-00-00 00:00:00'){
					$visto='NO';
				 }else{

				 $visto= 'SI';;
				 }
		echo "





		";
if ($rw1[7]!='0000-00-00 00:00:00') {
                echo"  <td>✔️</td>";

                }else{

                	 echo"  <td>❌</td>";
                }
       echo "
		<td>".$rw1[7]."</td>";

		// if ($rw1[13]=='2') {
		// 	echo"  <td>Nuevo</td>";

		// 	}else{

		// 		 echo"  <td>Antiguo</td>";
		// 	}

		if($nivel_acceso==1 or $nivel_acceso==5){
			$DB->edites($id_p, "idnoticia", 1, $condecion);
			}

		echo "</tr>";

	}


include("footer.php");
?>