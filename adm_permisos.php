<?php
require("login_autentica.php");
require("layout.php"); $conde=""; $conde1="";
if(isset($_REQUEST["param1"])){ $param1=$_REQUEST["param1"]; $conde=" AND idroles='$param1' "; } else {$param1="";}
if(isset($_REQUEST["param2"])){ $param2=$_REQUEST["param2"]; if($param2!=""){ $conde1=" WHERE men_predecesor='$param2' "; } } else {$param2="";}
if(isset($_REQUEST["param3"])){ $param3=$_REQUEST["param3"]; if($param3!=""){ $conde1=" WHERE men_predecesor='$param3' "; } } else {$param3="";}
$FB->titulo_azul1("Permisos",9,0, 7);  
$FB->abre_form("form1","","post");
$FB->llena_texto("Roles:",1,2,$DB,"SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre",
"cambio3(this.value,param2.value,param3.value,\"adm_permisos.php\",1);",$param1,1,0);
$FB->llena_texto("Menu principal:",2,2,$DB,"SELECT idmenu, men_nombre FROM menu WHERE men_predecesor=0 ORDER BY men_orden",
"cambio3(param1.value, this.value, param2.value, \"adm_permisos.php\", 1);",$param2,4,0);
$FB->llena_texto("Menu secundario:",3,2,$DB,"SELECT idmenu, men_nombre FROM menu WHERE (men_predecesor='$param2' AND men_principal=1) ORDER BY men_predecesor, men_orden",
"cambio3(param1.value, param2.value, this.value, \"adm_permisos.php\", 1);",$param3,1,0);
$FB->cierra_form(); 
if($rcrear==1) { $FB->nuevo("Permiso", $condecion, "configuracion.php?idmen=64"); }
$FB->titulo_azul6("Nombre Rol",1,0,5,"rol_nombre",$asc2); $FB->titulo_azul6("Categor&iacute;a jer&aacute;rquica",1,0,0,"men_predecesor",$asc2); $FB->titulo_azul6("Item",1,0,0,"men_nombre",$asc2); 
$FB->titulo_azul1("Crear",1,0,0); $FB->titulo_azul1("Editar",1,0,0); $FB->titulo_azul1("Eliminar",1,0,0); $FB->titulo_azul1("Visible en men&uacute;",1,0,0); 
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
 $sql="SELECT idpermisos, rol_nombre, men_predecesor, men_nombre, per_crear, per_editar, per_eliminar, per_consultar, idmenu FROM permisos INNER JOIN roles ON roles_idroles=idroles INNER JOIN menu ON menu_idmenu=idmenu $conde $conde1 ORDER BY $ord $asc ";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0]; $va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	$sql1="SELECT men_nombre FROM menu WHERE idmenu='$rw1[2]' ";
	$DB->Execute($sql1); 
	$prede=$DB->recogedato(0); 
	$sin1=$rw1[4]; if($sin1==1){$sin1="Si";} else {$sin1="No";}
	$sin2=$rw1[5]; if($sin2==1){$sin2="Si";} else {$sin2="No";}
	$sin3=$rw1[6]; if($sin3==1){$sin3="Si";} else {$sin3="No";}
	$sin4=$rw1[7]; if($sin4==1){$sin4="Si";} else {$sin4="No";}
	echo "<tr bgcolor='$color' class='text' style='background-color:$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' 	
	onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td>$rw1[1]</td><td>$prede</td><td>".$rw1[3]."</td><td>$sin1</td>
	<td>$sin2</td><td>$sin3</td><td>$sin4</td>";
	$DB->edites($id_p, "Permiso", 1, $condecion);
	echo "</tr>";
}
include("footer.php"); ?>