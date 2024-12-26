<?php 
require("login_autentica.php"); 
require("layout2.php");
$FB->titulo_azul1("Documentos",13, 0, 4); 
if($_REQUEST["param2"]!=""){ $param2=$_REQUEST["param2"]; $cond2="AND tipodocumentos_idtipodocumentos='$param2'"; } else {$param2=""; $cond2=""; }  
if($_REQUEST["param3"]!=""){ $param3=$_REQUEST["param3"]; $cond3="AND dot_nombre LIKE '%$param3%'";  } else {$param3=""; $cond3=""; }  
$FB->titulo_azul1("Tipo",1,0,0); $FB->titulo_azul1("Fecha",1,0,0); $FB->titulo_azul1("Nombre",1,0,0); $FB->titulo_azul1("Versi&oacute;n",1,0,0); 
$FB->titulo_azul1("Presupuesto",1,0,0); $FB->titulo_azul1("Adjunto",1,0,2); 
$sql="SELECT iddocumentosproyectos, tid_nombre, dop_fecha, dop_nombre, dop_version, doc_presupuesto, '' FROM documentosproyectos INNER JOIN tipodocumentos ON idtipodocumentos=tipodocumentos_idtipodocumentos AND proyectos_idproyectos='".$_SESSION["id_proyecto"]."' $cond2 $cond3 ";
$LT->llenatabla($sql,7, "Documento",$condecion,"4","5","","6","","", 0, $DB, $DB1);
$sql="SELECT SUM(doc_presupuesto) FROM documentosproyectos WHERE proyectos_idproyectos='".$_SESSION["id_proyecto"]."'";
$DB1->Execute($sql);  
$vppto=$DB1->recogedato(0);
echo "<table width='100%'><tr class='text'><td><b>Total presupuesto ejecutado:</b></td><td>&nbsp;</td>
<td align='right'><b>$".number_format($vppto,0,".",".")."</b></td></tr></table>";
require("footer.php"); ?>