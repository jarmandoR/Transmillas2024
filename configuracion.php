<?php 
require("login_autentica.php");
include("layout.php"); 
if(isset($_REQUEST["idmen1"])){ $idmen1=$_REQUEST["idmen1"]; } else { $idmen1=1; } 
$id_menu=$_REQUEST["idmen"];
if($id_menu>3){ $lis="configuracion.php?idmen=$idmen1"; } else { $lis=""; } 
 $sql1="SELECT men_nombre FROM menu WHERE idmenu='$id_menu' ";
$DB->Execute($sql1); 
$FB->volver1("", $DB->recogedato(0), 4, "", "");

	$sql1="SELECT men_nombre, men_url, idmenu, men_principal, men_descripcion FROM menu INNER JOIN permisos ON idmenu=menu_idmenu AND men_predecesor='$id_menu' AND 
	roles_idroles='$nivel_acceso' AND men_orden!=0 AND per_consultar=1 ORDER BY men_orden  ";
	$DB->Execute($sql1); $i=0;
	while($rw_m2=mysqli_fetch_row($DB->Consulta_ID))
	{ 
		if($rw_m2[3]==1){ $link="$rw_m2[1]?idmen=$rw_m2[2]&idmen1=$id_menu"; } else { $link="$rw_m2[1]"; }
		if($i==0){ echo "</tr><tr>"; }
		echo "<td align='center' width='25%'><a href='$link' tittle='$rw_m2[4]'>";
		$LT->llenadocs1($DB1, "Menu", $rw_m2[2], 1, 120, 0);
		echo "</a><br>$rw_m2[0]</td>"; 
		$i++;
		if($i==4){$i=0;}
	}


$FB->cierra_tabla();
include("footer.php"); 
?>