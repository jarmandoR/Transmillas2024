<?php 
$id_encuesta=$_SESSION['id_encuesta'];
switch($tabla)
{
	case "Captura":
	$valor=0;
	break;
	case "Carga Masiva":
	$valor=2;
	break;
	default:
	$valor=1;
	break;
}
if($valor==1)
{
	$DB->Execute($sqle);
	if($DB->recogedato(0)==0){$valor=0;}
}
echo "<div class='pull-right btn btn-default'><a href='resultados5.php?tabla=$tabla&condecion=$condecion'>
<div style='color:#000'>Agregar <i class='fa fa-plus'></i></div></a></div>";
?>