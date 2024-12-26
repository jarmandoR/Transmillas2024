<?php
require("login_autentica.php");
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$nombre_archivo = $_FILES['param2']['name']; 
$tipo_archivo = $_FILES['param2']['type']; 
$tamano_archivo = $_FILES['param2']['size']; 
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$bandera=10;
$redir="adm_carga.php?bandera=12";
$rr=explode(".",$nombre_archivo);
if ($rr[1]!="csv" or $tamano_archivo>100000000){ $bandera=11;}
else
{ 
	$arquivo="uploaded/".$nombre_archivo;
	$bandera=13;
	if (move_uploaded_file($_FILES['param2']['tmp_name'],$arquivo))
	{ 
	  	$f1=fopen($arquivo,"r");
		$i=0; $p=0;
		while (!feof($f1)) 
		{
			$z = fgetss($f1, 8192);
			$campos=explode(";",$z);
			$ancho1=sizeof($campos)-1;
			if(isset($_POST["param1"])){$param1=$_POST["param1"];} else {$param1="";} 
			if($i>2 and isset($campos[1]))
			{
				switch($param1){
					case "Paises":
					$sql_ins1="UPDATE paises SET pai_codigo='".trim($campos[1])."' WHERE pai_nombre='".trim($campos[0])."'  "; 
					$DB->Execute($sql_ins1);
					break;
					case "Instituciones Educativas":
					$sqls1="SELECT iddepartamentos FROM departamentos WHERE dep_nombre='".trim($campos[2])."' ";
					$DB1->Execute($sqls1);
					$iddep=$DB1->recogedato(0);
					if($iddep==""){
						$sql_ins1="INSERT INTO departamentos (iddepartamentos, paises_idpaises, dep_nombre, dep_codigo) 
						VALUES ('', '1', '".trim($campos[2])."', '".trim($campos[1])."')"; 
						$DB->Execute($sql_ins1);
						$sql3="SELECT iddepartamentos FROM departamentos WHERE dep_nombre='".trim($campos[2])."' ";
						$DB->Execute($sql3);
						$iddep=$DB->recogedato(0);
					}
					$sqls1="SELECT idciudades FROM ciudades WHERE ciu_codigo='".trim($campos[3])."' ";
					$DB1->Execute($sqls1);
					$idmun=$DB1->recogedato(0);
					if($idmun==""){
						$sql_ins1="INSERT INTO ciudades (idciudades, departamentos_iddepartamentos, ciu_codigo, ciu_nombre) 
						VALUES ('', '$iddep', '".trim($campos[3])."', '".trim($campos[4])."')"; 
						$DB->Execute($sql_ins1);
						$sql3="SELECT idciudades FROM ciudades WHERE ciu_codigo='".trim($campos[3])."' ";
						$DB->Execute($sql3);
						$idmun=$DB->recogedato(0);
					}
					$sqls1="SELECT idsecretarias FROM secretarias WHERE sec_nombre='".trim($campos[0])."' ";
					$DB1->Execute($sqls1);
					$idsec=$DB1->recogedato(0);
					if($idsec==""){
						$sql_ins1="INSERT INTO secretarias (idsecretarias, usu_idsede, sec_nombre, sec_secretario) 
						VALUES ('', '$idmun', '".trim($campos[0])."', '')"; 
						$DB->Execute($sql_ins1);
						$sql3="SELECT idsecretarias FROM secretarias WHERE sec_nombre='".trim($campos[0])."' ";
						$DB->Execute($sql3);
						$idsec=$DB->recogedato(0);
					}
					$sqls1="SELECT idieducativas FROM ieducativas WHERE ide_codigo='".trim($campos[5])."' ";
					$DB1->Execute($sqls1);
					$idied=$DB1->recogedato(0);
					if($idied==""){
						$sql_ins1="INSERT INTO ieducativas (idieducativas, secretarias_idsecretarias, usu_idsede, ied_nombre, ide_codigo, 
						ide_direccion, ide_telefono, ide_rector, ide_tipoestablecimiento, ide_sector, ide_zona, ide_jornada, ide_niveles, ide_grados,
						ide_modelos, ide_capacidades, ide_discapacidades, ide_idioma, ide_sedes, ide_estado, ide_calendario, ide_correo) 
						VALUES ('', '$idsec', '$idmun', '".trim($campos[6])."', '".trim($campos[5])."', '".trim($campos[7])."', '".trim($campos[8])."',
						'".trim($campos[9])."', '".trim($campos[10])."', '".trim($campos[11])."', '".trim($campos[12])."', '".trim($campos[13])."', 
						'".trim($campos[14])."', '".trim($campos[15])."', '".trim($campos[16])."', '".trim($campos[17])."', '".trim($campos[18])."',
						'".trim($campos[19])."', '".trim($campos[20])."', '".trim($campos[21])."', '".trim($campos[22])."', '".trim($campos[23])."')"; 
						$DB->Execute($sql_ins1);
						$sql3="SELECT idieducativas FROM ieducativas WHERE ide_codigo='".trim($campos[5])."' ";
						$DB->Execute($sql3);
						$idied=$DB->recogedato(0);
						echo $iddep." - ".$idmun." - ".$idsec." - ".$idied."<br>";
					}
					break; 
					case "GestoresIE":
					$sqls1="SELECT idieducativas FROM ieducativas WHERE ide_codigo='".trim($campos[0])."' ";
					$DB1->Execute($sqls1);
					$idied=$DB1->recogedato(0);

					$sqls1="SELECT idgestores FROM gestores WHERE ges_nombre='".trim($campos[1])."'  ";
					$DB1->Execute($sqls1);
					$idges=$DB1->recogedato(0);
					
					if($idied!="" and $idges!="")
					{
						$insert="INSERT INTO gestoresie (idgestoresie, ieducativas_idieducativas, gestores_idgestores) VALUES ('', '$idied', '$idges')";
						if(!$DB1->Execute($insert)){  }
						echo $i." - ".$idied."-".$idges."<br>";
					}
					break; 
					case "FNE":
					$sqls1="SELECT idieducativas FROM ieducativas WHERE ide_codigo='".trim($campos[0])."' ";
					$DB1->Execute($sqls1);
					$idied=$DB1->recogedato(0);
					if($idied!="")
					{	
						$insert="INSERT INTO fne (idfne, ieducativas_idieducativas, fne_nombre, fne_identificacion, fne_nacionalidad, fne_mail, fne_telefono, fne_empezo, 
						fne_profesion) VALUES ('', '$idied', '".trim($campos[3])."','".trim($campos[4])."','".trim($campos[6])."','".trim($campos[8])."','".trim($campos[7])."',
						'".trim($campos[5])."',	'".trim($campos[9])."') ";
						$DB1->Execute($insert);
					}
					break;
					case "FNE/ComplementoIE":
					$sqls1="SELECT idieducativas FROM ieducativas WHERE ide_codigo='".trim($campos[0])."' ";
					$DB1->Execute($sqls1);
					$idied=$DB1->recogedato(0);
					if($idied!="")
					{	
						$insert="INSERT INTO fne (idfne, ieducativas_idieducativas, fne_nombre) VALUES ('', '$idied', '".trim($campos[16])."') ";
						if(trim($campos[16])!=""){$DB1->Execute($insert);}
						$insert="INSERT INTO fne (idfne, ieducativas_idieducativas, fne_nombre) VALUES ('', '$idied', '".trim($campos[17])."') ";
						if(trim($campos[17])!=""){$DB1->Execute($insert);}
						$insert="INSERT INTO fne (idfne, ieducativas_idieducativas, fne_nombre) VALUES ('', '$idied', '".trim($campos[18])."') ";
						if(trim($campos[18])!=""){$DB1->Execute($insert);}
						$insert="INSERT INTO fne (idfne, ieducativas_idieducativas, fne_nombre) VALUES ('', '$idied', '".trim($campos[19])."') ";
						if(trim($campos[19])!=""){$DB1->Execute($insert);}
						$insert="INSERT INTO fne (idfne, ieducativas_idieducativas, fne_nombre) VALUES ('', '$idied', '".trim($campos[20])."') ";
						if(trim($campos[20])!=""){$DB1->Execute($insert);}
						$insert="INSERT INTO fne (idfne, ieducativas_idieducativas, fne_nombre) VALUES ('', '$idied', '".trim($campos[21])."') ";
						if(trim($campos[21])!=""){$DB1->Execute($insert);}
						$insert="INSERT INTO fne (idfne, ieducativas_idieducativas, fne_nombre) VALUES ('', '$idied', '".trim($campos[22])."') ";
						if(trim($campos[22])!=""){$DB1->Execute($insert);}
						$insert="INSERT INTO fne (idfne, ieducativas_idieducativas, fne_nombre) VALUES ('', '$idied', '".trim($campos[23])."') ";
						if(trim($campos[23])!=""){$DB1->Execute($insert);}

						$insert="UPDATE ieducativas SET ide_direccion='".trim($campos[27])."', ide_correo='".trim($campos[28])."', 
						ide_telefono='".trim($campos[30])."', ide_rector='".trim($campos[35])."', ide_celrector='".trim($campos[36])."',
						ide_mailrector='".trim($campos[39])."', ide_regionprograma='".trim($campos[1])."', ide_mentor='".trim($campos[41])."', 
						ide_celmentor='".trim($campos[42])."', ide_mailmentor='".trim($campos[43])."' WHERE idieducativas='$idied' ";
						$DB1->Execute($insert);
					}
					break; 
					case "Ciudades":
					$sqls1="SELECT iddepartamentos FROM departamentos WHERE dep_nombre='".trim($campos[0])."' ";
					$DB1->Execute($sqls1);
					$iddep=$DB1->recogedato(0);

					$sqls1="SELECT idciudades FROM ciudades WHERE ciu_nombre='".trim($campos[2])."' AND departamentos_iddepartamentos='$iddep' ";
					$DB1->Execute($sqls1);
					$idciu=$DB1->recogedato(0);

					if($idciu!="" and $iddep!=""){
						$insert="UPDATE ciudades SET ciu_codigo='".trim($campos[1])."' WHERE idciudades='$idciu' ";
						$DB1->Execute($insert);
					}
					else {
						if($iddep!=""){
							$insert="INSERT INTO ciudades (idciudades, departamentos_iddepartamentos, ciu_codigo, ciu_nombre) 
							VALUES ('', '$iddep',  '".trim($campos[1])."', '".trim($campos[2])."') ";
							$DB1->Execute($insert);
						}
					}
					break;
					case "Tipo preguntas":
					$sqls1="SELECT idareasgestion FROM areasgestion WHERE are_nombre='".trim($campos[0])."' ";
					$DB1->Execute($sqls1);
					$idare=$DB1->recogedato(0);

					$sqls1="SELECT idprocesos FROM procesos WHERE prc_nombre='".trim($campos[1])."' AND areasgestion_idareasgestion='$idare' ";
					$DB1->Execute($sqls1);
					$idpro=$DB1->recogedato(0);
					if($idare!="" and $idpro!="")
					{
						$insert="INSERT INTO componentes (idcomponentes, procesos_idprocesos, com_componente, com_aspectos) VALUES 
						('', '$idpro', '".trim($campos[2])."', '".trim($campos[3])."' )";
						$DB1->Execute($insert);
					}
					break; 
					case "Matriculas":
					$sqls1="SELECT idieducativas FROM ieducativas WHERE ide_codigo='".trim($campos[2])."'  ";
					$DB1->Execute($sqls1);
					$iedu=$DB1->recogedato(0);
					$sqls1="SELECT idmatriculas FROM matriculas WHERE ieducativas_idieducativas='$iedu' AND mat_jornada='".trim($campos[5])."' ";
					$DB1->Execute($sqls1);
					$idmat=$DB1->recogedato(0);
					if($iedu!="" and $idmat=="")
					{
						$insert="INSERT INTO matriculas (idmatriculas, ieducativas_idieducativas, mat_jornada, mat_prejardin, mat_jardin, 
						mat_transicion, mat_1, mat_2, mat_3, mat_4, mat_5, mat_6, mat_7, mat_8, mat_9, mat_10, mat_11, mat_12, mat_13, mat_ciclo1, 
						mat_ciclo2, mat_ciclo3, mat_ciclo4, mat_ciclo5, mat_ciclo6, mat_aceleracion) 
						VALUES ('','$iedu', '".trim($campos[5])."', '".trim($campos[7])."', '".trim($campos[8])."', '".trim($campos[9])."',
						'".trim($campos[10])."', '".trim($campos[11])."', '".trim($campos[12])."', '".trim($campos[13])."', '".trim($campos[14])."',
						'".trim($campos[15])."', '".trim($campos[16])."', '".trim($campos[17])."', '".trim($campos[18])."', '".trim($campos[19])."',
						'".trim($campos[20])."', '".trim($campos[21])."', '".trim($campos[22])."', '".trim($campos[23])."', '".trim($campos[24])."',
						'".trim($campos[25])."', '".trim($campos[26])."', '".trim($campos[27])."', '".trim($campos[28])."', '".trim($campos[29])."' )";
						$DB1->Execute($insert);
					}
					break; 
					case "Docentes":
					$sql_ins1="INSERT INTO pivote (idpivote, piv_texto) VALUES ('', '$z')";
					$DB1->Execute($sql_ins1);
/*
					$sqls1="SELECT idieducativas FROM ieducativas WHERE ide_codigo='".trim($campos[15])."' ";
					$DB1->Execute($sqls1);
					$idied=$DB1->recogedato(0);
					if($idied!=""){
						echo $idied." ".$i."<br>";
						$sqls1="SELECT iddocentes FROM docentes WHERE doc_documento='".trim($campos[5])."' ";
						$DB1->Execute($sqls1);
						$iddoc=$DB1->recogedato(0);
						$nombre=trim($campos[9])." ".trim($campos[10])." ".trim($campos[7])." ".trim($campos[8]);
						if($iddoc==""){
							$sql_ins1="INSERT INTO docentes (iddocentes, ieducativas_idieducativas, doc_tipodocumento, doc_documento, doc_nacimiento, 
							doc_nombre, doc_fvinculacion, doc_nivel, doc_ubicacion, doc_cargo,
							doc_dane, doc_fuente, doc_tvinculacion, doc_dircomision, doc_amenazados,
							doc_famenazado, doc_gradoescalafon, doc_escalafon, doc_nivelensenanza, doc_areaensenanza,
							doc_areaensenanzat, doc_otraarea) 
							VALUES ('', '$idied', '".trim($campos[4])."', '".trim($campos[5])."', '".trim($campos[6])."',
							'$nombre', '".trim($campos[12])."', '".trim($campos[13])."', '".trim($campos[16])."', '".trim($campos[14])."',
							'".trim($campos[15])."', '', '".trim($campos[17])."', '', '',
							'', '".trim($campos[19])."', '".trim($campos[20])."', '".trim($campos[22])."', '".trim($campos[24])."',
							'".trim($campos[24])."', '')"; 
						}
						else {
							$sql_ins1="UPDATE docentes SET ieducativas_idieducativas='$idied', doc_tipodocumento='".trim($campos[4])."', doc_documento='".trim($campos[5])."',
							doc_nacimiento='".trim($campos[6])."', doc_nombre='$nombre', doc_fvinculacion='".trim($campos[12])."', doc_nivel='".trim($campos[13])."', 
							doc_ubicacion=".trim($campos[16])."', doc_cargo='".trim($campos[14])."', doc_dane='".trim($campos[15])."', doc_fuente='', 
							doc_tvinculacion='".trim($campos[17])."', doc_gradoescalafon='".trim($campos[19])."', doc_escalafon='".trim($campos[20])."', 
							doc_nivelensenanza='".trim($campos[22])."', doc_areaensenanza='".trim($campos[24])."', doc_areaensenanzat='".trim($campos[24])."'  
							WHERE iddocentes='$iddoc' "; 
						}
						$DB1->Execute($sql_ins1);
					}
*/					break; 
				}
			}
			$i++;
		}
		fclose($f1); 
		$bandera=12;
	}
}
//header ("Location: $redir");
?>