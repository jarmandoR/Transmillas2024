<?php
function devuelve_color($status)
{
	if($status==1){return "#009900";}
	elseif($status==2){return "#FF9900";}
	elseif($status==3){return "#FF0000";}
	else {return "#009900";}
}

function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
{
    $source = 'abcdefghijklmnopqrstuvwxyz';
    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if($n==1) $source .= '1234567890';
    if($sc==1) $source .= '|@#~$%()=^*+&#91;&#93;{}-_';
    if($length>0){
        $rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=$length; $i++){
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source*91;$num-1*93;;
        }
    }
    return $rstr;
}

function estadocaptura($estado, $ret)
{
	$est="Pendiente enviar";  $col="#0066CC"; 
	if($estado==1){ $est="Enviado"; $col="#FFCC33"; }
	elseif($estado==0){ $est="Pendiente enviar";  $col="#0066CC"; } 
	elseif($estado==3){ $est="Ajustar observaciones";  $col="#FF6600"; }
	elseif($estado==2){ $est="Revisado";  $col="#339900"; } 
	elseif($estado==4){ $est="Aprobado";  $col="#00CCFF"; } 
	elseif($estado==5){ $est="Ajustar observaciones";  $col="#FF3300"; }
	if($ret==1){ return "<b>".$est."</b>"; }
	else { return $col; }  
}

function rgb2hex($rgb) {
	$rgb=explode(",",$rgb);
   	$hex = str_pad(dechex(trim($rgb[0])), 2, "0", STR_PAD_LEFT);
	$hex .= str_pad(dechex(trim($rgb[1])), 2, "0", STR_PAD_LEFT);
	$hex .= str_pad(dechex(trim($rgb[2])), 2, "0", STR_PAD_LEFT);
	return $hex; // returns the hex value including the number sign (#)
}
function sanear_string($string)
{
	$string = trim($string);
	$string = str_replace(
			array('ÃƒÂ¡', 'ÃƒÂ ', 'ÃƒÂ¤', 'ÃƒÂ¢', 'Ã‚Âª', 'Ãƒï¿½', 'Ãƒâ‚¬', 'Ãƒâ€š', 'Ãƒâ€ž'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
			);
	$string = str_replace(
			array('ÃƒÂ©', 'ÃƒÂ¨', 'ÃƒÂ«', 'ÃƒÂª', 'Ãƒâ€°', 'ÃƒË†', 'ÃƒÅ ', 'Ãƒâ€¹'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
			);

	$string = str_replace(
			array('ÃƒÂ­', 'ÃƒÂ¬', 'ÃƒÂ¯', 'ÃƒÂ®', 'Ãƒï¿½', 'ÃƒÅ’', 'Ãƒï¿½', 'ÃƒÅ½'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
			);

	$string = str_replace(
			array('ÃƒÂ³', 'ÃƒÂ²', 'ÃƒÂ¶', 'ÃƒÂ´', 'Ãƒâ€œ', 'Ãƒâ€™', 'Ãƒâ€“', 'Ãƒâ€�'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
			);

	$string = str_replace(
			array('ÃƒÂº', 'ÃƒÂ¹', 'ÃƒÂ¼', 'ÃƒÂ»', 'ÃƒÅ¡', 'Ãƒâ„¢', 'Ãƒâ€º', 'ÃƒÅ“', 'Ãš'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'U'),
			$string
			);

	$string = str_replace(
			array('ÃƒÂ±', 'Ãƒâ€˜', 'ÃƒÂ§', 'Ãƒâ€¡'),
			array('n', 'N', 'c', 'C',),
			$string
			);
	//Esta parte se encarga de eliminar cualquier caracter extraÃƒÂ±o
	return $string;
}
function convert_fecha($fecha){
	if($fecha!=""){
		$fec=explode("/",$fecha);
		return $fec[2]."-".$fec[1]."-".$fec[0];
	}
	else {return "";} 
}

function current_page_url(){
    $page_url   = 'http';
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
        $page_url .= 's';
    }
	$url_1=explode("?",$_SERVER['REQUEST_URI']);
	$ss=str_replace("/","xxxx",$url_1[0]);
	$ps=explode("xxxx",$ss);
	$ps1=sizeof($ps);
    return $ps[$ps1-1];
}

function ediciones($edita, $borra)
{
	if($edita==1){
		if($borra==1){ $param_edicion=1;} else { $param_edicion=3;} 	
	}
	else {
		if($borra==1){ $param_edicion=2;} else { $param_edicion=0;} 	
	} 
	return $param_edicion;	
}

function nombre_archivo($param)
{
	$nombre_archivo=str_replace("_"," ",$param['name']);
	$nombre_archivo=str_replace(",","",$nombre_archivo);
	$nombre_archivo=str_replace("(","",$nombre_archivo);
	$nombre_archivo=str_replace(")","",$nombre_archivo);
	$sis_arch = explode(".",$nombre_archivo);
	switch(sizeof($sis_arch)) 
	{
		case 2:
		$nombre_archivo=$sis_arch[0];
		break;	
		case 3:
		$nombre_archivo=$sis_arch[0]." ".$sis_arch[1];
		break;	
		case 4:
		$nombre_archivo=$sis_arch[0]." ".$sis_arch[1]." ".$sis_arch[2];
		break;	
		case 5:
		$nombre_archivo=$sis_arch[0]." ".$sis_arch[1]." ".$sis_arch[2]." ".$sis_arch[3];
		break;	
		case 6:
		$nombre_archivo=$sis_arch[0]." ".$sis_arch[1]." ".$sis_arch[2]." ".$sis_arch[3]." ".$sis_arch[4];
		break;	
		default:
		$nombre_archivo=$sis_arch[0];
		break;	
	}
	return $nombre_archivo;
}

function subir_archivo1($param)
{
	ini_set('upload-max-filesize', '10M');
	ini_set('post_max_size', '10M');

	$nombre_archivo = $param['name']; 
	$tipo_archivo = $param['type']; 
	$tamano_archivo = $param['size']; 
	$bandera=10;
	$rr=explode(".",$nombre_archivo);
	$fd=0;
	if ($tamano_archivo<10000000){$fd=1;}
	if($fd!=0)
	{   
		$exsp=explode(".",$nombre_archivo);
		$extension=$exsp[sizeof($exsp)-1];
		
		$nombre_archivo=str_replace(" ","_",$nombre_archivo);
		$nombre_archivo=str_replace(".","",$nombre_archivo);
		$nombre_archivo=str_replace(",","",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã‚Â±","n",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã¢â‚¬Ëœ","N",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã‚Â³","u",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã‚Â¡","u",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã‚Â©","u",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã‚Â­","u",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã‚Âº","u",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã…Â¡","U",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã¢â‚¬Å“","O",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã¯Â¿Â½","I",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã¢â‚¬Â°","E",$nombre_archivo);
		$nombre_archivo=str_replace("ÃƒÆ’Ã¯Â¿Â½","A",$nombre_archivo);
		$rand=rand(1000000 ,9999999);
		$arquivo="uploaded/".$nombre_archivo."".$rand.".".$extension;
		if (move_uploaded_file($param['tmp_name'],$arquivo))
		{
			$pathSave=$arquivo; 
		}
		else {
			$pathSave="";
		}
	}
	return $pathSave;
}

function envia_mail($causal, $persona, $mail, $mail1, $mail2, $mail3, $mail4, $medidor)
{
	$mensaje1="Fecha: ".date("Y-m-d H:i:s")." \n";
	$mensaje1.="Causa Alarma: $causal \n";
	$mensaje1.="Medidor: $medidor \n";
	$headers .= "From: Tracker de Colombia \r\n"; 
	$headers .= "Reply-To: $mail\r\n"; 
	$headers .= 'From: Tracker de Colombia' . "\r\n" .
	$headers .= 'Cc: $mail1' . "\r\n";
	$headers .= 'Cc: $mail2' . "\r\n";
	$headers .= 'Cc: $mail3' . "\r\n";
	$headers .= 'Cc: $mail4' . "\r\n";
	'Reply-To: $nombre' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
    if(mail("$mail1", "$causal", $mensaje1, $headers))
	{
	    if(mail("$mail", "$causal", $mensaje1, $headers))
		{
	    	mail("$mail2", "$causal", $mensaje1, $headers);
		}
	}
}

function convierte_fecha($fecha_ingles){ 
    $ano=substr($fecha_ingles, 0, 4); 
    $mes=substr($fecha_ingles, 5, 2); 
    $dia=substr($fecha_ingles, 8, 2); 
     
    if ($mes=="01") $mes="Enero"; 
    elseif ($mes=="02") $mes="Feb"; 
    elseif ($mes=="03") $mes="Mar"; 
    elseif ($mes=="04") $mes="Abr"; 
    elseif ($mes=="05") $mes="May"; 
    elseif ($mes=="06") $mes="Jun"; 
    elseif ($mes=="07") $mes="Jul"; 
    elseif ($mes=="08") $mes="Ago"; 
    elseif ($mes=="09") $mes="Sep"; 
    elseif ($mes=="10") $mes="Oct"; 
    elseif ($mes=="11") $mes="Nov"; 
    elseif ($mes=="12") $mes="Dic"; 
    else $mes="--"; 
    $fecha_castellano = $dia." de ".$mes." de ".$ano; 
    echo "$fecha_castellano"; 
}  
function conversorSegundosHoras($tiempo_en_segundos) {
	$horas = floor($tiempo_en_segundos / 3600);
	$minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
	$segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

	return $horas . ':' . $minutos . ":" . $segundos;
}
function llena_intervenciones($id_e, $ttarea, $DB1, $DB2)
{	
	$sql1="SELECT idintervenciones, dia_fecha, pvs_codigo, con_nombre FROM intervenciones INNER JOIN contrato ON idcontrato=contrato_idcontrato 
	INNER JOIN pvs ON pvs_idpvs=idpvs AND contratose_idcontratose='$id_e' AND tipostarea_idtipostarea='$ttarea' ";
	$DB1->Execute($sql1); 
	$row1 = mysqli_fetch_array($DB1->Consulta_ID);
	$idint=$row1[0];
	echo "<td>$row1[1]</td><td>$row1[2]</td><td>$row1[3]</td>";
	$sqs="SELECT idtareas, tar_nombre FROM tareas WHERE tipostarea_idtipostarea='$ttarea'";
	$DB1->Execute($sqs); 
	while ($row2 = mysqli_fetch_array($DB1->Consulta_ID)) 
	{
		$idt=$row2[0];
		$sqsl="SELECT tai_fecha, tai_completado FROM tareasintervenciones WHERE tareas_idtareas='$idt' AND intervenciones_idintervenciones='$idint' ";
		$DB2->Execute($sqsl); 
		$row3 = mysqli_fetch_array($DB2->Consulta_ID); 
		echo "<td>$row3[1]</td>";
	}
}
function llena_titul_intervencion($ttarea, $FB, $DB){
	$sqs="SELECT tta_nombre FROM tipostarea WHERE idtipostarea='$ttarea'";
	$DB->Execute($sqs); 
	$tipo=$DB->recogedato(0); 

	$FB->titulo_azul2a("Fecha",1,80,0); $FB->titulo_azul2a($tipo,1,80,0); $FB->titulo_azul2a("Mentor",1,80,0);
	$sqs="SELECT idtareas, tar_nombre FROM tareas WHERE tipostarea_idtipostarea='$ttarea'";
	$DB->Execute($sqs); 
	while ($row = mysqli_fetch_array($DB->Consulta_ID)) 
	{
		echo "<td>$row[1]</td>";
	}
}
function reemplazo($testo)
{
	$testo=str_replace("ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³","ÃƒÆ’Ã‚Â³",$testo);
	$testo=str_replace("ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³","o",$testo);
	$testo=str_replace("ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³","o",$testo);
	return $testo;	
}

function quitar_tildes($cadena) {
	$no_permitidas= array ("ÃƒÆ’Ã‚Â¡","ÃƒÆ’Ã‚Â©","ÃƒÆ’Ã‚Â­","ÃƒÆ’Ã‚Â³","ÃƒÆ’Ã‚Âº","ÃƒÆ’Ã¯Â¿Â½","ÃƒÆ’Ã¢â‚¬Â°","ÃƒÆ’Ã¯Â¿Â½","ÃƒÆ’Ã¢â‚¬Å“","ÃƒÆ’Ã…Â¡","ÃƒÆ’Ã‚Â±","ÃƒÆ’Ã¢â€šÂ¬","ÃƒÆ’Ã†â€™","ÃƒÆ’Ã…â€™","ÃƒÆ’Ã¢â‚¬â„¢","ÃƒÆ’Ã¢â€žÂ¢","ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢","ÃƒÆ’Ã†â€™ ","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¨","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¬","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â²","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¹","ÃƒÆ’Ã‚Â§","ÃƒÆ’Ã¢â‚¬Â¡","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢","ÃƒÆ’Ã‚Âª","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â®","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â´","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â»","ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡","ÃƒÆ’Ã†â€™Ãƒâ€¦Ã‚Â ","ÃƒÆ’Ã†â€™Ãƒâ€¦Ã‚Â½","ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã¯Â¿Â½","ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Âº","ÃƒÆ’Ã‚Â¼","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¶","ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã¢â‚¬Å“","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¯","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¤","Ãƒâ€šÃ‚Â«","ÃƒÆ’Ã¢â‚¬â„¢","ÃƒÆ’Ã†â€™Ãƒâ€šÃ¯Â¿Â½","ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¾","ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¹");
	$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
	$texto = str_replace($no_permitidas, $permitidas ,$cadena);
	return $texto;
}
function dev_formula($texto){
	$texto=trim(str_replace(")","",$texto));
	$texto=trim(str_replace("(","",$texto));
	$texto=trim(str_replace("+","",$texto));
	$texto=trim(str_replace("*","",$texto));
	$texto=trim(str_replace("/","",$texto));
	$texto=trim(str_replace("-","",$texto));
	return $texto=trim(str_replace("]","",$texto));
}

function valor_indicador($DB1, $id_p, $condi, $cond, $foca)
{
	$sql="SELECT idmetas, met_nombre, met_operacion, marcologico_idmarcologico, met_formula FROM metas WHERE idmetas='$id_p' ";
	$DB1->Execute($sql); 
	$rw = mysqli_fetch_array($DB1->Consulta_ID);
	$formula=$rw[4];
	$params=explode("[",$rw[4]);
	$oper=$rw[2]; $oper1=$rw[2]; $igual=""; $valor=""; $cond2="";
	$cue="res_respuesta";
	if($oper=="SUMA"){ $cue="SUM(res_respuesta)";} elseif($oper=="CUENTA"){ $cue="COUNT(res_respuesta)";} elseif($oper=="AGRUPA"){ $cue="COUNT(DISTINCT(res_respuesta))";}
	elseif($oper=="VALOR"){ $cue="res_respuesta";}
	foreach($params as $preg)
	{
		$pre=dev_formula($preg);
		if($pre!=""){
			$iden=explode("_",$pre);
			$idfor=trim(str_replace("F:","",$iden[0]));
			$idpre=trim(str_replace("P:","",$iden[1]));
			if(isset($iden[2])){
				$oper=trim(str_replace("A:","",$iden[2]));
				if($oper=="S"){ $cue="SUM(res_respuesta)";} elseif($oper=="C"){ $cue="COUNT(res_respuesta)";} elseif($oper=="D"){ $cue="COUNT(DISTINCT(res_respuesta))";}
				elseif($oper=="V"){ $cue="res_respuesta";} elseif($oper=="P"){ $cue="COUNT(res_respuesta)";} else { $cue="res_respuesta"; }
			}
			if(isset($iden[3])){ $igual=trim(str_replace("I:","",$iden[3])); }
			if(isset($iden[4])){ $valor=trim(str_replace("V:","",$iden[4])); $cond2=" AND res_respuesta $igual '$valor' ";  }
			if($oper1=="PORCENTAJE"){ 
				$fp1["I Educativa"]="ide_codigo"; $fp1["Docentes"]="doc_nombre"; $fp1["Nivel educativo"]="doc_nivel"; $fp1["Escalafon"]="doc_escalafon";  
				$fp1["Grado Escalafon"]="doc_gradoescalafon"; $fp1["Area ensenanza"]="doc_areaensenanza"; $fp1["Estudiantes"]="SUM(mat_prejardin + mat_jardin + mat_transicion + mat_1 + mat_2 + mat_3 + mat_4 + mat_5 + mat_6 + mat_7 + mat_8 + mat_9 + mat_10 + mat_11 + mat_12 + mat_13 + mat_ciclo1 + mat_ciclo2 + mat_ciclo3 + mat_ciclo4 + mat_ciclo5 + mat_ciclo6 + mat_aceleracion)"; $fp1["Estudiantes preescolar"]="SUM(mat_prejardin + mat_jardin + mat_transicion)"; $fp1["Estudiantes primaria"]="SUM(mat_1 + mat_2 + mat_3 + mat_4 + mat_5)"; $fp1["Estudiantes secundaria"]="SUM(mat_6 + mat_7 + mat_8 + mat_9 + mat_10 + mat_11 + mat_12 + mat_13)";  
				$fp1["Estudiantes 6"]="mat_6"; $fp1["Estudiantes 7"]="mat_7"; $fp1["Estudiantes 8"]="mat_8"; $fp1["Estudiantes 9"]="mat_9"; $fp1["Estudiantes 10"]="mat_10"; 
				$fp1["Estudiantes 11"]="mat_11"; $fp1["FNE"]="fne_nombre"; $fp1["Nacionalidad"]="fne_nacionalidad"; $fp1["Edad"]="fne_nacimiento"; 
				$fp1["Profesion"]="fne_profesion"; $fp1["Sexo"]="fne_sexo";
				$cond3="";
				if(isset($iden[5])){ 
					$val1=trim(str_replace("T:","",$iden[5])); 
					if($val1=="I Educativas"){ $tales="ieducativas"; $vpr="idieducativas";}
					else if($val1=="Docentes"){ $tales="docentes"; $vpr="iddocentes";}
					else if($val1=="Matriculas"){ $tales="matriculas"; $vpr="ieducativas_idieducativas";}
					else if($val1=="FNE"){ $tales="fne"; $vpr="idfne";}
					else {$tales="ieducativas"; $vpr="idieducativas";} 
				} else {$val1=""; } 
				if(isset($iden[6])){ $val2=trim(str_replace("G:","",$iden[6])); 
					if($val2=="S"){ $cun="SUM($vpr)";} elseif($val2=="C"){ $cun="COUNT($vpr)";} elseif($val2=="D"){ $cun="COUNT(DISTINCT($vpr))";} 
					elseif($val2=="V"){ $cun="$vpr";} elseif($val2=="P"){ $cun="COUNT($vpr)";} else { $cun="$vpr"; }
				} else {$val2=""; }
				if(isset($iden[7])){ $val3=trim(str_replace("C:","",$iden[7])); if($val3!=""){ $cond3="WHERE $fp1[$val3] "; } } else {$val3=""; }
				if(isset($iden[8])){ $val4=trim(str_replace("O:","",$iden[8])); if($val4=="=" and $val3!=""){ $val4="LIKE";  } $cond3.=$val4; } else {$val4=""; }
				if(isset($iden[9])){ $val5=trim(str_replace("M:","",$iden[9])); if($val5!=""){ if($val4=="LIKE"){$cond3.="'%$val5%'";}else{$cond3.="'$val5'";}} else{$val5="";}}
				$sql="SELECT $cun FROM $tales $cond3";
				$DB1->Execute($sql); 
				$por1=$DB1->recogedato(0); 
		 	}
			if($condi!=""){
				$sqls="SELECT preguntas1_idpreguntas1 FROM respuesta_$idfor WHERE res_orden=1 "; 
				$DB1->Execute($sqls); 
				$tre=$DB1->recogedato(0); 
				$tre=$tre."".$foca;
				$condi=$condi[$tre]." $cond ";
				$condi=str_replace("xxx", $idfor, $condi);
				$DB1->Execute($condi); 
				$res=$DB1->recogedato(0); $ids="";
				while($rw = mysqli_fetch_array($DB1->Consulta_ID)){ $ids.=$rw[0].","; }
				$condi="AND res_idunico IN (".substr($ids,0,-1).")";
			}
			$sql_res="SELECT $cue FROM respuesta_$idfor WHERE preguntas1_idpreguntas1='$idpre' $condi $cond2 ";
			$DB1->Execute($sql_res); 
			$res=$DB1->recogedato(0); 
			if($oper1=="PORCENTAJE"){ 
				if($por1!=""){ $res=number_format(($res/$por1*100),2,".","."); } else {$por1=0;} 
			}
			$pre1="[$pre]";
			$formula=str_replace($pre1,$res,$formula);
		}
	}
	if($formula==""){ $formula="0";}
	$sql_res="SELECT $formula";
	$DB1->Execute($sql_res); 
	return $res=$DB1->recogedato(0); 
}

function valor_indicador1($DB1, $id_p, $condi, $DB2)
{
	$sql="SELECT idmetas, met_nombre, met_operacion, marcologico_idmarcologico, met_formula FROM metas WHERE idmetas='$id_p' ";
	$DB1->Execute($sql);
	$rw = mysqli_fetch_array($DB1->Consulta_ID);
	$formula=$rw[4];
	$params=explode("[",$rw[4]);
	$oper=$rw[2];
	$cue="res_respuesta";
	if($oper=="SUMA"){ $cue="SUM(res_respuesta)";}
	elseif($oper=="CUENTA"){ $cue="COUNT(res_respuesta)";}
	elseif($oper=="AGRUPA"){ $cue="COUNT(DISTINCT(res_respuesta))";}
	elseif($oper=="VALOR"){ $cue="res_respuesta";}
	foreach($params as $preg)
	{
		$pre=dev_formula($preg);
		if($pre!=""){
			$iden=explode("_",$pre);
			$idfor=trim(str_replace("F:","",$iden[0]));
			$idpre=trim(str_replace("P:","",$iden[1]));
			$sql_res="SELECT res_idunico FROM respuesta_$idfor $condi ";	
			$DB2->Execute($sql_res); $idunic="";
			while($rw2=mysqli_fetch_row($DB2->Consulta_ID)){$idunic.=$rw2[0].",";  }
			$idunic=substr($idunic,0,strlen($idunic)-1); if($idunic==""){ $idunic="0"; }
			$cond2=" AND res_idunico IN (".$idunic.")";
		 	$sql_res="SELECT $cue FROM respuesta_$idfor WHERE preguntas1_idpreguntas1='$idpre' $cond2 ";	
			$DB1->Execute($sql_res); 
			$res=$DB1->recogedato(0); 
			$pre1="[$pre]";
			$formula=str_replace($pre1,$res,$formula);
		}
	}
	if($formula==""){ $formula="0";}
	$sql_res="SELECT $formula";
	$DB1->Execute($sql_res); 
	return $res=$DB1->recogedato(0); 
}

function avance_gestion($DB1, $DB2, $DB3, $cond, $id_param)
{
	$sql1="SELECT DISTINCT(idieducativas) FROM ieducativas a INNER JOIN gestoresie ON idieducativas=ieducativas_idieducativas $cond ";
	$DB1->Execute($sql1); $valor=0; $cuenta=0;
	while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$por2=avance_vis($DB2, $DB3, 0, $rw2[0], $id_param, 0, $id_param); $valor=$valor+$por2;
		$cuenta++;
	}
	if($cuenta>0){ $valor=$valor/$cuenta; }
	return $valor;
}
function reporte_alarmas($DB1, $cond)
{
	$sql="SELECT COUNT(*) FROM alarmas $cond GROUP BY ala_tabla, idviende";
	$DB1->Execute($sql); $valor=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID)){ $valor++; }
	return $valor;
}
function avance_indicador($DB1, $id_p, $valor, $marco)
{
//	$res=valor_indicador($DB1, $id_p, $fecha);
	$sql1="SELECT mar_meta FROM marcologico WHERE idmarcologico='$marco'";
	$DB1->Execute($sql1); 
	$met=$DB1->recogedato(0); $por=0;
	if($met!=0){ $por=($valor/$met)*100; } 
	return $por;
}

function devuelve_tipo($idtipoindi, $devuelve)
{
	$prefix=""; $suffix=""; $sql="";
	switch(substr($idtipoindi,0,5))
	{
		case "cuent":
		$cuenta="COUNT(*)"; $cuenta1=""; $cuenta2="";
		break;	
		case "Porce":
		$cuenta="SUM(pru_respuesta)"; $cuenta1=""; $cuenta2="1"; $prefix=""; $suffix="%";
		break;	
		case "Prome":
		$cuenta="AVG(pru_respuesta)"; $cuenta1=""; $cuenta2="1";
		break;	
		case "Numer":
		$cuenta="SUM(pru_respuesta)"; $cuenta1=""; $cuenta2="1";
		break;	
		case "Texto":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta ";$cuenta2="2";
		break;	
		case "Unica":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2";
		break;	
		case "Valid":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2";
		break;	
		case "Fecha":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2";
		break;	
		case "Evide":
		$cuenta="COUNT(*)"; $cuenta1="  "; $cuenta2="1";
		break;
		case "Ubica":
		$cuenta="COUNT(*), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2"; $sql="SELECT ciu_nombre FROM ciudades WHERE idciudades=";
		break;	
		default:
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2";
		break;	
	}
	if($devuelve==1) { return $cuenta; }
	else if($devuelve==2) { return $cuenta1; }
	else if($devuelve==3) { return $cuenta2; }
	else if($devuelve==4) { return $prefix; }
	else if($devuelve==5) { return $suffix; }
	else if($devuelve==6) { return $sql; }
	else { return $cuenta; } 
	
}

function devuelve_tipo1($idtipoindi)
{
	switch(substr($idtipoindi,0,5))
	{
		case "Porce":
		$cuenta="SUM(pru_respuesta)"; $cuenta1="";
		break;	
		case "prome":
		$cuenta="AVG(pru_respuesta)"; $cuenta1="";
		break;	
		case "Numer":
		$cuenta="SUM(pru_respuesta)"; $cuenta1="";
		break;	
		case "cuent":
		$cuenta="COUNT(*)"; $cuenta1="";
		break;	
		case "Texto":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta ";
		break;	
		case "Unica":
		$cuenta="COUNT(*), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta ";
		break;	
		case "Valid":
		$cuenta="COUNT(*), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta ";
		break;	
		case "Fecha":
		$cuenta="COUNT(*), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta ";
		break;	
		case "Evide":
		$cuenta="COUNT(*)"; $cuenta1="  ";
		break;
		case "Ubica":
		$cuenta="COUNT(*), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta ";
		break;	
		default:
		$cuenta="COUNT(*), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta ";
		break;	
	}
	return $cuenta1;
}

function devuelve_tipo2($idtipoindi)
{
	switch(substr($idtipoindi,0,5))
	{
		case "cuent":
		$cuenta="COUNT(*)"; $cuenta1=""; $cuenta2="";
		break;	
		case "Porce":
		$cuenta="SUM(pru_respuesta)"; $cuenta1=""; $cuenta2="1";
		break;	
		case "prome":
		$cuenta="AVG(pru_respuesta)"; $cuenta1=""; $cuenta2="1";
		break;	
		case "Numer":
		$cuenta="SUM(pru_respuesta)"; $cuenta1=""; $cuenta2="1";
		break;	
		case "Texto":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta ";$cuenta2="2";
		break;	
		case "Unica":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2";
		break;	
		case "Valid":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2";
		break;	
		case "Fecha":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2";
		break;	
		case "Evide":
		$cuenta="COUNT(*)"; $cuenta1="  "; $cuenta2="1";
		break;
		case "Ubica":
		$cuenta="COUNT(*), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2";
		break;	
		default:
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2";
		break;	
	}
	return $cuenta2;
}

function devuelve_tipo3($idtipoindi)
{
	$leyenda="";
	switch(substr($idtipoindi,0,5))
	{
		case "Porce":
		$cuenta="SUM(pru_respuesta)"; $cuenta1=""; $cuenta2="1"; $leyenda="Porcentaje";
		break;	
		case "prome":
		$cuenta="AVG(pru_respuesta)"; $cuenta1=""; $cuenta2="1"; $leyenda="Promedio";
		break;	
		case "Numer":
		$cuenta="SUM(pru_respuesta)"; $cuenta1=""; $cuenta2="1"; $leyenda="Total";
		break;	
		case "Texto":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta ";$cuenta2="2"; $leyenda="Cuenta";
		break;	
		case "Unica":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2"; $leyenda="Cuenta";
		break;	
		case "Valid":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2"; $leyenda="Cuenta";
		break;	
		case "Fecha":
		$cuenta="COUNT(DISTINCT(pru_respuesta)), pru_respuesta"; $cuenta1=" GROUP BY pru_respuesta "; $cuenta2="2"; $leyenda="Cuenta";
		break;	
		case "Evide":
		$cuenta="COUNT(*)"; $cuenta1="  "; $cuenta2="1";  $leyenda="";
		break;
		case "Ubica":	
		$cuenta="COUNT(*)"; $cuenta1="  "; $cuenta2="1";  $leyenda="Ciudades";
		break;
	}
	return $leyenda;
}

function registro_avance($sql, $DB, $DB1, $FB, $mostrar){ 
	$DB->Execute($sql); $va=0; $tipo1=""; $tot1=0; $tot2=0;
	if($mostrar==1){
		echo "<tr bgcolor='#074F91' class='tittle3'><td width='30%'>Referencia</td><td width='10%'>Meta</td>
		<td width='10%'>Avance</td><td width='10%'>% Esperado</td><td width='10%'>% Avance</td></tr>";
	}
	while($rw=mysqli_fetch_row($DB->Consulta_ID))
	{
		$va++;
		$p=$va%2;
		$id_p=$rw[0];
		if($p==0){$color="#FFFFFF";}
		else{$color="#EFEFEF";}
		$nombre=$rw[1];
		$dif=$FB->datediff("d", $rw[3], $rw[4], false);
		$dif2=$FB->datediff("d", $rw[4], date("Y-m-d"), false);
		if($dif2>0){ $avae=100; } 
		else { if($dif!=0){ $avae=($dif2/$dif)*-100; } else {$avae=0; } } 
		$idtipoind=$rw[5]; $i=0; 
		if($mostrar==1){ echo "<tr class='text'><td>".$nombre."</td>"; }
		$cuenta=devuelve_tipo($idtipoind,1);
		$cuenta1=devuelve_tipo($idtipoind,2);
		$cuenta2=devuelve_tipo($idtipoind,3);
		if($cuenta2==2 and $rw[3]!=""){	$aray=explode(";",$rw[3]); }	
		$sql1="SELECT $cuenta FROM preguntasusuarios WHERE pru_idencuesta='$id_p' AND pru_idindicador=1 $cuenta1 ";
		$DB1->Execute($sql1); $vls=0;
		$ssk=substr($idtipoind,0,5); $porc=0;
		if($ssk=="Selec"){
			while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
			{
				if($mostrar==1){  echo "<td bgcolor='#21439E' class='tittle3'>".$rw1[1]."</td><td align='right'>$rw1[0]</td>"; }
			}
		}
		else {
			$meta=$rw[2];
			if($mostrar==1){  echo "<td align='right'>".devuelve_tipo($idtipoind,4)." $meta ".devuelve_tipo($idtipoind,5)." </td>"; }
			while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
			{
				$vls=$rw1[0];
				if($vls==""){ $vls=0; }
				if($mostrar==1){  echo "<td align='right'>".devuelve_tipo($idtipoind,4)." $vls ".devuelve_tipo($idtipoind,5)."</td>"; }
			}
			if($meta!=0){$porc=($vls/$meta)*100;}  
			if($avae=="0"){ $bcolor="#FF0000";} elseif($avae>"0" and $avae<"100"){ $bcolor="#FFCC00";} else {$bcolor="#00CC00";} 
			if($mostrar==1){ echo "<td align='right' bgcolor='$bcolor'>".number_format($avae,2,".",".")."%</td>"; }
			if($porc=="0"){ $bcolor="#FF0000";} elseif($porc>"0" and $porc<"100"){ $bcolor="#FFCC00";} else {$bcolor="#00CC00";} 
			if($mostrar==1){ echo "<td align='right' bgcolor='$bcolor'>".number_format($porc,2,".",".")."%</td>"; }
		}
		$tot1=$tot1+$porc;
		$tot2=$tot2+$avae;
		if($mostrar==1){ echo "</tr>"; }
	}
	if($va!=0){$porcavance_estado=($tot1/$va);} else { $porc=0;} 
	$bcolor=color_dev($porc);
	if($va!=0){$porc1=($tot2/$va);} else { $porc1=0;} 
	$bcolor1=color_dev($porc1);
	if($mostrar==1){ 
		echo "<tr bgcolor='#074F91' class='tittle3'><td colspan=3>Total Avance</td>"; 
		echo "<td align='right' bgcolor='$bcolor'>".number_format($porc1,2,".",".")."%</td>"; 
		echo "<td align='right' bgcolor='$bcolor1'>".number_format($porc,2,".",".")."%</td></tr>"; 
	}
	else {
		echo "<td align='right' bgcolor='$bcolor'>".number_format($porc,2,".",".")."%</td>"; 
	} 
}
function color_dev($porc){
	if($porc=="0"){ $bcolor="#FF0000";} elseif($porc>"0" and $porc<"100"){ $bcolor="#FFCC00";} else {$bcolor="#00CC00";} 
	return $bcolor;
}

function avance_gestion1($DB2, $DB, $vis, $idie, $id_param, $res, $cond)
{
	if($vis==0){ $cdns=""; } else { $cdns="AND vis_visita IN ($vis)"; }
	if($res==1){ $cdnt="AND res_estado!=0 "; } else { $cdnt=""; } 
	if($id_param!="") { $cdnp=" AND proyectos_idproyectos='$id_param' "; } else { $cdnp=""; }
//	if($idie!="") { $cdnq=" INNER JOIN ieducativas ON res_respuesta=idieducativas $cdnt AND res_respuesta IN ($idie)  "; } else { $cdnq=""; }
 	$sqls="SELECT idactindgener FROM actindgener INNER JOIN formvisitas ON actindgener_idactindgener=idactindgener $cdnp $cdns GROUP BY idactindgener ORDER BY aci_nombre";
	$DB->Execute($sqls); $nfor=0; $por2=0;
	while($rw2=mysqli_fetch_row($DB->Consulta_ID))
	{
		$sql2="SELECT COUNT(DISTINCT(res_respuesta)) FROM respuesta_$rw2[0] $cond WHERE res_orden=1 AND res_respuesta!='' $cdnt  ";  
		$DB2->Execute($sql2); 
		$va2=$DB2->recogedato(0);
		if($idie!=0){ $por1=($va2/$idie)*100; } else {$por1=0; } 
		$por2=$por2+$por1;
		$nfor++;
	}
	if($nfor!=0){ $por1=($por2/$nfor); } else {$por1=0; } 
	return $por1;
}

function avance_vis($DB2, $DB, $vis, $idie, $tip, $res, $id_param)
{
	if($vis==0){ $cdns=""; } else { $cdns="AND vis_visita IN ($vis)"; }
	if($res==1){ $cdnt="AND res_estado!=0 "; } else { $cdnt=""; } 
	if($id_param!="") { $cdnp=" AND proyectos_idproyectos='$tip' "; } else { $cdnp=""; }
 	$sqls="SELECT idactindgener FROM actindgener INNER JOIN formvisitas ON actindgener_idactindgener=idactindgener $cdnp $cdns GROUP BY idactindgener ORDER BY aci_nombre";
	$DB->Execute($sqls); $nfor=0; $nres=0;
	while($rw2=mysqli_fetch_row($DB->Consulta_ID))
	{
		$idp=$rw2[0];
		if($tip==1){ $sql2="SELECT COUNT(*) FROM respuesta_$idp WHERE res_orden=1 AND res_respuesta='$idie' $cdnt ";  }
		else { $sql2="SELECT COUNT(*) FROM respuesta_$idp INNER JOIN ieducativas ON res_respuesta=idieducativas $cdnt AND res_orden=1 AND res_respuesta='$idie'";	}
		$DB2->Execute($sql2); 
		$val=$DB2->recogedato(0);
		if($val>0){ $nres++; } $nfor++;
	}
	if($nfor!=0){ $por1=($nres/$nfor)*100; } else {$por1=0; } 
	return $por1;
}

function avance_estado($DB2, $DB, $vis, $idie, $tip, $res, $id_param)
{
	if($vis==0){ $cdns=""; } else { $cdns="AND vis_visita IN ($vis)"; }
	if($res==1){ $cdnt="AND res_estado!=0 "; } else { $cdnt=""; } 
	if($id_param!="") { $cdnp=" AND proyectos_idproyectos='$id_param' "; } else { $cdnp=""; }
//	if($idie!="") { $cdnq=" INNER JOIN ieducativas ON res_respuesta=idieducativas $cdnt AND res_respuesta IN ($idie)  "; } else { $cdnq=""; }
 	$sqls="SELECT idactindgener FROM actindgener INNER JOIN formvisitas ON actindgener_idactindgener=idactindgener $cdnp $cdns GROUP BY idactindgener ORDER BY aci_nombre";
	$DB->Execute($sqls); $nfor=0; $por2=0;
	while($rw2=mysqli_fetch_row($DB->Consulta_ID))
	{
		echo $sql2="SELECT COUNT(DISTINCT(res_respuesta)) FROM respuesta_$rw2[0] $cond WHERE res_orden=1 AND res_respuesta!='' $cdnt  ";  
		$DB2->Execute($sql2); 
		$va2=$DB2->recogedato(0);
		//if($idie!=0){ $por1=($va2/$idie)*100; } else {$por1=0; } 
		$por2=$por2+$va2;
		$nfor++;
	}
	if($nfor!=0){ $por1=($por2/$nfor); } else {$por1=0; } 
	return $por2;
}

function devcolnov($nomv)
{
	if($nomv=="Muy alto"){ $col="#FF0000";  }
	else if($nomv=="Alto"){ $col="#FF6600";  }
	else if($nomv=="Medio"){ $col="#FF9900";  }
	else if($nomv=="Medio-bajo"){ $col="#FFCC00";  }
	else { $col="#FFFF00"; } 
	return $col;
}

function lista_novedades($ide, $FB, $DB, $DB1, $LT, $nov)
{
	$FB->titulo_azul1("Novedad",1,0,5); $FB->titulo_azul1("Descripci&oacute;n",1,0,0); $FB->titulo_azul1("Detalle Novedad",1,0,0); $FB->titulo_azul1("Fecha",1,0,0);
	$FB->titulo_azul1("Justificaci&oacute;n",1,2,0); 
	$sql="SELECT DISTINCT(idnovedades), nov_tabla, nov_descripcion1, nov_descripcion, nov_fecha, nov_descripcion2 FROM novedades INNER JOIN ieducativas a ON 
	nov_idvienede=idieducativas INNER JOIN gestoresie b ON b.ieducativas_idieducativas=idieducativas INNER JOIN gestores ON gestores_idgestores=idgestores AND 
	idieducativas='$ide' AND nov_tabla IN ($nov)";
	$LT->llenatabla_ajax($sql,6, "Novedad",0,"","","","","","", 0, $DB, $DB1);
	echo "</table>";
}
function lista_novedadesd($ide, $FB, $DB, $DB1, $LT, $nov)
{
	$FB->titulo_azul1("Novedad",1,0,5); $FB->titulo_azul1("Descripci&oacute;n",1,0,0); $FB->titulo_azul1("Detalle Novedad",1,0,0); $FB->titulo_azul1("Fecha",1,0,0); 
	 $FB->titulo_azul1("Justificaci&oacute;n",1,2,0); 
	$sql="SELECT idnovedades, nov_tabla, nov_descripcion1, nov_descripcion, nov_fecha, nov_descripcion2 FROM novedades INNER JOIN docentes a ON nov_idvienede=iddocentes 
	AND iddocentes='$ide' AND nov_tabla IN ($nov)  ";
	$LT->llenatabla($sql,6, "Novedad",0,"","","","","","", 0, $DB, $DB1);
	echo "</table>";
}

?>