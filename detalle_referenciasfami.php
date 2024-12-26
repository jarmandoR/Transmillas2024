
<?php 
require("login_autentica.php");
include("cabezote3.php"); 
$fechatiempo=date("Y-m-d H:i:s");
$id_nombre=$_SESSION['usuario_nombre'];
$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
$conde41=" ";

if($param6=='insertar'){ 

	$sql2="INSERT INTO `referenciasfamiliares`(`ref_nombre`, `ref_parentesco`,`ref_ocupacion`, `ref_telefono`, `ref_idhojavida`, `ref_usuregistra`, `ref_fecharegistra`)
	VALUES ('$param1','$param2','$param3','$param4','$param7','$id_nombre','$fechatiempo')";
	$vinculo=$DB->Executeid($sql2);

	if($_FILES["109"]!=''){
		$QL->addDocumento1($_REQUEST["109"], 1, "referenciasfamiliares", $vinculo, "referenciasfamiliares", $DB);// referencias

	}
}


$FB->titulo_azul1("Nombre",1,0,7); 
$FB->titulo_azul1("Parentesco",1,0,0); 
$FB->titulo_azul1("Ocupaci&oacute;n u oficio",1,0,0); 
$FB->titulo_azul1("Celular",1,0,0); 
$FB->titulo_azul1("Documentos Familiares",1,0,0); 

$conde1=""; 
$conde3=""; 

  $sql="SELECT `idrefenciasfamiliares`, `ref_nombre`, `ref_parentesco`, `ref_ocupacion`, `ref_telefono`, `ref_idhojavida`, `ref_usuregistra`, `ref_fecharegistra` FROM `referenciasfamiliares` WHERE  ref_idhojavida=$param7";

$DB->Execute($sql); 
$va=0; 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
				$id_p=$rw1[0];
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>";		

				echo $LT->llenadocs3($DB1, "referenciasfamiliares",$id_p, 1, 35, 'Ver');
	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 

include("footer.php");
?>