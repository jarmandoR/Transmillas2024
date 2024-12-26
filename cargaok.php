<?php
require("login_autentica.php");
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$p1=$_POST['id_encuesta'];
$tabla=$_POST['tabla'];
$nombre_archivo = $_FILES['param65']['name']; 
$tipo_archivo = $_FILES['param65']['type']; 
$tamano_archivo = $_FILES['param65']['size']; 
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$bandera=10;
$rr=explode(".",$nombre_archivo);
$fech2=date("Y-m-d H:m:s");
if ($rr[1]!="csv" or $tamano_archivo>10000000){ $bandera=11;}
else
{ 
	$arquivo="uploaded/".$nombre_archivo;
	$bandera=13;
	if (move_uploaded_file($_FILES['param65']['tmp_name'],$arquivo))
	{ 
	  	$f1=fopen($arquivo,"r");
		$i=0;
		while (!feof($f1)) 
		{
			$z = fgetss($f1, 8192);
			$campos=explode(";",$z);
			$ancho1=sizeof($campos)-1;
			if($i>0)
			{
				$idunico=rand(1000000000,9999999999);
				$sql2="SELECT idindicadores, ind_nombre, ind_codigo, ind_array, int_nombre FROM actindgener a INNER JOIN poblacionobjetivo ON 
				a.poblacionobjetivo_idpoblacionobjetivo=idpoblacionobjetivo INNER JOIN proyectosindicadores b ON b.poblacionobjetivo_idpoblacionobjetivo=idpoblacionobjetivo 
				INNER JOIN indicadores ON idindicadores=b.indicadores_idindicadores INNER JOIN tiposindicadores ON idtiposindicadores=tiposindicadores_idtiposindicadores AND 
				idactindgener='$p1' ";
				$DB->Execute($sql2); $va=0; $j=1; $pregt1="";
				while($rw=mysqli_fetch_row($DB->Consulta_ID))
				{
					$pregt=trim($campos[$va]); 
					$idpre=$rw[0];
					if($idpre==35){ 
						$sqls="SELECT iddocentes FROM docentes WHERE doc_documento='$pregt' ";
						$DB1->Execute($sqls);
						$pregt1=$DB1->recogedato(0);
					} 
					else if($idpre==26){ $va++; $va++; $pregt=trim($campos[$va]);
						$sqls="SELECT idieducativas FROM ieducativas WHERE ide_codigo='$pregt' ";
						$DB1->Execute($sqls);
						$pregt1=$DB1->recogedato(0); 
					} 
					$sql1="INSERT INTO respuesta_$p1 (idrespuesta_$p1, actindgener_idactindgener, preguntas1_idpreguntas1, res_respuesta, res_fecha, res_tipopreg, res_idunico,
					res_orden, res_estado) VALUES ('', '$p1', '$rw[0]', '$pregt1', '$fech2', '$rw[4]', '$idunico', '$j', '4')";
					if($pregt1!=""){ $DB1->Execute($sql1); }
					$va++; $j++;
				}

				$sql1="SELECT idpreguntas1, pre_pregunta, pre_tipo, pre_array, pre_orden, pre_obligatoria, pre_justifica, pre_depende, pre_condicion FROM preguntas1 
				WHERE actindgener_idactindgener='$p1' AND pre_tipo!='Titulo' ORDER BY pre_orden ";
				$DB->Execute($sql1);
				while($rw=mysqli_fetch_row($DB->Consulta_ID)){ 
					$pregt=trim($campos[$va]);
					$sql1="INSERT INTO respuesta_$p1 (idrespuesta_$p1, actindgener_idactindgener, preguntas1_idpreguntas1, res_respuesta, res_fecha, res_tipopreg, res_idunico,
					res_orden, res_estado) VALUES ('', '$p1', '$rw[0]', '$pregt', '$fech2', '$rw[2]', '$idunico', '$j', '4')";
					if($pregt1!=""){ $DB1->Execute($sql1); }
					$va++; $j++;
				}
			}
		$i++;
		}
		fclose($f1); 
		$bandera=12;
	}
}
$redir="carga.php?tabla=$tabla&id_encuesta=$p1";
$redir="$redir";
header ("Location: $redir");
?>