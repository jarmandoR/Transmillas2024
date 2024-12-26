<?php
/* Esta clase se encarga de realizar ciertas funciones que tienen que ver con la manipulación de fechas, funciones de presentación y otro tipo de procedimientos auxiliares */
class funciones_varias 
{
	function funciones_varias(){} // Constructor vacio
	/* Llena el título de los encabezados de la tabla, permite ingresar campo por el cual se quiere que se ordene y el orden ascendente o descendente */
	function relleno1($numr, $anc)
	{
		echo "<tr>";
		for($js=0; $js<$numr; $js++){ echo "<td><img src='img/spacer.gif' width='$anc' height='1'></td>"; }
		echo "</tr>";
	}
	function paginaheader($label1, $tabla, $rcrear, $label2)
	{
?>		<section class="content-header">
		<h1><?php echo $label1; ?><small>SIDE</small></h1>
		</section>
        <section class="content">
			<div class="row">
				<div class="col-xs-12">
                	<div class="box">
                    	<div class="box-header">
                        	<h3 class="box-title"><?php echo $label2; ?></h3>
<center><?php if(isset($_REQUEST["bandera"])){ $this->mensaje_bandera($_REQUEST["bandera"]); } ?></center>
                            	<div class="box-tools">
                                	<div class="input-group">
                                    	<div class="input-group-btn">
<?php	
if($rcrear==1) { $this->nuevo($tabla, 0); }
?>
                                        </div>
                                    </div>
                                </div>
                         </div>
<?php	
	}
	function cierraheader()
	{
		echo "</div></div></div></section>";
	}
	
	function titulo_azul4($nombre)
	{
 ?>		<section class="content">
  		<div class="row"><div class="col-xs-12"><div class="box"><div class="box-header"><h3 class="box-title"><?php echo $nombre; ?></h3></div>
<?php	
    }

	function titulo_azul5($nombre, $col, $wid, $abce, $ord, $asc)
	{
		if($abce==4){ echo "<table class='table table-hover'>";
		if(isset($_REQUEST["bandera"])){$this->mensaje_bandera($_REQUEST["bandera"]);} echo"<tr>";}
		if($abce==5){ echo "<table class='table table-hover'>";
		if(isset($_REQUEST["bandera"])){$this->mensaje_bandera($_REQUEST["bandera"]);} echo"<tr>";}
		if($abce==6){ echo "<table class='table table-hover'>";
		if(isset($_REQUEST["bandera"])){$this->mensaje_bandera($_REQUEST["bandera"]);} echo"<tr>";}
		if($abce==7){ echo "<table class='table table-hover'><tr>";}
		else if($abce==1 or $abce==3){echo "<tr>";}
		else {}
		echo "<td colspan='$col' width='$wid' align='center'><a href='#' onclick='llena_datos2(\"$ord\", \"$asc\");'>$nombre</a></td>";
		if($abce==2 or $abce==3 or $abce==4 or $abce==6 or $abce==7 ){echo "</tr>";}
	}

	function titulo_azul($nombre, $orden, $dre)
	{
		if($dre!=""){ echo "<a href='".$_SERVER['PHP_SELF']."?ord=$orden&dre=$dre'><span class='tittle3'>$nombre</span></a>"; } 
		else { echo "<span class='tittle3'>$nombre</span>";} 
	}

	function titulo_azulp($nombre, $orden, $dre, $param)
	{
		echo "<table width='100%' align='left' cellpadding=0 cellspacing=0 class='tittle3'>
		<tr><td background='img/centroa.png' width='100%' align='center'>";
		if($dre!=""){
		echo "<a href='".$_SERVER['PHP_SELF']."?ord=$orden&dre=$dre&param=$param'><span class='tittle2'>$nombre</span></a>";
		} else { echo "<span class='tittle2'>$nombre</span>";} 
		echo "</td></tr></table>";
	}
	/* Llena el título de los encabezados de la tablas */
	function titulo_azul22($nombre)
	{
		echo "<table width='100%' align='left' cellpadding=0 cellspacing=0 class='tittle3'>
              <tr>
                <td><img src='img/izqa.gif'></td>
                <td background='img/centroa.gif' width='100%' align='center'>
				<span class='tittle2'>$nombre</span></td>
                <td><img src='img/dera.gif'></td>
              </tr>
            </table>";
	}
	/* Llena el título de los encabezados de la página */
	function titulo_azul1($nombre, $col, $wid, $abce)
	{
		if($abce==4){ echo "<table class='table table-hover'>";
		if(isset($_REQUEST["bandera"])){$this->mensaje_bandera($_REQUEST["bandera"]);} echo"<tr>";}
		if($abce==5){ echo "<table class='table table-hover'>";
		if(isset($_REQUEST["bandera"])){$this->mensaje_bandera($_REQUEST["bandera"]);} echo"<tr>";}
		if($abce==6){ echo "<table class='table table-hover'>";
		if(isset($_REQUEST["bandera"])){$this->mensaje_bandera($_REQUEST["bandera"]);} echo"<tr>";}
		if($abce==7){ echo "<table class='table table-hover'><tr>";}
		if($abce==8){ echo "<table id='datatable' class='table table-striped table-bordered' style='width:100%' ><tr>";}
		else if($abce==1 or $abce==3){echo "<tr>";}
		else {}
		echo "<td colspan='$col' width='$wid' align='center'>$nombre</td>";
		if($abce==2 or $abce==3 or $abce==4 or $abce==6 or $abce==7 ){echo "</tr>";}
	}

	function titulo_azul3($nombre, $col, $wid, $abce, $param_edicion)
	{
		if($abce==4){ echo "<table class='table table-hover'><tr>"; }
		else if($abce==1 or $abce==3){echo "<tr>";}
		else {}
		if($param_edicion!=0){ echo "<td colspan='$col' width='$wid' align='center'>$nombre</td>"; }
		if($abce==2 or $abce==3 or $abce==4){echo "</tr>";}
	}

	function titulo_azul11($nombre)
	{
		echo "<table width='100%' cellpadding=2 cellspacing=2><tr><td background='imagenes/centroa.fw.png' align='right' class='tittle3'>
		<div align='right'>";
		echo "$".number_format($nombre,0,",",".")."</div></td></tr></table>";
	}

	/* Llena el título de los encabezados de la página de un ancho fijo */
	function titulo_azul2($nombre)
	{
		echo "<table align='left' cellpadding=1 cellspacing=1 class='tittle3' width='100%'>
              <tr><td rowspan='2'><img src='images/flecha.png'></td><td class='tittle3'>$nombre</td></tr>
              <tr><td><img src='images/linea3.png' width='100%'></tr>
            </table>";
	}

	function titulo_azul2a($nombre)
	{
		echo "<td class='tittle3'>$nombre</td>";
	}

	/* Llena las celdas individuales de los contenidos de las tablas interiores */
	function titulo_gris($nombre)
	{
		echo "<table width='100%' align='left' cellpadding=0 cellspacing=0>
              <tr>
                <td><img src='img/izq.gif'></td>
                <td background='img/centro.gif' width='100%' align='center' class='text'>$nombre</td>
                <td><img src='img/der.gif'></td>
              </tr>
            </table>";
	}

	/* este método llena los titulos de una tabla con un formato determinado por el parámetro $tipo */
	function llena_titulo($letitul, $tipo)
	{
		echo "<table class='text' cellspacing=0 cellpadding=0 width='100%'>
		<tr><td><img src='img/izq.gif'></td>";
		if($tipo==1){echo "<td background='img/centro.gif' width='100%' align='center'>".$letitul."</td>"; }
		if($tipo==2){echo "<td background='img/centro.gif' width='100%' align='right'>$".number_format($letitul,0,".",".")."</td>"; }
		if($tipo==3){echo "<td background='img/centro.gif' width='100%' align='right'>".number_format($letitul,0,".",".")."</td>"; }
		if($tipo==4){echo "<td background='img/centro.gif' width='100%' align='left'>".$letitul."</td>"; }
		if($tipo==5){echo "<td background='img/centro.gif' width='100%' align='right'>".number_format($letitul,2,".",".")."%</td>"; }
		if($tipo==6){
			$letitul1=explode("-",$letitul);
			$letitul=$letitul1[2]."-".$letitul1[1]."-".$letitul1[0];
			echo "<td background='img/centro.gif' width='100%' align='right'>".$letitul."</td>"; }
		echo "<td><img src='img/der.gif'></td></tr></table>";
	}

	/* Metodo encargado de devolver la diferencia entre una fecha inicial y fecha final de acuerdo al rango especificado en el parámetro 
	$interval */

	function datediff($interval, $datefrom, $dateto, $using_timestamps = false) 
	{  
		if (!$using_timestamps) 
		{
			$datefrom = strtotime($datefrom, 0);
			$dateto = strtotime($dateto, 0);
		}
		$difference = $dateto - $datefrom; 
		switch($interval) 
		{       
		case 'yyyy': 
		     $years_difference = floor($difference / 31536000);
			 if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n",$datefrom), date("j",$datefrom), date("Y",$datefrom)+ 
			 $years_difference) > $dateto) {  $years_difference--; }      if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), 
			 date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {$years_difference++;} 
			 $datediff = $years_difference;      
		break;
		case "q": 
		     $quarters_difference = floor($difference / 8035200);      while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), 
			 date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {        $months_difference++;      } 
			 $quarters_difference--;      $datediff = $quarters_difference;      
		break;     
		case "m": 
		     $months_difference = floor($difference / 2678400);      while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), 
			 date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {        $months_difference++;      } 
			 $months_difference--;      $datediff = $months_difference;      
		break;     
		case 'y': 
		      $datediff = date("z", $dateto) - date("z", $datefrom);      
		break;     
		case "d": 
			$datediff = floor($difference / 86400);      
		break;     
		case "w": 
		     $days_difference = floor($difference / 86400);      
			 $weeks_difference = floor($days_difference / 7); 
			 $first_day = date("w", $datefrom);      
			 $days_remainder = floor($days_difference % 7);      
			 $odd_days = $first_day + $days_remainder; 
			 if ($odd_days > 7) 
			 { 
			    $days_remainder--;     
			 }      
			 if ($odd_days > 6) { 
			     $days_remainder--; 
		     }      
			 $datediff = ($weeks_difference * 5) + $days_remainder;      
			 break;     
			 case "ww": 
			       $datediff = floor($difference / 604800);      
			  break;     
			  case "h": 
			       $datediff = floor($difference / 3600);
		      break;     
			  case "n": 
			        $datediff = floor($difference / 60);      
			  break;     
			  default: // Number of full seconds (default)       
			  $datediff = $difference;     
			  break;  
			}       
			return $datediff; 
	  } 
	  
	/* Método encargado de llenar una fecha a partir del rango establecido en dias por el parámetro $difi */
	function aumenta_feca($fecha, $dif1)
	{	
		$arf=explode("-",$fecha);
		$utime=mktime("00","00","00",$arf[1],$arf[2],$arf[0]);
		for ($i=0; $i<$dif1; $i++)
		{
			$utime1=$utime+($i*86400);
			$fec2=date("Y-m-d", $utime1);
		}
		return $fec2;			
	}

	function desciende_feca($fecha, $dif1)
	{	
		$arf=explode("-",$fecha);
		$utime=mktime("00","00","00",$arf[1],$arf[2],$arf[0]);
		for ($i=0; $i<$dif1; $i++)
		{
			$utime1=$utime-($i*86400);
			if($fec2=="2012-11-04"){$utime1=$utime1+86400;}
			$fec2=date("Y-m-d", $utime1);
		}
		return $fec2;			
	}

	function get_documento($id_param, $tabla, $version, $DB)
	{
		$sql="SELECT doc_ruta FROM documentos WHERE doc_idviene='$id_param' AND doc_tabla='$tabla' AND doc_version=$version ORDER BY doc_fecha DESC";
		$DB->Execute($sql);
		$descarga=$DB->recogedato(0);
		$imag=$DB->selimagen($descarga);
		return $descarga="<a href='$descarga' target='_blank'><img src='$imag' width='20'></a>";
	}
	
	function get_documentocaptura($valor, $DB){ 
		if($valor!=""){ return $val="<br>Descargar: <a href='$valor' target='_blank'><img src='".$DB->selimagen($valor)."' border=0></a>"; }
	}
	
	function get_imagen($id_param, $tabla, $version, $DB, $width)
	{
		$sql="SELECT doc_ruta FROM documentos WHERE doc_idviene='$id_param' AND doc_tabla='$tabla' AND doc_version=$version";
		$DB->Execute($sql);
		$imag=$DB->recogedato(0);
		if($width==""){$width=100;}
		if($imag!=""){ $imag="<a href='$imag' target='_blank'><img src='$imag' width='$width'></a>";}	else {$imag="";}
		return $imag;
	}

	/* Devuelve una fecha incrementada los días establecidos en el parámetro $difi */
	function incremento_feca($fec1,$dif1)
	{
		$arf=explode("-",$fec1);
		$utime=mktime("00","00","00",$arf[1],$arf[2],$arf[0]);
		$utime1=$utime+($dif1*86400);
		$fec1=date("Y-m-d", $utime1);
		return $fec1;
	}

	/* Metodo devuelve el nombre de un día de acuerdo a su nombre en inglés */
	function nombre_dia($dia)
	{
		$arr["Mon"]="Lunes";
		$arr["Tue"]="Martes";
		$arr["Wed"]="Miercoles";
		$arr["Thu"]="Jueves";
		$arr["Fri"]="Viernes";
		$arr["Sat"]="Sabado";
		$arr["Sun"]="Domingo";
		$dia=$arr[$dia];
		return $dia;
	}
	/* Devuelve el orden de una consulta*/
	function orden()
	{
		if(!isset($dre)){$dre="ASC";}
		if($dre=="ASC"){$dre="DESC";}
		else{$dre="ASC";}
		return $dre;
	}
	
	/* Devuelve el mensaje de error de acuerdo a lo especificado en el parámetro $bandera */
	function mensaje_bandera($bandera)
	{
		echo "<tr><td class='rojito' align='center' colspan='20'>";
		if ($bandera==1)
	  	{
	  		echo "El registro se agreg&oacute; correctamente";
	  	}
	  	elseif ($bandera==4) {	 
	   		echo "No es posible agregar al agregar el registro";
		}
	  	elseif ($bandera==2) {	 
	   		echo "El registro se elimin&oacute; correctamente";
		}
	  	elseif ($bandera==3) {	 
	   		echo "No es posible al eliminar el registro";
		}
	  	elseif ($bandera==5) {	 
	   		echo "El registro se actualiz&oacute; correctamente";
		}
	  	elseif ($bandera==6) {	 
	   		echo "No es posible actualizar el registro";
		}
	  	elseif ($bandera==12) {	 
	   		echo "El archivo de datos ha sido cargado correctamente a la base de datos";
		}
	  	elseif ($bandera==13) {	 
	   		echo "Los registros fueron eliminados correctamente de la base de datos";
		}
	 	else {	}
		echo "</td></tr>";
	}
	
	/* Crea un archivo log TXT e inserta una linea en el mismo */
	function logtext($texto)
	{
		//include("eventlog.txt");
		$fecha=date("Y-m-d H:i:s");
		$linea=$texto."\n\n\n";
		$f1=fopen("eventlog.txt","a+");
		fputs($f1,$linea);
		fclose($f1); 
	}

	function encripty($text)
	{
		$key_value="trkpryo";
		$encrypted_text = mcrypt_ecb(MCRYPT_DES, $key_value, $text, MCRYPT_ENCRYPT); 
		return $encrypted_text;
	}
	
	function decripty($text)
	{
		$key_value="trkpryo";
		$decrypted_text = mcrypt_ecb(MCRYPT_DES, $key_value, $text, MCRYPT_DECRYPT); 
		return $decrypted_text;
	}

	function nuevo($tabla, $condecion, $volver)
	{
		if($volver!=""){
			echo "<div class='pull-left btn btn-default'><a href='$volver'><div style='color:#000'>Volver </div></a></div>";
		}
		if($tabla!=""){
			echo "<div class='pull-right btn btn-default'><a href='nuevo_admin.php?tabla=$tabla&condecion=$condecion'>
			<div style='color:#000'>Agregar <i class='fa fa-plus'></i></div></a></div>";
		}
	}
	
	function nuevo1($tabla, $condecion)
	{
		echo "<div class='pull-right btn btn-default'><a href='#' onclick='cambio_ajax2(1,30,\"llena_preguntas\",\"param3\",\"$condecion\", \"1\");'>
		<div style='color:#000'>Agregar <i class='fa fa-plus'></i></div></a></div>";
	}

	function nuevo2($tabla, $condecion, $destino)
	{
		echo "<div class='pull-right btn btn-default' style='text-align:left'><a href='$destino?orden=$tabla&condecion=$condecion'>
		<div style='color:#000'>Agregar <i class='fa fa-plus'></i></div></a></div>";
	}

	function nuevo3($tabla, $condecion, $destino, $destino2)
	{
		echo "<div class='pull-right btn btn-default' style='text-align:left'><a href='$destino?orden=$tabla&condecion=$condecion'>
		<div style='color:#000'>Agregar <i class='fa fa-plus'></i></div></a></div>
		<div class='pull-left btn btn-default' style='text-align:left'>";
		//return confirm(\"Est&aacute; seguro de eliminar este registro?\"); alert(\" sadasd\")
		echo "<a onclick='location.href=\"$destino2?orden=$tabla&condecion=$condecion\"' href='#'>
		<div style='color:#000'>Vaciar <i class='fa fa-trash-o'></i></div></a></div> ";
	}

	function nuevo4($tabla, $id_proyecto, $div, $val)
	{
		echo "<div class='pull-right btn btn-default'><a href='#' onclick='cambio_ajax2(1,\"$val\",\"$div\",\"$id_proyecto\",1, \"$tabla\");' >
		<div style='color:#000'>Agregar <i class='fa fa-plus'></i></div></a></div>";
	}
	
	function volver1($volver, $nombre, $col, $volver1, $letitul2)
	{
		echo "<table class='table table-hover' class='text'><tr><td colspan='$col'><table width='100%'><tr>";
		if($volver!=""){
			echo "<td><div class='pull-left btn btn-default'><a href='$volver'><div style='color:#000'>Volver </div></a></div></td>";
		}
		echo "<td align='center' width='95%'>$nombre</td>";
		if($volver1!=""){
			echo "<td><a class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' href='$volver1'>$letitul2</a></td>";
		}
		echo "</tr></table></td></tr>";
	}
		
	function volver($arriba, $atras, $label, $siguente, $por, $color)
	{
		echo "<section class='content'><div class='row'>
		<div class='col-lg-2 col-xs-6'>
		<div class='small-box bg-yellow'>
		<div class='inner' onClick=\"escondertodo('divi'); showdiv('$arriba');\"><p><i class='fa fa-reply'></i>  Anterior</p><br></div>
		<span class='small-box-footer'></span></div></div><!-- ./col -->";

		if($atras!=""){
			echo "<div class='col-lg-2 col-xs-6'>
			<div class='small-box bg-yellow'>
			<div class='inner' onClick=\"escondertodo('divi'); showdiv('$atras');\"><p>Atras</p><br></div>
			<span class='small-box-footer'></span></div></div><!-- ./col -->";
		}
		echo "<div class='col-lg-6 col-xs-6'><div class='small-box bg-gray'><div class='inner' style='background-color:$color'><p>$label</p>";
		if($por!=""){ echo "<p>".number_format($por,0,".",".")."% de la informaci&oacute;n</p>"; } else { echo "<p>&nbsp;</p>"; } 
		echo "</div><span href='#' class='small-box-footer'></span></div></div><!-- ./col -->";
		
		if($siguente!=""){
			echo "<div class='col-lg-2 col-xs-6'>
			<div class='small-box bg-yellow'><div class='inner' onClick=\"escondertodo('divi'); showdiv('$siguente');\"><p>Siguiente</p><br></div>
			<span class='small-box-footer'></span></div></div></div>";
		}
		echo "</section>";
	}
	
	function row($va)
	{
		$p=$va%2;
		if($p==0){$color="#FFFFFF";}
		else{$color="#EFEFEF";}
		echo "<tr bgcolor='$color' class='text' style='background-color:$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' 
		onmouseout='this.style.backgroundColor=\"$color\"'>";

	}
	function edita($tabla, $condecion, $id_param)
	{
		echo "<tr><td colspan='13' class='tittle2'><table width='100%' border='0' cellspacing='0'><tr><td width='2%'><img src='imagenes/nuevo.png'></td>
		<td width='94%' class='tittle2'>&nbsp;&nbsp;
		<a href='#' onclick='llena_trabajo(\"1\", \"area_trabajo\", \"0\", \"cambio_admin.php?tabla=$tabla&condecion=$condecion&id_param=$id_param&\")'>
		<span class='a1'>&nbsp;Editar $tabla</span></a></td></tr></table></td></tr>";
	}
	
	function abre_form($nombre,$destino,$metodo)
	{
		echo "<form action='$destino' method='$metodo' enctype='multipart/form-data' name='$nombre' id='$nombre' >";	
	}
	function cierra_form()
	{
		echo "</form>";	
	}
	function cierra_tabla()
	{
		echo "</table>";	
	}
	function div_valores($div, $col)
	{
		echo "<tr><td colspan='$col'><div id='$div'></div></td></tr>";
	}
	
	function llena_texto1($label, $num, $tipo, $DB, $sql, $cond, $valor, $tab)
	{
		$LT = new llenatablas;
		$p=$num%2;
		if($p==1){$color="#FFFFFF";}
		else{$color="#EFEFEF";}
		if($tab==2){ echo "<tr bgcolor='$color'><td class='Intabla'><b>$label </b></td><td class='Intabla'>"; }
		else if($tab==3){ echo "<td class='Intabla'><b>$label </b></td><td>"; }
		else if($tab==1){ echo "<tr bgcolor='$color' class='Intabla'><td><b>$label </b></td><td class='Intabla'>"; }
		else if($tab==4){ echo "<td class='Intabla'><b>$label </b></td><td>"; }
		else if($tab==5){ echo "<tr bgcolor='$color'><td align='right' colspan='$num' class='Intabla'>"; }
		switch($tipo)
		{
			case 16:
			echo "$valor";
			break;	
			default:
			echo "$valor";
			break;
		}
		if($tab==2){ echo "</td></tr>"; }
		else if($tab==3){ echo "</td>"; }
		else if($tab==1){ echo "</td>"; }
		else if($tab==4){ echo "</td></tr>"; }
		else if($tab==5){ echo "</td></tr>"; }
	}	

	function llena_texto2($label, $num, $tipo, $DB, $sql, $cond, $valor, $valor2, $tab, $req, $vsl)
	{
		if($req==1){ $req="required"; } else { $req=""; }
		$LT = new llenatablas;
		$p=$num%2;
		if($p==1){$color="#FFFFFF";}
		else{$color="#EFEFEF";}
		if($vsl==0){ $colos1="bgcolor='#B0C4DE'"; } else { $colos1="bgcolor='#FFA07A'"; }
		if($tab==2){ echo "<tr bgcolor='$color'><td class='Intabla'>$label</td><td align='right' class='Intabla' $colos1>"; }
		else if($tab==3){ echo "<td class='Intabla' width='$cond'>$label</td><td align='right' class='Intabla' $colos1 width='$cond'>"; }
		else if($tab==1){ echo "<tr bgcolor='$color' class='Intabla'><td>$label</td><td align='right' class='Intabla' $colos1>"; }
		else if($tab==4){ echo "<td class='Intabla'>$label</td><td align='right' class='Intabla' $colos1>"; }
		else if($tab==5){ echo "<tr bgcolor='$color'><td align='right' colspan='$num' class='Intabla' $colos1>"; }
		else if($tab==6){ echo "<td class='Intabla' $colos1 colspan='2' width='$cond'>$label"; }
		else {}
		switch($tipo)
		{
			case 1:
			echo "<input name='param$num-1' id='param$num-1' class='form-control' type='text' value='$valor' $req><br>";
			echo "<textarea name='param$num-2' id='param$num-2' class='form-control' style='width:250px; height:50px;'>$valor2</textarea>";
			break;	
			case 112:
			echo "<input name='param$num' id='param$num' class='form-control' $req type='number' value='$valor'><br>";
			echo "<textarea name='param$num-2' id='param$num-2' class='form-control' style='width:350px; height:70px;'>$valor2</textarea>";
			break;	
			case 9:
			echo "<textarea name='param$num-1' id='param$num-1' class='form-control' style='width:300px; height:50px;' $req>$valor</textarea>";
			echo "<input name='param$num-2' id='param$num-2' type='hidden' value='$valor2'>";
			break;	
			case 16:
			echo "$valor<br>$valor2";
			break;	
			case 24:
			echo "<select name='param$num-1' id='param$num-1' onChange='$cond' class='form-control' $req >";
			echo "<option  value=''>Seleccione...</option>";
			$LT->llenaselect_ar($valor, $sql);
			echo "</select><br>";
			echo "<textarea name='param$num-2' id='param$num-2' class='form-control' style='width:350px; height:70px;' $req>$valor2</textarea>";
			break;	
		}
		if($tab==2){ echo "</td></tr>"; }
		else if($tab==3){ echo "</td>"; }
		else if($tab==1){ echo "</td>"; }
		else if($tab==4){ echo "</td></tr>"; }
		else if($tab==5){ echo "</td></tr>"; }
		else if($tab==6){ echo "</td>"; }
		else {}
	}	
	
	function llena_ajaxs($LT, $sql, $mo, $va, $DB, $div, $param1, $param2, $num, $si, $val)
	{
		echo "<select name='$param1' id='$param1' class='form-control' required ";
		if($si==1){ echo "onchange='cambio_ajax2(this.value, $num, \"$div\", \"$param2\", 2, 0);' "; }
		echo ">";
		$LT->llenaselect($sql,$va,$mo, $val, $DB);
		echo "</select></td><td><div id='llega_sub4'></div></td>";
	}
	
	function llena_texto($label, $num, $tipo, $DB, $sql, $cond, $valor, $tab, $req)
	{
		if(substr($num,0,3)=="Enc"){ $no=explode("-",$num); $nombrecampo=$no[1]; } else { $nombrecampo="param$num"; } 
		$cnd=explode("xxyyzz",$label);
		if(isset($cnd[1])){ $justi=$cnd[1];} else {$justi="";} $label=$cnd[0];
		$justcam="just$num"; $justif="";
		if($req==1){ $req="required"; } else { $req=""; }
		$LT = new llenatablas;
		$p=$num%2;
		if($p==1){$color="#FFFFFF";}
		else{$color="#F3F3F3";}
		if($tipo!=13){
			if($tab==2){ echo "<tr bgcolor='$color'><td class='text'>$label</td><td align='right' class='text'>"; }
			else if($tab==3){ echo "<td class='text'>$label</td><td align='right'>"; }
			else if($tab==1){ echo "<tr bgcolor='$color' class='text'><td>$label</td><td align='right' class='text'>"; }
			else if($tab==4){ echo "<td class='text'>$label</td><td align='right'>"; }
			else if($tab==5){ echo "<tr bgcolor='$color'><td align='right' colspan='$num'>"; }
			else if($tab==6){ echo "<td width='$req'>$label"; }
			else if($tab==7){ echo "<tr bgcolor='$color' class='text'><td width='50%'><b>$label</b><br>"; }
			else if($tab==8){ echo "<td class='text'><b>$label</b><br>"; }
			else if($tab==9){ echo "<tr class='text'><td width='50%'><b>$label</b><br>";
			$volor=explode("!!!",$valor);
			if(isset($volor[1])){ $valor=$volor[0]; $justif=$volor[1]; }}
			else if($tab==10){ echo "<tr align='center' bgcolor='#074F91' class='tittle3'><td colspan=2><b>$label</b>"; }
			else if($tab==11){ echo "<tr><td class='text'>$label</td><td colspan=3>"; }
			else if($tab==12){ echo "<tr><td class='text' colspan=4>"; }
			else if($tab==13){ echo "<tr align='center' bgcolor='#074F91' class='tittle3'><td colspan=4><b>$label</b>"; }
			else {}
		}
		switch($tipo)
		{
			case 1:
			echo "<input name='$nombrecampo' id='$nombrecampo' class='form-control' $sql  $req type='text' value='$valor' onkeypress='return noenter();'>";
			break;	
			case 111:
			echo "<input name='$nombrecampo' id='$nombrecampo' class='form-control' $req type='email' value='$valor'>";
			break;	
			case 112:
			if($sql!=""){ $codo="max='$sql'"; } else { $codo=""; } 
			echo "<input name='$nombrecampo' id='$nombrecampo' class='form-control' $req type='number' $codo min='0' value='$valor'>";
			break;	
			case 113:
?>	
<script language="javascript">
function validaexistencia(valor, div, tipo)
{
	destino="resultados1.php?param1="+valor+"&cond=20&tipo="+tipo;
	MostrarConsulta2(destino, div); 
}
</script>		
<?php		echo "<input name='$nombrecampo' id='$nombrecampo' class='form-control' $req type='number' value='$valor' onKeyUp='$sql'>
			<div id='$cond'></div>";
			break;	
			case 114:
			echo "<input name='$nombrecampo' id='$nombrecampo' class='form-control' $req type='number' max='100' min='0' value='$valor'>";
			break;	
			case 115:
			echo "<input name='$nombrecampo' id='$nombrecampo' class='form-control' $req type='text' placeholder='$label' onKeyPress='$cond' value='$valor'>";
			break;	
			case 2:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' type='number' $req>
			<option value=''>Seleccione...</option>";
			$LT->llenaselect($sql,0,1, $valor, $DB);
			echo "</select>";
			break;	
			case 221:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' type='number' $req>";
			$LT->llenaselect($sql,0,1, $valor, $DB);
			echo "</select>";
			break;
			case 222:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' type='number' $req>
			<option value=''>Seleccione...</option>";
			$LT->llenaselect_ajax($sql,0,1, $valor, $DB);
			echo "</select>";
			break;
			case 223:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' type='number' $req>
			<option value=''>Seleccione...</option>";
			$LT->llenaselect($sql,0,"1-2", $valor, $DB);
			echo "</select>";
			break;	
			case 26:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' $req>";
			$LT->llenaselect($sql,0,1, $valor, $DB);
			echo "</select>";
			break;	
			case 27:
			echo "<table width='50%'><tr><td><input type='button' value='Consultar' onClick='$valor' class='form-control'></td><td> 
			<input type='button' value='Exportar' onClick='$cond' class='form-control'></td></tr></table>";
			break;
			case 277:
			echo "<table width='50%'><tr><td><input type='button' value='Consultar' onClick='$valor' class='form-control'></td></tr></table>";
			break;
			case 3:
			echo "<input name='$nombrecampo' id='$nombrecampo' class='form-control' type='password' $req >";
			break;	
			case 4:
			echo "<div id='$sql'></div>";
			break;	
			case 5:
			if($valor==1){$cond1="checked";} else {$cond1="";} 
			echo "<input type='checkbox' name='$nombrecampo' id='$nombrecampo' value='1' style='width:15px;' $cond1 class='form-control' >";
			break;	
			case 6:
			echo "<input name='$nombrecampo' id='$nombrecampo' class='form-control' type='file' $req>";
			echo $this->get_documentocaptura($valor, $DB);
			break;	
			case 7:
			echo "<div id='$sql'>";
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' type='number' $req>
			<option value=''>Seleccione...</option>";
			$LT->llenaselect($sql,0,1, $valor, $DB);
			echo "</select></div>";
			break;	
			case 82:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' type='number' 
			style='line-height:10px;' $req>
			<option value=''>Seleccione...</option>";
			$LT->llenaselect_ar2($valor, $sql);
			echo "</select>";
			break;	
			
			case 82:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' type='number' 
			style='line-height:10px;' $req>
			<option value=''>Seleccione...</option>";
			$LT->llenaselect_ar2($valor, $sql);
			echo "</select>";
			break;	
			
			case 9:
			echo "<textarea name='$nombrecampo' id='$nombrecampo' class='form-control' type='text' style='min-width:400px;' $req>$valor</textarea>";
			break;	
			case 93:
			echo "<textarea name='$nombrecampo' id='$nombrecampo' class='form-control' type='text' style='min-width:400px;' $req>$valor</textarea>";
			break;	
			case 91: 
			echo "<textarea name='$nombrecampo' id='$nombrecampo' class='form-control' type='text' $req>$valor</textarea>";
			break;
			case 92: 
			echo "<textarea name='$nombrecampo' id='$nombrecampo' class='form-control' type='text' $req style='max-width:250px;'>$valor</textarea>";
			break;
			case 10: 
			echo "<input type='date' class='form-control' name='$nombrecampo' id='$nombrecampo' value='$valor' $req onChange='$cond' />";			
			break;
			case 100: 
			echo "<input type='date' class='form-control' name='$nombrecampo' id='$nombrecampo' value='$valor' $req onChange='$cond' />";			
			break;
			case 101: 
			if($valor!=""){ $val=explode("x",$valor); $valor1=$val[0]; $valor2=$val[1]; $valor3=$val[2]; } else { $valor1=""; $valor2=""; $valor3="";} 
			echo "<table width='100%' class='text'><tr><td><input type='date' class='form-control' name='$nombrecampo' id='$nombrecampo' value='$valor1' $req onChange='$cond'>			
			</td><td>Hora Inicio:</td><td>";
			echo "<select name='$nombrecampo-1' id='$nombrecampo' onChange='$cond' class='form-control' type='number' style='line-height:10px;'  $req>
			<option value=''>Seleccione...</option>";
			$LT->llenaselect_ar($valor2, $sql);
			echo "</select></td><td>Hora Fin:</td><td>";
			echo "<select name='$nombrecampo-2' id='$nombrecampo' onChange='$cond' class='form-control' type='number' style='line-height:10px;' $req>
			<option value=''>Seleccione...</option>";
			$LT->llenaselect_ar($valor3, $sql);
			echo "</select></td></tr></table>";
			break;
			case 11:
			echo "X Y: <input name='$nombrecampo' id='$nombrecampo' class='form-control' type='text' $req value='$valor'>";
			break;
			case 12:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' type='number' $req  >";
			if($mm==0){ echo "<option value=''>Seleccione...</option>"; }
			$LT->llenaselect_ajax($sql,0,1, $valor, $DB);
			echo "</select>";
			break;	
			case 13:
			echo "<input name='$label' id='$label' type='hidden' value='$valor'>";
			break;
			case 14:
			echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='2'>
			<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='submit' onClick='javascript:history.back();' 
			value='Volver' style='width:190px;'> 
			<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='submit' name='enviar' value='Agregar' style='width:190px;'>";
			break;
			case 141:
			echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='2'><table width='50%'>
			<tr><td align='right'><input type='button' name='button2' id='button2' value='Volver' class='form-control'
			onClick='location.href=\"resultados4.php?condecion=$sql&activo=$valor&\"'></td>
			<td>&nbsp;&nbsp;</td><td><input type='submit' name='button' id='submit' value='Agregar' class='form-control'></td></tr></table></td></tr>";
			break;
			case 142:
			if($sql==""){ $sql="Agregar"; }
			echo "<tr bgcolor='#F5F5F5'><td align='right' colspan='2'><input type='submit' name='button' id='submit' value='$sql' class='form-control'>
			</td></tr>";
			break;
			case 143:
			echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='2'><input type='button' name='button2' id='button2' value='Volver' 
			onClick='location.href=\"$sql\"' class='form-control'></td></tr>";
			break;
			case 144:
			if($sql==""){ $sql="Agregar"; }
			echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='2'>
			<input class='btn btn-default btn-sm' type='submit' onClick='javascript:history.back();' value='Volver' class='form-control'> 
			<input class='btn btn-default btn-sm' type='submit' name='enviar' value='$sql' class='form-control'>";
			break;
			case 145:
			if($sql==""){ $sql="Agregar"; }
			echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='4'><input type='submit' name='button' id='submit' value='$sql' class='form-control'></td></tr>";
			break;
			case 15:
			$cond=explode("%", $cond); if(isset($cond[1])){$cond1=$cond[1];} else {$cond1="";} 
			echo "<input name='$nombrecampo' id='$nombrecampo' class='form-control' value='$valor' onKeyUp='$sql'><div id='$cond1'></div>";
			break;	
			case 16:
			echo utf8_encode("$valor"); echo "<input name='$nombrecampo' id='$nombrecampo' value='' type='hidden'>";
			break;	
			case 161:
			if($valor!=""){ $val=explode("x",$valor); $valor1=$val[0]; $valor2=$val[1]; $valor3=$val[2]; } else { $valor1=""; $valor2=""; $valor3="";} 
			echo "<table width='100%' class='text'><tr><td align='right'>".utf8_encode("$valor1")."</td><td>Hora inicio: </td><td align='right'> $valor2</td><td>Hora fin: </td>
			<td align='right'> $valor3</td></tr></table>";  echo "<input name='$nombrecampo' id='$nombrecampo' value='' type='hidden'>";
			break;	
			case 162:
			$DB->Execute($sql);
			echo utf8_encode($DB->recogedato(0)); echo "<input name='$nombrecampo' id='$nombrecampo' value='' type='hidden'>";
			break;	
			case 17:
			echo "<input type='button' value='Consultar' onClick='$cond'>";
			break;
			case 18:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control'  type='number' $req ><option value=''>Seleccione...
			</option>";
			$LT->llenaselect_ar_ajax($valor, $sql);
			echo "</select>";
			break;	
			case 19:
			echo "&nbsp;";
			break;	
			case 20:
			echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='2'>
			<table width='30%' border='0' cellspacing='0' cellpadding='0'>
			<tr><td align='right'><input type='button' name='button2' id='button2' value='Volver' onClick='escondertodo(\"area_trabajo1\");'></td>
			<td>&nbsp;&nbsp;</td><td><input type='button' name='button' id='submit' value='Agregar' 
			onClick='llena_trabajo21(\"$sql\", \"area_trabajo1\", \"$cond\", \"$valor\", \"$DB\");'></td></tr></table></td></tr>";
			break;
			case 21:
			if($valor==1){$cond1="checked";} else {$cond1="";} 
			echo "<input type='radio' name='$nombrecampo' id='$nombrecampo' value='1'  $cond1 >";
			break;	
			case 22:
			echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='2'>
			<table width='30%' border='0' cellspacing='0' cellpadding='0'>
			<tr><td align='right'><input type='button' name='button2' id='button2' value='Volver' onClick='javascript:history.back();'></td>
			<td>&nbsp;&nbsp;</td><td><input type='submit' name='button' id='submit' value='Editar'></td></tr></table></td></tr>";
			break;
			case 23:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' ><option value=''>Seleccione...</option>";
			$LT->llenaselect($sql,0,"1-2", $valor, $DB);
			echo "</select>";
			break;	
			case 24:
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' >";
			$LT->llenaselect_ar($valor, $sql);
			echo "</select>";
			break;	
			case 25:
			echo "<input type='color' maxlength='6' size='6' name='$nombrecampo' id='colorpickerField1' value='$valor' class='form-control' />";		
			break;
        	default:
			break;
			case 28:
			require("connection/arrays.php");
			echo "<table width='20%' align='right' cellpadding='0' cellpadding='0'>
			<tr><td><select name='$nombrecampo-1' id='$nombrecampo-1' onChange='$cond' style='width:80px;' >";
			$LT->llenaselect_ar(date("Y"), $anisc);
			echo "</select></td><td><select name='$nombrecampo-2' id='$nombrecampo-2' onChange='$cond' style='width:80px;' >";
			$LT->llenaselect_ar(date("m"), $mesd1);
			echo "</select></td><td><select name='$nombrecampo-3' id='$nombrecampo-3' onChange='$cond' style='width:80px;' >";
			$LT->llenaselect_ar(date("d"), $dissa);
			echo "</select></td></tr></table>";
			break;	
			case 29:
			echo "<b>$valor</b>";
			break;	
			case 30:
			echo "Lat: <input type='text' name='$nombrecampo' id='$nombrecampo' style='width:100px;'> Lon: <input type='text' 
			name='r_$$nombrecampo' id='r_$$nombrecampo' style='width:100px;'>";
			break;
			case 31:
			$vale=explode(";",$valor);
			echo "<table class='table table-hover' width='100%'>";
			foreach ($sql as $val)  
			{	
				$cods=""; $val=trim($val);
				foreach($vale as $mur){ $mur=trim($mur);  if($mur==$val){ $cods="checked"; } } 
				echo "<tr><td class='Intabla'>".$val."</td><td align='right' width='20px'><input type='checkbox' name=\"proyectos[]\"
				id='proyectos$num' style='width:20px;' onclick='checkChoice(\"$nombrecampo\", \"proyectos$num\", \"\");' value=\"$val\" $cods></td></tr>";
			}
			echo "<input type='hidden' name='$nombrecampo' id='$nombrecampo' style='width:270px;' readonly  value='$valor'>";
			echo "</table>";
			break;
			case 33:
			$array="Si;No"; $sql1=explode(";",$array);
			$vale=explode(";",$valor);
			echo "<table class='table table-hover' width='100%'>";
			if($valor!=""){ $valor1="Si";} else { $valor1="No"; } 
			echo "<select name='$nombrecampo-1' id='$nombrecampo-1' onChange='$cond valsinoev(this.value, \"proyectos$num\");' 
			class='form-control' type='number' style='line-height:10px;' $req><option value=''>Seleccione...</option>";
			$LT->llenaselect_ar($valor1, $sql1);
			echo "</select><table class='table table-hover' width='100%'>";
			foreach ($sql as $val)  
			{
				$cods=""; $val=trim($val);
				foreach($vale as $mur){ $mur=trim($mur);  if($mur==$val){ $cods="checked"; } } 
				echo "<tr><td class='Intabla'>".$val."</td><td align='right' width='20px'><input type='checkbox' name=\"proyectos$num\" 
				id='proyectos$num' style='width:20px;' onclick='checkChoice(\"$nombrecampo\", \"proyectos$num\", \"\");' value=\"$val\" $cods></td></tr>";
			}
			echo "<input type='hidden' name='$nombrecampo' id='$nombrecampo' style='width:270px;' readonly ></table>";
			break;
			case 34:
			$num1=$num+1;
			$nombrecampo1="param$num1";
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' type='number' 
			style='line-height:10px;' $req>
			<option value=''>Seleccione...</option>";
			$LT->llenaselect_ar($valor, $sql);
			echo "</select>";
			break;
			case 35:
			echo "<input name='$nombrecampo' id='$nombrecampo' class='form-control' disabled='disabled' $req type='text' value='$valor'>";
			break;
			case 36:
			$vale=explode(";",$valor);
			echo "<table class='table table-hover' width='100%'>";
			$DB->Execute($sql); 
			while($rw=mysqli_fetch_row($DB->Consulta_ID))
			{
				$cods=""; $val=trim($rw[0]);
				foreach($vale as $mur){ $mur=trim($mur);  if($mur==$val){ $cods="checked"; } } 
				echo "<tr><td class='Intabla'>".$val."</td><td align='right' width='20px'><input type='checkbox' name=\"proyectos[]\" id='proyectos$num' style='width:20px;'
				onclick='checkChoice(\"$nombrecampo\", \"proyectos$num\", \"\");' value=\"$val\" $cods></td></tr>";
			}
			echo "<input type='hidden' name='$nombrecampo' id='$nombrecampo' style='width:270px;' readonly  value='$valor'>";
			echo "</table>";
			break;
			case 37:
			$arra=$this->devuelve_arr($sql, $DB);
			echo "<select name='$nombrecampo' id='$nombrecampo' onChange='$cond' class='form-control' type='number' style='line-height:10px;' $req>
			<option value=''>Seleccione...</option>";
			$LT->llenaselect_ar($valor, $arra);
			echo "</select>";
			break;	
			case 38:
			$vls=explode("xxyyzz",$cond);
			$cond=$vls[0];
			echo "<input type='text' id='$nombrecampo' class='form-control' placeholder='$label' 
			onkeyup='autocomplet(\"$sql\", \"$valor\", this.value, \"$nombrecampo\", \"$cond\");'><br><ul id='$valor' >";
			if(isset($vls[1])){ $sql=$sql+2;
				$DB->execute($vls[1]); 
				while($rw=mysqli_fetch_row($DB->Consulta_ID))
				{
					echo utf8_encode($rw[1])." - ".utf8_encode($rw[2])." &nbsp;&nbsp;<a href='#' title='Eliminar' 
					onClick='MostrarConsulta2(\"resultados1.php?cond=$sql&id_param=$cond&valor=$rw[0]&div=$valor\",	\"$valor\");'><i class='fa fa-trash-o'></i></a><br>";
				}
			}
			echo "</ul>";
			break;	
		}
		if($tipo!=13){
			if($tab==2){ echo "</td></tr>"; }
			else if($tab==3){ echo "</td>"; }
			else if($tab==1){ echo "</td>"; }
			else if($tab==4){ echo "</td></tr>"; }
			else if($tab==5){ echo "</td></tr>"; }
			else if($tab==6){ echo "</td>"; }
			else if($tab==7){ echo "</td>"; }
			else if($tab==8){ echo "</td></tr>"; }
			else if($tab==9){ 
				if($justi==""){ $justi="Justificaci&oacute;n";}
				echo "<td width='50%' bgcolor='#FFFFFF'>$justi<br>
				<textarea style='width:100%;' name='$justcam' id='$justcam' placeholder='$cond'>$justif</textarea></td></tr>"; 
			}
			else if($tab==10){ echo "</td></tr>"; }
			else if($tab==12){ echo "</td></tr>"; }
			else {}
		}
	}
	function pendiente_check($num, $req)
	{
/*		if($req=="required" and current_page_url()=="formulario.php" ){ 
			echo "<br>Pendiente: <input type='checkbox' name='check$num' id='check$num' value='1' 
			onclick='if(this.checked){ $nombrecampo.disabled=true; } else { $nombrecampo.disabled=false; } ' class='icheckbox_minimal' >";
		}
*/	}

	function devuelve_arr($sql, $DB){
		$sql="SELECT ind_array FROM indicadores WHERE ind_codigo='$sql' ";
		$DB->Execute($sql);  
		$sql=$DB->recogedato(0);
		return $sql=explode(";",$sql);
	}

	function devuelve_val($sql, $DB){
		$sql="SELECT ind_array FROM indicadores WHERE ind_codigo='$sql' ";
		$DB->Execute($sql);  
		return $sql=$DB->recogedato(0);
	}
	
	function detalle_proyecto ($DB1, $id_proyectos)
	{
		$sql="SELECT idproyectos, pro_codigo, pro_alias, pro_fechainicial, pro_fechafinal, pro_valor, pro_objeto, pro_descripcion, pro_estados, pro_alias, 
		pro_contrapartida, pro_objetivos, pro_beneficiarios FROM proyectos INNER JOIN programas ON programas_idprogramas=idprogramas AND 
		idproyectos='$id_proyectos' ";
		$DB1->Execute($sql); $va=0;
		$rw=mysqli_fetch_row($DB1->Consulta_ID);
		$vals="<table width=\"95%\">";
		$vals.="<tr bgcolor=\"#F75700\" align=\"center\" class=\"tittle3\"><td align=\"center\" colspan=\"2\">".utf8_encode($rw[2])."</td></tr>";
		$vals.="<tr class=\"text\" bgcolor=\"#EFEFEF\"><td width=\"53%\"><b>Centro de costo:</b></td><td align=\"right\" width=\"65%\">$rw[1]</td></tr>";
		$vals.="<tr class=\"text\"><td><b>Proyecto:</b></td><td>".utf8_encode($rw[2])."</td></tr>";
		$vals.="<tr class=\"text\" bgcolor=\"#EFEFEF\"><td><b>Fecha inicial:</b></td><td align=\"right\">$rw[3]</td></tr>";
		$vals.="<tr class=\"text\"><td><b>Fecha final:</b></td><td align=\"right\">$rw[4]</td></tr>";
		$vals.="<tr class=\"text\" bgcolor=\"#EFEFEF\"><td><b>Valor:</b></td><td align=\"right\">$".number_format($rw[5],0,".",".")."</td></tr>";
		$vals.="<tr class=\"text\"><td><b>Objeto:</b></td><td>".utf8_encode($rw[6])."</td></tr>";
		$vals.="<tr class=\"text\" bgcolor=\"#EFEFEF\"><td><b>Estado:</b></td><td>$rw[8]</td></tr>";
		$vals.="<tr class=\"text\"><td><b>Donante:</b></td><td>";
		
		$sql="SELECT don_alias FROM proydonantes INNER JOIN donantes ON donantes_iddonantes=iddonantes AND proyectos_idproyectos='$id_proyectos' ";
		$DB1->Execute($sql); 
		$rw1=mysqli_fetch_row($DB1->Consulta_ID);
		$vals.=utf8_encode($rw1[0])."</td></tr>";
		
		$sql="SELECT par_nombre FROM proypartners INNER JOIN partners ON partners_idpartners=idpartners AND proyectos_idproyectos='$id_proyectos' ";
		$DB1->Execute($sql); 
		if($DB1->numregistros()>0){	$vals.="<tr class=\"text\"><td><b>Parthner:</b></td><td>".utf8_encode($DB1->recogedato(0))."</td></tr>"; }
		
		$sql="SELECT soc_alias FROM proysocios INNER JOIN socioslocales ON socioslocales_idsocioslocales=idsocioslocales AND
		 proyectos_idproyectos='$id_proyectos' ";
		$DB1->Execute($sql); 
		if($DB1->numregistros()>0){	$vals.="<tr class=\"text\"><td><b>Socio Local:</b></td><td>".utf8_encode($DB1->recogedato(0))."</td></tr>"; }
		$vals.="</table>";
		return $vals;
	}
}
?>