<?php 
require("login_autentica.php"); 
require("layout2.php");
$FB->titulo_azul1("Documentos",13, 0, 4); 
if($_REQUEST["param3"]!="" and $_REQUEST["param3"]!="200"){ $param3=$_REQUEST["param3"]; $cond3="AND dop_nombre LIKE '%$param3%'";  } else {$param3=""; $cond3=""; }
if(isset($_REQUEST["param2432"])){ $param2432=$_REQUEST["param2432"]; } else { $param2432=date("Y"); }  
if($rcrear==1) { $FB->nuevo("Documento", $condecion, ""); } 
$condecion=$_SESSION["id_proyecto"]."_zzz_activo1=7"; 
$FB->titulo_azul1("Tipo",1,0,0); $FB->titulo_azul1("Entidad",1,0,0); $FB->titulo_azul1("Contrato",1,0,0); $FB->titulo_azul1("Fecha",1,0,0); $FB->titulo_azul1("Nombre",1,0,0); 
$FB->titulo_azul1("Versi&oacute;n",1,0,0); $FB->titulo_azul1("Observaciones",1,0,0); $FB->titulo_azul1("Documento",1,0,0); $FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
$sql="SELECT iddocumentosproyectos, tid_nombre, ent_nombre, cop_contrato, dop_fecha, dop_nombre, dop_version, doc_observaciones, 'doc' FROM documentosproyectos a INNER JOIN tipodocumentos ON idtipodocumentos=tipodocumentos_idtipodocumentos INNER JOIN contratosproyectos ON idcontratosproyectos=contratosproyectos_idcontratosproyectos INNER JOIN entidades ON entidades_identidades=identidades AND a.proyectos_idproyectos='".$_SESSION["id_proyecto"]."' $cond3 
AND '$param2432'>=YEAR(cop_fechainicio) AND '$param2432'<=YEAR(cop_fechafin) ";
$LT->llenatabla($sql,9, "Documento",$condecion,"4","","","8","","", $param_edicion, $DB, $DB1);
require("footer.php"); ?>