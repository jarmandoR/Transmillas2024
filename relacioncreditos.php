<?php
require("login_autentica.php");
require("layout.php"); $conde=""; $conde1="";
if(isset($_REQUEST["param1"])){ $param1=$_REQUEST["param1"]; $conde=" AND idcreditos='$param1' "; } else {$param1="";}

$FB->titulo_azul1("Relacion de Creditos Clientes",9,0, 7);  
$FB->abre_form("form1","","post");
$FB->llena_texto("Credito:",1,2,$DB,"SELECT `idcreditos`, `cre_nombre` FROM `creditos`  ORDER BY cre_nombre",
"cambio3(this.value,1,1,\"relacioncreditos.php\",1);",$param1,1,0);

$FB->cierra_form(); 
//if($rcrear==1) { $FB->nuevo("Nuevo", $condecion, "configuracion.php?idmen=64"); }
if($rcrear==1) { $FB->nuevo("rel_crecli", "rel_crecli", "nuevo_admin.php"); }

$FB->titulo_azul6("Credito",1,0,5,"cre_nombre",$asc2); 
$FB->titulo_azul6("Telefono",1,0,0,"cli_telefono",$asc2); 
$FB->titulo_azul6("Cliente",1,0,0,"cli_nombre",$asc2); 
$FB->titulo_azul6("Direccion",1,0,0,"cli_direccion",$asc2); 
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
 $sql="SELECT idrelcrecli,cre_nombre,cli_telefono,cli_nombre,cli_direccion FROM `rel_crecli` inner join creditos on rel_idcredito=idcreditos inner join clientesdir on idclientesdir=rel_idcliente $conde $conde1 ORDER BY $ord $asc ";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0]; $va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

	$rw1[4]=str_replace("&"," ", $rw1[4]);
	echo "<tr bgcolor='$color' class='text' style='background-color:$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' 	
	onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td>$rw1[1]</td>
	<td>$rw1[2]</td><td>".$rw1[3]."</td><td>".$rw1[4]."</td>";

	$DB->edites($id_p, "rel_crecli", 2,0);
	echo "</tr>";
}
include("footer.php"); ?>