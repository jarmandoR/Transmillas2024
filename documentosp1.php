<?php
if(isset($_REQUEST["param1"])){ $param1=$_REQUEST["param1"]; } else {$param1="";}
$FB->titulo_azul1("Documentos",9,0, 4);  
$FB->abre_form("form1","","post");
$FB->llena_texto("Tipo de documento:",1,2,$DB,"SELECT idtipodocumentos, tid_nombre FROM tipodocumentos ORDER BY tid_nombre ASC","llena_datos();","",1,0);
$FB->llena_texto("Buscar:", 2, 15, $DB, "autocomplet1(this.value);", "llena_datos();", "", 4, 0);
$FB->cierra_form();
$FB->div_valores("destino_vesr",4); 
$FB->cierra_tabla(); 
?>