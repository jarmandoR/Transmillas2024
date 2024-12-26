<?php
if($nivel_acceso!=1){ $conde2=" AND (pro_diligencia='$nivel_acceso' OR pro_revisa='$nivel_acceso' OR pro_aprueba='$nivel_acceso')"; } else { $conde2=""; } 
$sql0="SELECT pro_diligencia, pro_revisa, pro_aprueba FROM proyectos WHERE idproyectos!=0 $conde2 $conde1  ";
$DB1->Execute($sql0); $rev=""; $dil="";
while($rw_m1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$rev.=$rw_m1[1].",".$rw_m1[2].",";	
	$dil.=$rw_m1[0].",";	
}
$rev=substr($rev,0,-1);
$dil=substr($dil,0,-1);
?>