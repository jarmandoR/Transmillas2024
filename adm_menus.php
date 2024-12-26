<?php
require("login_autentica.php"); 
include("layout.php"); $conde="";
if(isset($_REQUEST["param1"])){ $param1=$_REQUEST["param1"]; $conde=" WHERE men_predecesor='$param1' "; } else {$param1="";}
if(isset($_REQUEST["param2"])){ $param2=$_REQUEST["param2"]; if($param2!=""){ $conde=" WHERE men_predecesor='$param2' "; } } else {$param2="";}
$FB->titulo_azul1("Men&uacute;s",9,0,7);  
$FB->abre_form("form1","","post");
$FB->llena_texto("Menu principal:",1,2,$DB,"SELECT idmenu, men_nombre FROM menu WHERE (men_predecesor=0) ORDER BY men_orden",
"cambio1(this.value, param2.value, \"adm_menus.php\", 1);",$param1,1,0);
$FB->llena_texto("Menu secundario:",2,2,$DB,"SELECT idmenu, men_nombre FROM menu WHERE (men_predecesor='$param1' AND men_principal=1) ORDER BY men_predecesor, men_orden",
"cambio1(param1.value, this.value, \"adm_menus.php\", 1);",$param2,4,0);
$FB->cierra_form(); 
if($rcrear==1) { $FB->nuevo("Menu", $condecion, "configuracion.php?idmen=64"); } 
$FB->titulo_azul1("Orden",1,0,5); $FB->titulo_azul1("Categor&iacute;a jer&aacute;rquica",1,0,0); $FB->titulo_azul1("Nombre",1,0,0); $FB->titulo_azul1("URL",1,0,0); 
$FB->titulo_azul1("Descripci&oacute;n",1,0,0); $FB->titulo_azul1("&Iacute;cono",1,0,0); $FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
$sql="SELECT idmenu, men_orden, men_predecesor, men_nombre, men_url, men_descripcion FROM menu $conde ORDER BY men_orden, $ord $asc";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	$sql1="SELECT men_nombre FROM menu WHERE idmenu ='$rw1[2]' ";
	$DB->Execute($sql1); 
	$prede=$DB->recogedato(0); 
	echo "<tr bgcolor='$color' class='text' style='background-color:$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' 	
	onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td>$rw1[1]</td><td>$prede</td><td>$rw1[3]</td><td align='center'><a href='$rw1[4]'><span class='a1'>$rw1[4]</span></a></td><td>$rw1[5]</td>";
	$LT->llenadocs1($DB, "Menu", $id_p, 1, 35, 1);
	$DB->edites($id_p, "Menu", 1, $condecion);
	echo "</tr>";
}
include("footer.php"); ?>