<?php
/* Esta clase se encarga de realizar ciertas funciones que tienen que ver con la manipulaci&oacute;n de fechas, funciones de presentaci&oacute;n y otro tipo de procedimientos auxiliares */
class sql_transact extends DB_mssql
{
	function sql_transacion(){} // Constructor vacio
	/* Llena el t�tulo de los encabezados de la tabla, permite ingresar campo por el cual se quiere que se ordene y el orden 
	ascendente o descendente */

	function columnastable($tabla, $accion, $DB, $ID)
	{
	
	}	
	function Addlogs($tabla, $accion, $DB, $ID)
	{
		$sql="INSERT INTO logs (idlogs, log_fecha, usuarios_idusuarios, log_objeto, log_accion) 
		VALUES ('', '".date("Y-m-d H:i:s")."', '$ID', '$tabla', '$accion') "; 
		$DB->Execute($sql);
	}
	
	function selectn()
	{
		for($i=0; $i<100; $i++){ $rw[$i]=""; } 	
		return $rw;
	}

	function select($tablaf, $campos, $idpar, $id_param, $DB, $sqls)
	{
		if($sqls==""){ $sql="SELECT $campos FROM $tablaf WHERE $idpar=$id_param "; }
		else {$sql=$sqls; }
		//echo $sql;
		$DB->Execute($sql);
		return $rw=mysqli_fetch_array($DB->Consulta_ID);
	}

	function update($tablaf, $campos, $esp, $add, $DB, $id_p, $id_param, $tabla, $tipo)
	{
		$sql="UPDATE $tablaf SET "; 
		if($tipo==1){$i=0;
			foreach($_POST as $nombre_campo => $valor){
				$cmp=explode(",",$campos); 
				if(substr($nombre_campo,0,5)=="param"){	
					$sql=$this->cambio1($nombre_campo, $valor, $sql, $esp, $cmp, $i); $i++; 
				}
			}
			//echo $sql; exit;
		}
		else {$i=0;
			foreach($_REQUEST as $nombre_campo => $valor){
				$cmp=explode(",",$campos); 
				if(substr($nombre_campo,0,5)=="param"){	$sql=$this->cambio1($nombre_campo, $valor, $sql, $esp, $cmp, $i); $i++; }
			}
		}
		if($add==""){ $sql=substr($sql,0,strlen($sql)-1); }	$sql.=" WHERE $id_p='$id_param' ";
		//echo $sql; 		exit;
		
		if ($DB->Execute($sql))
		{
			$bandera=5; $i=1;
			foreach($_FILES as $nom => $val)
			{
				$nomb=nombre_archivo($val);
				$ruta=subir_archivo1($val);
				if($nomb!=""){
					$sql_ins="INSERT INTO documentos (iddocumentos, doc_fecha, doc_nombre, doc_ruta, doc_tabla, doc_idviene, doc_version) VALUES 
					('', '".date("Y-m-d")."', '$nomb', '$ruta', '$tabla', '$id_param', '$i')";
					$DB->Execute($sql_ins);
				}
				$i++;
			}
		}
		else{$bandera=6;}
		$DB->cerrarconsulta();	
		return $bandera;
	}

	function delete($tablaf, $DB, $id_p, $id_param, $tabla)
	{
		 $sql="DELETE FROM $tablaf WHERE $id_p=$id_param  "; 
		
		if ($DB->Execute($sql)){
			$bandera=2;
			/* $sql1="DELETE FROM documentos WHERE doc_idviene=$id_param AND doc_tabla='$tabla' "; 
			$DB->Execute($sql1); */
		}
		else{$bandera=3;}
		$DB->cerrarconsulta();	
		return $bandera;
	}

	function insert($tablaf, $campos, $esp, $add, $DB, $tabla, $tipo)
	{
		$sql="INSERT INTO $tablaf ($campos) VALUES ('', ";
		
		if($tipo==1){
			foreach($_POST as $nombre_campo => $valor){
				$sql=$this->cambio($nombre_campo,$valor, $sql, $esp);
			}
		}
		else {
			foreach($_REQUEST as $nombre_campo => $valor){
				$sql=$this->cambio($nombre_campo,$valor, $sql, $esp);
			}
		}
		if($add==""){ $sql=substr($sql,0,strlen($sql)-1); }
		$sql.="$add)";
		//echo $sql;   
		
		if ($DB->Execute($sql)){
			$cams=explode(",",$campos);
			$sels="SELECT $cams[0] FROM $tablaf ORDER BY $cams[0] DESC ";
			$DB->Execute($sels);
			$idrecoge=$DB->recogedato(0);
			$bandera=1;  $i=1;
			foreach($_FILES as $nom => $val)
			{
				$nomb=nombre_archivo($val);
				$ruta=subir_archivo1($val);
				if($nomb!=""){
					$sql_ins="INSERT INTO documentos (iddocumentos, doc_fecha, doc_nombre, doc_ruta, doc_tabla, doc_idviene, doc_version) VALUES 
					('', '".date("Y-m-d")."', '$nomb', '$ruta', '$tabla', '$idrecoge', '$i')";
					$DB->Execute($sql_ins);
				}
				$i++;
			}
		}
		else{$bandera=4;}
		$DB->cerrarconsulta();	
		return $bandera;
	}
	
	function addDocumento($val, $i, $tabla, $tablaf, $campo, $DB)
	{
		$sels="SELECT $campo FROM $tablaf ORDER BY $campo DESC ";
		$DB->Execute($sels);
		$idrecoge=$DB->recogedato(0);
		$nomb=nombre_archivo($val);
		$ruta=subir_archivo1($val);
		if($nomb!=""){
			$sql_ins="INSERT INTO documentos (doc_fecha, doc_nombre, doc_ruta, doc_tabla, doc_idviene, doc_version) VALUES 
			(".date("Y-m-d")."', '$nomb', '$ruta', '$tabla', '$idrecoge', '$i')";
			$DB->Execute($sql_ins);
		}
	}

	function addDocumento1($val, $i, $tabla, $idparam, $campo, $DB)
	{
		 $nomb=nombre_archivo($val);
		 $ruta=subir_archivo1($val);
		/* $sql="DELETE from documentos where doc_tabla='$tabla' and doc_idviene='$idparam' and doc_version='$i'";
		$DB->Execute($sql); */
		if($nomb!=""){
			$sql_ins="INSERT INTO documentos (doc_fecha, doc_nombre, doc_ruta, doc_tabla, doc_idviene, doc_version) VALUES 
			('".date("Y-m-d")."', '$nomb', '$ruta', '$tabla', '$idparam', '$i')";
			$DB->Execute($sql_ins);
		}
		//exit;
	}

	function addimagenguia($val,$nombre,$tipo, $idservicio,$DB)
	{
		 $ruta=subir_archivo3($val,$nombre,$tipo);

		 if (file_exists($ruta)) {
		 
			 $sql_ins="INSERT INTO `imagenguias`(`ima_nombre`, `ima_ruta`, `ima_tipo`, `ima_fecha`, `ima_idservicio`) Values
			('$nombre', '$ruta', '$tipo','".date("Y-m-d")."','$idservicio')";
			$DB->Execute($sql_ins);
			//exit;
		}
		//exit;
	}
	
	function cambio1($nombre_campo, $valor, $sql, $esp, $cmp, $i)
	{
		$mas=0; $pecial=explode(";",$esp);
		foreach ($pecial as $vari)
		{
			$cam=explode("-",$vari);
			if($cam[0]==$nombre_campo)
			{
				$mas=1;
				switch($cam[1])
				{
					case 1:
					$sql.="$cmp[$i]='".md5($valor)."',";
					break;
					case 2:
					$sql.="$cmp[$i]=GeomFromText('POINT($valor)'),";
					break;
					case 3:
					$sql.="";
					break;
					case 4:
					$sql.="'".$path[$y]."',";
					$y++;
					break;
				} 
			}	
		}
		
		if($mas==0){ $sql.="$cmp[$i]='$valor',"; }
		return $sql;
	}

	function cambio($nombre_campo,$valor, $sql, $esp)
	{
		$sql1=$sql;
		if(substr($nombre_campo,0,5)=="param"){
			$mas=0; 
			$pecial=explode(";",$esp);
			foreach ($pecial as $vari)
			{
				$cam=explode("-",$vari);
				if($cam[0]==$nombre_campo)
				{
					$mas=1;
					switch($cam[1])
					{
						case 1:
						$sql.="'".md5($valor)."',";
						break;
						case 2:
						$sql.="GeomFromText('POINT($valor)'),";
						break;
						case 3:
						$sql.="";
						break;
						case 4:
						$sql.="'".$path[$y]."',";
						$y++;
						break;
						case 5:
						$sql.="1,";
						$y++;
						break;
					} 
				}	
			}
			if($mas==0){ $sql.="'$valor',"; }
		}
		return $sql;
	}
}
?>