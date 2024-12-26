<?php 
require("login_autentica.php"); 
include("layout.php"); 
?>
<script language="javascript">
function llena_datos2(ord, asc)
{
	destino="cregionales.php?ord="+ord+"&asc="+asc;
	document.location.href=destino;
}
</script>
<?php
include("diliegnciarev.php");
if(isset($_REQUEST["ord"])){ if($_REQUEST["ord"]!=""){ $ord=$_REQUEST["ord"]; }} else {$ord="usu_nombre"; }  
if(isset($_REQUEST["ord"])){ if($_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; }} else {$asc="ASC"; } $asc2=""; if($asc=="ASC"){ $asc2="DESC";}
$FB->titulo_azul1("Coordinadores Regionales",9,0,7);  
$FB->titulo_azul5("Coordinador",1,0,5, "usu_nombre", $asc2); $FB->titulo_azul5("Roles",1,0,0, "rol_nombre", $asc2); 
$FB->titulo_azul5("Identificaci&oacute;n",1,0,0, "usu_identificacion", $asc2); $FB->titulo_azul1("# Gestores",1,0,0); $FB->titulo_azul1("Edici&oacute;n",1,0,2);
$sql="SELECT DISTINCT(idusuarios), usu_nombre, rol_nombre, usu_identificacion FROM usuarios INNER JOIN roles ON idroles=roles_idroles AND roles_idroles IN ($rev) ORDER BY $ord $asc";
$DB->Execute($sql); 
while($rw1=mysqli_fetch_row($DB->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	echo "<tr bgcolor='$color' class='text' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	$sql1="SELECT COUNT(DISTINCT(idgestores)) FROM gestores WHERE ges_idcoordinador='$id_p' ";
	$DB1->Execute($sql1); 
	echo "<td>$rw1[1]</td><td>$rw1[2]</td><td align='center'>$rw1[3]</td><td align='center'>
	<a href='#' onclick='pop_dis($id_p, \"Asignar Gestores por Coordinador\");'>".$DB1->recogedato(0)."</a></td>";
	echo "<td align='center'><a href='ges_gestores.php?id_coordinador=$rw1[0]'>Profundizar</a></td></tr>";
}
include("footer.php");
?>