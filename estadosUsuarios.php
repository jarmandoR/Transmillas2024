<?php 
require("login_autentica.php"); 
$id_ciudad= $_SESSION['usu_idsede'];
$id_usuario= $_SESSION['usuario_id'];
@$tipoguia=$_REQUEST["tipoguia"];
@$registros=$_REQUEST["registros"];
$id_nombre=$_SESSION['usuario_nombre'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();


    $funcion=$_POST['funcion'];
    $para=$_POST["id_usuario"]; 
    $param1=$_POST['valor'];
    $select=$_POST["select"]; 

if ($funcion == 65) {
    
    // if($param1=="Activo"){ $st=1; } else { $st=0; } 
	$sql="UPDATE usuarios SET usu_estado='$param1' WHERE idusuarios='$para' ";
	$DB1->Execute($sql);
	// echo "<select name='param14' id='param14' class='form-control' onChange='cambio_ajax2(this.value, 65, \"inactivo$nombre\", \"$nombre\", 1, $para)' required>";
	// $LT->llenaselect_ar($param1,$estado_pro);
	// echo "</select>";


}else if ($funcion == 80) {
    
    // if($param1=="Activo"){ $st=1; } else { $st=0; } 
	$sql="UPDATE usuarios SET usu_filtro='$param1' WHERE idusuarios='$para' ";
	$DB1->Execute($sql);
	// echo "<select name='param14' id='param14' class='form-control' onChange='cambio_ajax2(this.value, 65, \"inactivo$nombre\", \"$nombre\", 1, $para)' required>";
	// $LT->llenaselect_ar($param1,$estado_pro);
	// echo "</select>";


}else if ($funcion == 801) {
    
    // if($param1=="Activo"){ $st=1; } else { $st=0; } 
	echo$sql="UPDATE usuarios SET usu_ver_nomina='$param1' WHERE idusuarios='$para' ";
	$DB1->Execute($sql);
	// echo "<select name='param14' id='param14' class='form-control' onChange='cambio_ajax2(this.value, 65, \"inactivo$nombre\", \"$nombre\", 1, $para)' required>";
	// $LT->llenaselect_ar($param1,$estado_pro);
	// echo "</select>";


}else if ($funcion == 2) {
    
    // if($param1=="Activo"){ $st=1; } else { $st=0; } 
echo$sql="UPDATE hojadevida SET hoj_fechatermino='$param1' WHERE hoj_cedula='$para' AND idhojadevida = (SELECT MAX(idhojadevida) FROM hojadevida WHERE hoj_cedula='$para')";

	$DB1->Execute($sql);
	// echo "<select name='param14' id='param14' class='form-control' onChange='cambio_ajax2(this.value, 65, \"inactivo$nombre\", \"$nombre\", 1, $para)' required>";
	// $LT->llenaselect_ar($param1,$estado_pro);
	// echo "</select>";


}